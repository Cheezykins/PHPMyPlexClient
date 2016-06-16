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
 * Extends the MediaContainer to allow handling of Directory objects from Plex
 * Sparse class to match the Plex Data Structure.
 *
 * Typically available properties (actual properties available depend upon context)
 *
 * + **addedAt** -  (eg. 1427997392)
 * + **art** -  (eg. /library/metadata/7424/art/1428002760)
 * + **banner** -  (eg. /library/metadata/7424/banner/1428002760)
 * + **childCount** -  (eg. 2)
 * + **containerType** -  (eg. Directory)
 * + **contentRating** -  (eg. TV-PG)
 * + **duration** -  (eg. 1800000)
 * + **index** -  (eg. 1)
 * + **key** -  (eg. /library/metadata/7424/children)
 * + **leafCount** -  (eg. 20)
 * + **originallyAvailableAt** -  (eg. 2010-11-26)
 * + **parentKey** -  (eg. /library/metadata/7424)
 * + **parentRatingKey** -  (eg. 7424)
 * + **rating** -  (eg. 9.3)
 * + **ratingKey** -  (eg. 7424)
 * + **studio** -  (eg. Cartoon Network)
 * + **summary** - 
 * + **theme** -  (eg. /library/metadata/7424/theme/1428002760)
 * + **thumb** -  (eg. /library/metadata/7424/thumb/1428002760)
 * + **title** -  (eg. Season 2)
 * + **type** -  (eg. season)
 * + **updatedAt** -  (eg. 1428002760)
 * + **viewedLeafCount** -  (eg. 0)
 * + **year** -  (eg. 2010)
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class Directory extends MediaContainer
{
    
}
