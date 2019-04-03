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
 * FileReferenceType
 * 
 */
class FileReferenceType extends \TYPO3\CMS\Core\Type\Enumeration
{
   const __default = self::TEXT_LEFT_ONE_MEDIA;

   /** @var int default */
   const MEDIA_DEFAULT = 0;

   /** @var int 3d objects */
   const MEDIA_OBJ = 1;

    public static function getValues() {
        return [
            self::MEDIA_DEFAULT =>    "Standard Media",
            self::MEDIA_OBJ =>   "3D Objekte",
        ];
    }

    /**
     *
     * @return type mixed
     */
    public function getValue(){
        return $this->value;
    }

}
