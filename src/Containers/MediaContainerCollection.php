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
 * Provides an itterable collection of MediaContainer objects with
 * the ability to call load() en-mass.
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class MediaContainerCollection extends \ArrayObject
{

    /**
     * Iterates through the collection and loads all sub-items.
     * Returns itself for chaining.
     * @return MediaContainerCollection
     */
    public function loadAll()
    {
        foreach ($this as $obj) {
            $obj->load();
        }
        return $this;
    }
    
    /**
     * Gets all details for containers within the collection.
     * @return array
     */
    public function getDetails()
    {
        $details = [];
        foreach ($this as $obj) {
            $details[] = $obj->getDetails();
        }
        return $details;
    }

    /**
     * Generates a MediaContainerCollection containing all child items of items
     * in the collection.
     * 
     * @return MediaContainerCollection
     */
    public function children()
    {
        $details = [];
        foreach ($this as $obj) {
            foreach ($obj->children() as $child) {
                $details[] = $child;
            }
        }
        return new self($details);
    }
}
