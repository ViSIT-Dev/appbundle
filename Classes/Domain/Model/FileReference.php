<?php

namespace Visit\VisitTablets\Domain\Model;

use Visit\VisitTablets\Domain\Enums\FileReferenceType;
use Visit\VisitTablets\Helper\Util;

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
 * Sauce:   https://www.typo3.net/forum/thematik/zeige/thema/126046/ 
 *          http://www.typo3tiger.de/blog/post/extbase-fal-filereference-im-controller-erzeugen.html
 * 
 * FileReference
 */
class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference {

    /**
     * uid of a sys_file
     *
     * @var integer
     */
    protected $originalFileIdentifier;

    /**
     * setOriginalResource
     * 
     * @param \TYPO3\CMS\Core\Resource\ResourceInterface $originalResource
     */
    public function setOriginalResource(\TYPO3\CMS\Core\Resource\ResourceInterface $originalResource) {
        parent::setOriginalResource($originalResource);
        $this->originalFileIdentifier = (int) $originalResource->getOriginalFile()->getUid();
    }

    /**
     * setFile
     *
     * @param \TYPO3\CMS\Core\Resource\File $falFile
     */
    public function setFile(\TYPO3\CMS\Core\Resource\File $falFile) {
        $this->originalFileIdentifier = (int) $falFile->getUid();
    }

    /**
     * setFile
     *
     */
    public function setFileByUid($falFileUid) {
        if(is_int($falFileUid) && $falFileUid){
            $this->originalFileIdentifier = $falFileUid;
        }
    }

}
