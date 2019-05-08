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
 * Description of Constants
 *
 * @author RaichKrispin
 */ 
class ConfigurationHelper implements \TYPO3\CMS\Core\SingletonInterface {

    private $configuration;
    
    public function __construct() {
        $this->configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['visit_tablets']);
    }
    
    public function getConfiguration(){
        return $this->configuration;
    }
    
    public function isDebug(){
        return (bool) $this->configuration["debugging"];
    }
    
    public function isVarDump(){
        return (bool) $this->configuration["varDump"];
    }

    public function getApiUser(){
        return $this->configuration["apiUser"];
    }

    public function getApiUserPassword(){
        return $this->configuration["apiUserPassword"];
    }

    public function isCompressionEnabled(){
        return (bool) $this->configuration["enableCompression"];
    }

    public function getCompressionApiPort(){
        return $this->configuration["compressionApiPort"];
    }

    public function getSyncthingMasterId(){
        return $this->configuration["syncthingMasterId"];
    }

    public function getViSITPartnerName(){
        return $this->configuration["partnerName"];
    }

    public function getVisitLocalFileDir(){
        return $this->configuration["visitFileDir"];
    }

}