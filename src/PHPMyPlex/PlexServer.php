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
namespace PHPMyPlex;

use PHPMyPlex\Containers as Containers;
use PHPMyPlex\DirectoryViews as DirectoryViews;

/**
 * Models the plex server. Provides the basis of requesting sections and subsections within each server as well as
 * high level server details.
 * 
 * Magic Getters and Setters, __get() and __set() are used to access properties from the object, so a list of the key available properties is described here.
 * 
 * **Available properties:**
 * 
 * + **accessToken** - The authentication token passed to the server for requests. **this is sensitive!**
 * + **name** - The friendly name of the server
 * + **address** - The internet facing IP address of the server (eg. 212.42.87.3)
 * + **port** - The port the server is running on (eg. 32400)
 * + **version** - The version of Plex Media Server the server is running
 * + **scheme** - The url scheme that the server is using (eg. http)
 * + **host** - The hostname of the server, or IP address if unknown.
 * + **localAddresses** - The local IP addresses of the server comma seperated, from its network interfaces (eg. 192.168.0.4)
 * + **machineIdentifier** - The internal identifier used by MyPlex to identify the server.
 * + **createdAt** - The date and time the server was created as a unix timestamp.
 * + **updatedAt** - The date and time the server was last updated as a unix timestamp.
 * + **owned** - Is the server owned by the user or shared with the user? (bit, 1 for yes and 0 for no)
 * + **synced** - Is the server currently synced with any devices? (bit, 1 for yes and 0 for no)
 * 
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class PlexServer
{

    private $accessToken = false;
    private $name = false;
    private $address = false;
    private $port = false;
    private $version = false;
    private $scheme = false;
    private $host = false;
    private $localAddresses = false;
    private $machineIdentifier = false;
    private $createdAt = false;
    private $updatedAt = false;
    private $owned = false;
    private $synced = false;
    private $sectionMappings = [];
    private $proxy = false;

    /**
     * Defines a myplex server. Takes an optional Proxy object for calls back to Plex.
     * @param mixed $proxy
     */
    public function __construct($proxy = false)
    {
        $this->proxy = $proxy;
    }

    /**
     * Returns the fully qualified URL for the server based on server properties.
     * @return string
     */
    public function getUrl()
    {
        $url = $this->scheme;
        $url .= '://';
        $url .= $this->address;
        $url .= ':';
        $url .= $this->port;
        return $url;
    }

    /**
     * Loads a plex media container with data from the plex server.
     * The optional path parameter allows you to define the container path to load.
     * @param string $path
     * @return \PHPMyPlex\Containers\MediaContainer
     */
    public function loadContainer($path = '/library')
    {
        return new Containers\MediaContainer($this->loadContainerRaw($path), $this);
    }

    /**
     * Submits the request to the plex server to load a container and returns the resulting XML.
     * @param string $path
     * @return \SimpleXMLElement
     */
    public function loadContainerRaw($path = '/library')
    {
        $url = $this->getUrl() . $path;

        $request = new Request($url, $this->proxy);
        $request->token = $this->accessToken;

        $response = $request->send('get');

        return $response->body;
    }

    /**
     * Gets the sections available in the plex server and returns an associative array
     * 
     * @param string $path
     * @return array
     */
    public function getSections($path = '/library/sections')
    {
        if (count($this->sectionMappings) == 0) {
            $response = $this->loadContainer($path);
            foreach ($response->children() as $child) {
                if ($child->hasKey()) {
                    $this->sectionMappings[$child->title] = $child->key;
                }
            }
        }
        return $this->sectionMappings;
    }

    /**
     * Loads the provided section, if the section is given as a string then
     * it attempts to resolve that string to a section using getSections.
     * 
     * @param string|int $key
     * @param string $directory
     * @param string $path
     * @return \PHPMyPlex\Containers\MediaContainer
     * @throws Exceptions\MyPlexDataException
     */
    public function getSection($key, $directory = '', $path = '/library/sections')
    {
        if (!\is_int($key) && !\ctype_digit($key)) {
            $this->getSections($path);
            $key = $this->sectionMappings[$key];
        }
        $url = $key->generateUrl($path);
        if (!\is_int($key) && \substr($key, 0, 6) == '/sync/') {
            $url = $key;
        } else {
            $url = $path . '/' . $key;
        }
        if ($directory != DirectoryViews\DirectoryView::NONE) {
            $url .= '/' . $directory;
        }
        return $this->loadContainer($url);
    }

    /**
     * Alias of loadContainer(/status/sessions)
     * @param string $path
     * @return \PHPMyPlex\Containers\MediaContainer
     */
    public function getSessions($path = '/status/sessions')
    {
        return $this->loadContainer($path);
    }

    /**
     * Allows retrieval of properties from the server.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->{$name})) {
            return $this->{$name};
        }
    }

    /**
     * Helper method - allows setting of attributes of a server, pass a whole attributes array to set multiple ones
     * 
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name == 'attributes') {
            foreach ($value as $attribute => $attributeValue) {
                $this->{$attribute} = $attributeValue;
            }
        } else if (isset($this->{$name})) {
            $this->{$name} = $value;
        }
    }

    /**
     * Helper method - returns the server name as a string and its URL.
     * @return string
     */
    public function __toString()
    {
        return $this->name . ' - ' . $this->getUrl();
    }
    

}
