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


/**
 * Description of SectionMappingCollection
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class SectionMappingCollection extends \ArrayObject
{
    public function offsetSet($index, $newval)
    {
        $title = $this->nextFreeKey($index);
        parent::offsetSet($title, $newval);
    }
    
    public function offsetGet($index)
    {
        if (!$this->offsetExists($index))
        {
            throw new Exceptions\MyPlexDataException("Provided key {$index} does not exist");
        }
        
        return parent::offsetGet($index);
    }
    
    /**
     * A simple method of deduplication for library titles.
     * 
     * If multiple libraries have the same name, this will append numbers until a unique one is found
     * and reference it that way from then on. For example TV Shows, TV Shows 2, TV Shows 3 etc.
     * 
     * @param string $title
     * @return string
     */
    private function nextFreeKey($title)
    {
        $increment = 1;
        $initialTitle = $title;
        while ($this->offsetExists($title)) {
            $title = $initialTitle . ' ' . ((string) ++$increment);
        }

        return $title;
    }

}
