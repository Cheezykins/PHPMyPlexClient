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
namespace Cheezykins\PHPMyPlex\Containers;

/**
 * Provides an itterable array of properties within a plex container as well
 * as helpers to help parse the strings returned by plex into their appropriate
 * data types.
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class ContainerDetails extends \ArrayObject
{

    /**
     * Tries to parse a string into a DateTime object, returns false on failure.
     * @param string $attribute
     * @return \DateTime|boolean
     */
    public function parseDateTime($attribute)
    {
        if ($this->offsetExists($attribute)) {
            try {
                $d = new \DateTime();
                $d->setTimestamp((int) $this->offsetGet($attribute));
                return $d;
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }

    /**
     * Tries to parse a string into an int, returns false on failure.
     * @param string $attribute
     * @return int|boolean
     */
    public function parseInt($attribute)
    {
        if ($this->offsetExists($attribute)) {
            $attr = $this->offsetGet($attribute);
            if (\ctype_digit($attr)) {
                return (int) $attr;
            }
        }
        return false;
    }
}
