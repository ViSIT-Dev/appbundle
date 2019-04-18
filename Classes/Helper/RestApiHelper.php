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
 * Description of RestApiHelper
 *
 * @author RaichKrispin
 */
class RestApiHelper {
    
    public static function accessAPI($url, $targetObjectId, $parameter = null, $method = "GET"){


//        // Abhängig von der API, hier json
//        $headers = array(
//            'Accept: application/json',
//            'Content-Type: application/json',
//        );

        $curl = curl_init();

        $url = Constants::$VISIT_API_URL  . $url . '?' . http_build_query(["id" => $targetObjectId]);

        if($parameter != null && $method != 'GET'){
            $body = \json_encode($parameter);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . \strlen($body)));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }


        switch($method) {
            default:
            case 'GET':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $configurationHelper = Util::makeInstance("Visit\VisitTablets\Helper\ConfigurationHelper");
        curl_setopt($curl, CURLOPT_USERPWD, $configurationHelper->getApiUser() . ":" . $configurationHelper->getApiUserPassword());

        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($code == 200) {
            if( ($parsedJson = json_decode($response, true)) !== null){
                return $parsedJson;
            }
            return $response;
        }

        return false;

    }




}
