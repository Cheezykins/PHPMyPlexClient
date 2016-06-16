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
namespace Cheezykins\PHPMyPlex\DirectoryViews;

/**
 * Defines views available to all library types within Plex
 *
 * @author Chris Stretton <cstretton@gmail.com>
 */
class DirectoryView
{
    const NONE              = '';
    const ALL               = 'all';
    const UNWATCHED         = 'unwatched';
    const NEWEST            = 'newest';
    const RECENTLY_ADDED    = 'recentlyAdded';
    const RECENTLY_VIEWED   = 'recentlyViewed';
    const ON_DECK           = 'onDeck';
    const COLLECTION        = 'collection';
    const GENRE             = 'genre';
    const YEAR              = 'year';
    const CONTENT_RATING    = 'contentRating';
    const FIRST_CHARACTER   = 'firstCharacter';
    const FOLDER            = 'folder';
}
