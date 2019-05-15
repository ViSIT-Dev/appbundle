<?php

namespace Visit\VisitTablets\Helper;

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
 * Description of VisitFile
 *
 *    Filename: 5bb5d4f06e585.76498b14-3f4a-4d85-a160-443572542622.0.png
 *              objectTripleID.mediaTripleID.0.extension
 *
 * @author RaichKrispin
 */
class VisitFile {

    private $fileName;
    private $data;
    private $currentDictionary;

    /**
     * ViSITFile constructor.
     * @param string $fileName
     * @param string $currentAccessLevel
     */
    public function __construct(string $fileName, string $currentAccessLevel)
    {
        $this->fileName = $fileName;
        $this->currentDictionary = $currentAccessLevel;
    }


    public function getObjectTripleID(){
        return \explode(".", $this->fileName)[0];
    }

    public function getObjectTripleURL(){
        return Constants::$VISIT_RDF_PREFIX_OBJECT_TRIPLE_URL . $this->getObjectTripleID();
    }

    public function getMediaTripleID(){
        return \explode(".", $this->fileName)[1];
    }

    public function getMediaTripleURL(){
        return Constants::$VISIT_RDF_PREFIX_MEDIA_TRIPLE_URL . $this->getMediaTripleID();
    }

    public function getCompressionLevel(){
        return \explode(".", $this->fileName)[2];
    }

    public function getFileExtension(){
        return \explode(".", $this->fileName)[3];
    }


    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @param mixed $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getCurrentDictionary()
    {
        return $this->currentDictionary;
    }

    /**
     * @param string $currentDictionary
     */
    public function setCurrentDictionary($currentDictionary)
    {
        $this->currentDictionary = $currentDictionary;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

}
