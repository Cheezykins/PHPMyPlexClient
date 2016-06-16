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
 * Extends the MediaContainer to allow handling of Media objects from Plex
 * Sparse class to match the Plex Data Structure.
 * 
 * Typically available properties (actual properties available depend upon context)
 * 
 * + **aspectRatio** -  (eg. 1.78)
 * + **audioChannels** -  (eg. 2)
 * + **audioCodec** -  (eg. dca)
 * + **bitrate** -  (eg. 10705)
 * + **container** -  (eg. avi)
 * + **containerType** -  (eg. Media)
 * + **duration** -  (eg. 1257923)
 * + **height** -  (eg. 416)
 * + **id** -  (eg. 14262)
 * + **videoCodec** -  (eg. h264)
 * + **videoFrameRate** -  (eg. 24p)
 * + **videoResolution** -  (eg. 1080)
 * + **width** -  (eg. 1920)
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class Media extends Video
{

}
