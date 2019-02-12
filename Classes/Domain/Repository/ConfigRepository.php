<?php
namespace Visit\VisitTablets\Domain\Repository;

use Visit\VisitTablets\Domain\Model\Config;
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
 * The repository for Config
 */
class ConfigRepository extends AbstractVisitRepository{

    public function findByName($name, $language = 0){
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                [
                    $query->equals('name', $name),
                    $query->equals('language', $language)
                ]
            )
        );
        return $query->execute()->getFirst();
    }

    public function get($name, $language = 0){
        $config = $this->findByName($name, $language);
        if($config != null){
            return $config->getContent();
        }
        return null;
    }

    public function getForAllLanguages($name){
        $out = array();

        foreach (Util::getLanguages() as $language){
            if(($conf = $this->findByName($name, $language["uid"])) != null){
                $out[$language["uid"]] = $conf->getContent();
            }
        }
        return $out;
    }

    public function addOrUpdate($name, $content, $language = 0){

        if($config = $this->findByName($name, $language)){
            $config->setContent($content);
            $this->update($config);
            return $config;
        }

        $newConfig = new Config();
        $newConfig->setName($name);
        $newConfig->setContent($content);
        $newConfig->setLanguage($language);
        $this->add($newConfig);

        return $newConfig;

    }

    public function processRequest(\TYPO3\CMS\Extbase\Mvc\Request $request, string $paramName){
        foreach (Util::getLanguages() as $language){
            $paramWithLang = $paramName . "-" . $language["languageIsocode"];
            if($request->hasArgument($paramWithLang) &&
               ($data = $request->getArgument($paramWithLang))){
                $this->addOrUpdate($paramName, $data, $language["uid"]);
            }
        }

    }


}
