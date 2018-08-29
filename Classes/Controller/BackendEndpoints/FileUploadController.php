<?php
namespace Visit\VisitTablets\Controller\BackendEndpoints;


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

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Visit\VisitTablets\Helper\Constants;

/**
 * FileUploadController Ajax endpoint well file uploads
 * 
 */
class FileUploadController extends AbstractBackendController {



    public function fileUploadAction(ServerRequestInterface $request, ResponseInterface $response) {
        $files = $request->getUploadedFiles();
        header('Content-Type: application/json');
        
        $responseContent = array();
        $responseContent["status"] = false;
        
        if(\count($files) == 1){
            $file = $files["file"];
            
            //create folder if not exist
            if (!\file_exists(Constants::$AJAX_UPLOAD_TEMP_DIR)) {
                \mkdir(Constants::$AJAX_UPLOAD_TEMP_DIR , 0770);
            }
            
            $file->moveTo(Constants::$AJAX_UPLOAD_TEMP_DIR );
            
            $reflection = new \ReflectionClass($file);
            $property = $reflection->getProperty("file");
            $property->setAccessible(true);
            $filename = $property->getValue($file);
            
            $filename = Constants::$AJAX_UPLOAD_TEMP_DIR . explode("/", $filename)[2];
            
            \file_put_contents($filename . ".info", \serialize($file));
            
            $responseContent["status"] = true;
            $responseContent["tempPath"] = $filename;
            
        }
       
        $response->getBody()->write(\json_encode($responseContent));
        
        return $response;
    }

}
