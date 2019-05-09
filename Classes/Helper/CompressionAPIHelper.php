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
 * Description of CompressionHelper
 *
 * @author RaichKrispin
 */
class CompressionAPIHelper {

    public static function triggerCompression($data){


        if(!\in_array($data["MIMEtype"], Constants::$ALLOWED_MIME_TYPES_FOR_COMPRESSION)){
            return false;
        }

        $curl = curl_init();

        $configurationHelper = Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper");


        $url = "http://{$configurationHelper->getCompressionApiIP()}:{$configurationHelper->getCompressionApiPort()}/api/jobs/dispatch";
        curl_setopt($curl, CURLOPT_URL, $url);


        $visitFile = new VisitFile($data["files"]["origin"]["paths"][0], "");

        $body = \json_encode([
            "basePath" => Constants::$SYNCTHING_PRIVATE_FOLDER_PATH . "/" . $visitFile->getFileName(),
            "objectUid" => $visitFile->getObjectTripleID(),
            "mediaUid" => $visitFile->getMediaTripleID(),
            "title" => $data["title"],
            "mimeType" => $data["MIMEtype"],
            "levels" => [
                "Automatisch"
            ],
        ]);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . \strlen($body)));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_POST, true);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($code == 200) {

            if( ($parsedJson = json_decode($response, true)) == null){
                return false;
            }

            return (bool)$response["success"];
        }

        return false;

    }
}