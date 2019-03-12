<?php
namespace Visit\VisitTablets\Domain\Enums;


/***
 *
 * This file is part of the "tablets" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kris Raich
 *
 ***/


/**
 * Farben laut vorlage
 * 
 */
class GaleryContentLayout extends \TYPO3\CMS\Core\Type\Enumeration
{
   const __default = self::TEXT_LEFT_ONE_MEDIA;

   /** @var int Do not use any wildcard */
   const TEXT_LEFT_ONE_MEDIA = 0;

   /** @var int Use wildcard on left side */
   const TEXT_RIGHT_ONE_MEDIA = 1;

   /** @var int Use wildcard on right side */
   const TEXT_LEFT_TWO_MEDIA = 2;

   /** @var int Use wildcard on both sides */
   const TEXT_RIGHT_TWO_MEDIA = 3;
   
   /** @var int Use wildcard on both sides */
   const FULLSCREEN_MEDIA = 4;

    public static function getValues() {
        return [
            self::TEXT_LEFT_ONE_MEDIA =>    "Ein Medienobjekt, Text links",
            self::TEXT_RIGHT_ONE_MEDIA =>   "Ein Medienobjekt, Text rechts",
            self::TEXT_LEFT_TWO_MEDIA =>    "Zwei Medienobjekte, Text links",
            self::TEXT_RIGHT_TWO_MEDIA =>   "Zwei Medienobjekte, Text rechts",
            self::FULLSCREEN_MEDIA =>       "Vollbild-Medienobjekt"
        ];
    }

}
