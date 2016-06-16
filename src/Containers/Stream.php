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
 * Extends the MediaContainer to allow handling of Stream objects from Plex
 * Sparse class to match the Plex Data Structure.
 * 
 * Typically available properties (actual properties available depend upon context)
 *
 * + **audioChannelLayout** -  (eg. stereo)
 * + **bitrate** -  (eg. 128)
 * + **bitrateMode** -  (eg. cbr)
 * + **channels** -  (eg. 2)
 * + **codec** -  (eg. mp3)
 * + **codecID** -  (eg. S_TEXT/UTF8)
 * + **containerType** -  (eg. Stream)
 * + **duration** -  (eg. 1257881)
 * + **format** -  (eg. srt)
 * + **id** -  (eg. 51345)
 * + **index** -  (eg. 1)
 * + **language** -  (eg. English)
 * + **languageCode** -  (eg. eng)
 * + **samplingRate** -  (eg. 48000)
 * + **selected** -  (eg. 1)
 * + **streamIdentifier** -  (eg. 1)
 * + **streamType** -  (eg. 2)
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class Stream extends Part
{

}
