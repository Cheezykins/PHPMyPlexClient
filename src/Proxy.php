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

use Httpful\Proxy as HttpfulProxy;

/**
 * Defines a proxy for sending requests to plex.
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class Proxy extends HttpfulProxy
{
    
    protected $host;
    protected $port;
    protected $authType;
    protected $authUsername;
    protected $authPassword;
    protected $proxyType;
    
    /**
     * Defines proxy settings for use with Plex.
     * 
     * @param string $host
     * @param int $port
     * @param null|string $authType
     * @param null|string $authUsername
     * @param null|string $authPassword
     * @param string $proxyType
     */
    public function __construct($host, $port = 80, $authType = null, $authUsername = null, $authPassword = null, $proxyType = self::HTTP)
    {
        $this->host = $host;
        $this->port = $port;
        $this->autType = $authType;
        $this->authUsername = $authUsername;
        $this->authPassword = $authPassword;
        $this->proxyType = $proxyType;
    }
    
    /**
     * Helper method to retrieve proxy settings.
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->{$name}))
        {
            return $this->{$name};
        }
    }
}
