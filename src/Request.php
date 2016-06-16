<?php
/*
 * The MIT License
 *
 * Copyright 2015 Chris Stretton <cstretton@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Cheezykins\PHPMyPlex;

use Cheezykins\PHPMyPlex\Exceptions\MyPlexAuthenticationException;
use Httpful\Exception\ConnectionErrorException;
use Httpful\Httpful;
use Httpful\Request as HttpfulRequest;
use Cheezykins\PHPMyPlex\Exceptions\MyPlexDataException;
use Httpful\Response;

/**
 * Provides an interface to the Httpful request library to communicate with plex.
 * Defines custom headers that Plex requires as part of its API specification.
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class Request
{

    private $headers = [
        'X-Plex-Platform' => PHP_OS,
        'X-Plex-Platform-Version' => false,
        'X-Plex-Provides' => 'controller',
        'X-Plex-Product' => 'PHPMyPlex',
        'X-Plex-Version' => false,
        'X-Plex-Device' => false,
        'X-Plex-Client-Identifier' => false,
    ];
    private $template;
    private $endPoint;

    /**
     * Creates an HTTP Request manager with additional header support for Plex.
     * Endpoint is the URL to request from, with optional proxy parameter.
     * expectEmptyResponse when set to true does not try and parse the result as XML.
     * 
     * @param string $endPoint
     * @param bool|Proxy $proxy
     */
    public function __construct($endPoint, $proxy = false, $expectEmptyResponse = false)
    {
        $this->endPoint = $endPoint;
        $this->template = HttpfulRequest::init();
        if ($expectEmptyResponse) {
            $this->template->withoutAutoParse();
        } else {
            $this->template->expectsXml();
        }
        if ($proxy) {
            $this->template->useProxy($proxy->host, $proxy->port, $proxy->authType);
        }
        foreach ($this->headers as $header => $value) {
            if ($value) {
                $this->setHeader($header, $value);
            }
        }
    }

    /**
     * Helper method allows headers to be set as parameters.
     * 
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->setHeader($name, $value);
    }

    /**
     * Sets a header in the HTTP request.
     * Headers in camelCase are transposed to X-Plex-Camel-Case
     * 
     * @param string $header
     * @param string $value
     */
    public function setHeader($header, $value)
    {
        if (\substr($header, 0, 7) != 'X-Plex-') {
            $header = 'X-Plex-' . \ucfirst(\preg_replace('/([A-Z])/', '-$0', $header));
        }
        $this->headers[$header] = $value;
        $this->template->addHeader($header, $value);
    }

    /**
     * Sets basic authentication headers iwth the provided username
     * and password.
     * 
     * @param string $userName
     * @param string $password
     */
    public function setAuthentication($userName, $password)
    {
        $this->template->authenticateWith($userName, $password);
    }

    /**
     * Helper method to allow retrieval of headers.
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->headers)) {
            return $this->headers[$name];
        }
    }

    /**
     * Initiates the HTTP request using the provided method (GET, POST, PUT, DELETE)
     * and returns the response XML as an Httpful\Request
     * 
     * @param string $method
     * @return Response;
     * @throws Exceptions\MyPlexDataException
     */
    public function send($method)
    {
        HttpfulRequest::ini($this->template);
        try {
            $response = HttpfulRequest::$method($this->endPoint)->send();
        } catch (ConnectionErrorException $e) {
            throw new MyPlexDataException('Unable to connect to endPoint: ' . $e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            throw new MyPlexDataException('Error in response from server: ' . $e->getMessage(), 0, $e);
        }
        $this->errorCheck($response);
        return $response;
    }

    /**
     * Checks the response from the HTTP request for a variety of errors and issues
     * and raises appropriate exceptions if detected.
     * 
     * @param Response $response
     * @throws Exceptions\MyPlexAuthenticationException
     * @throws Exceptions\MyPlexDataException
     */
    private function errorCheck(Response $response)
    {
        if ($response->hasErrors()) {
            if ($response->code == 401) {
                throw new MyPlexAuthenticationException((string) $response->body->error);
            }

            $error = 'Error code ' . $response->code . ' received from server';
            if ($response->hasBody() && isset($response->body->error)) {
                $error .= ': ' . (string) $response->body->error;
            }
            throw new MyPlexDataException($error);
        }
    }
}
