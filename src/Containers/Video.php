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
use Cheezykins\PHPMyPlex\PlexServer;


/**
 * Extends the MediaContainer to allow handling of Video objects from Plex
 * 
 * Typically available properties (actual properties available depend upon context)
 *
 * + **addedAt** -  (eg. 1427997393)
 * + **addedAtDateTime** - 
 * + **art** -  (eg. /library/metadata/7424/art/1428002760)
 * + **chapterSource** -  (eg. )
 * + **containerType** -  (eg. Video)
 * + **contentRating** -  (eg. R)
 * + **duration** -  (eg. 1257923)
 * + **grandparentArt** -  (eg. /library/metadata/7424/art/1428002760)
 * + **grandparentKey** -  (eg. /library/metadata/7424)
 * + **grandparentRatingKey** -  (eg. 7424)
 * + **grandparentTheme** -  (eg. /library/metadata/7424/theme/1428002760)
 * + **grandparentThumb** -  (eg. /library/metadata/7424/thumb/1428002760)
 * + **grandparentTitle** -  (eg. Young Justice)
 * + **guid** -  (eg. com.plexapp.agents.imdb://tt1156398?lang=en)
 * + **index** -  (eg. 20)
 * + **key** -  (eg. /library/metadata/7459)
 * + **lastViewedAt** -  (eg. 1428756749)
 * + **originallyAvailableAt** -  (eg. 2009-10-08)
 * + **parentIndex** -  (eg. 2)
 * + **parentKey** -  (eg. /library/metadata/7443)
 * + **parentRatingKey** -  (eg. 7443)
 * + **parentThumb** -  (eg. /library/metadata/7443/thumb/1428002760)
 * + **primaryExtraKey** -  (eg. /library/metadata/8145)
 * + **rating** -  (eg. 7.0)
 * + **ratingKey** -  (eg. 7459)
 * + **studio** -  (eg. Columbia Pictures)
 * + **summary** - 
 * + **tagline** -  (eg. This place is so dead)
 * + **thumb** -  (eg. /library/metadata/7459/thumb/1428002760)
 * + **title** -  (eg. Endgame)
 * + **type** -  (eg. episode)
 * + **updatedAt** -  (eg. 1428002760) 
 * + **viewOffset** -  (eg. 1554602)
 * + **year** -  (eg. 2009)
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class Video extends MediaContainer
{

    /**
     * Extends the base constructor to add parsing of added and updated times for Videos.
     * @param \SimpleXMLElement $data
     * @param PlexServer $server
     */
    public function __construct(\SimpleXMLElement $data, PlexServer $server)
    {
        parent::__construct($data, $server);

        if ($this->isSession() && array_key_exists('viewOffset', $this->details)) {
            $this->details['progress'] = ($this->details->parseInt('viewOffset') / $this->details->parseInt('duration')) * 100;
        }

        $this->details['addedAtDateTime'] = $this->details->parseDateTime('addedAt');
        $this->details['updatedAtDateTime'] = $this->details->parseDateTime('updatedAt');
    }

    /**
     * Determines if the video is a container for a current session or just a generic video.
     * @return boolean
     */
    public function isSession()
    {
        if ($this->child('User') || $this->child('TranscodeSession')) {
            return true;
        }
        return false;
    }
}
