<?php
/***
 *
 * This file is part of the "visit" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Kathrein Robert
 *
 ***/

namespace Visit\VisitTablets\Helper;

/**
 * Class CachingHelper
 * Wrapper for Typo3 Caching Framework
 * @package Visit\VisitTablets\Helper
 */
class CachingHelper {

    private static function getCacheInstance(){
        return Util::makeInstance("TYPO3\\CMS\\Core\\Cache\\CacheManager")->getCache(Constants::$EXTENSION_NAME);
    }

    public static function getCacheByName(String $cacheName){
        $cacheContent = self::getCacheInstance()->get(\sha1($cacheName));
        return $cacheContent === null ?: \unserialize($cacheContent);
    }

    public static function setCacheByName(String $cacheName, $object, $tags = []){
        self::getCacheInstance()->set(\sha1($cacheName), \serialize($object), $tags, Constants::$CACHING_TIME);
    }

    public static function flushCacheByTag($tag){
        self::getCacheInstance()->flushByTag($tag);
    }

}