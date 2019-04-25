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
 * Visit Dateien Access level
 * 
 */
class AccessLevel extends \TYPO3\CMS\Core\Type\Enumeration {

    const AL_PRIVATE = "private";

    const AL_VISIT = "visit";

    const AL_PUBLIC = "public";


    /**
     *
     * @return type mixed
     */
    public function getValue(){
        return $this->value;
    }


//    /**
//     *
//     * @return type mixed
//     */
//    public function getPath(){
//        $this->value;
//    }

}
