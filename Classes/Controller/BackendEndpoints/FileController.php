<?php
namespace Visit\VisitTablets\Controller\BackendEndpoints;

/***
 *
 * This file is part of the "tablets" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Robert Kathrein
 *
 ***/

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use \Visit\VisitTablets\Helper\Util;

/**
 * FileController Ajax endpoint for File Browser
 * 

 * 
 */
class FileController extends AbstractBackendController{
    
    public function listFilesForBrowserAction(ServerRequestInterface $request, ResponseInterface $response)
    {
        header('Content-Type: text/html');
        
        $queryBuilder = Util::makeInstance("TYPO3\CMS\Core\Database\ConnectionPool")
            ->getQueryBuilderForTable('sys_file');

        $res = $queryBuilder
            ->select('*')
            ->from('sys_file')
            ->where(
                $queryBuilder->expr()->like(
                    'identifier',
                    $queryBuilder->createNamedParameter('/user_upload/%')
                )
            )
            ->orderBy('identifier')
            ->execute();

        $response->getBody()->write(
                Util::renderTemplateWithArguments(
                "FileSelector/FileList.html",
                ["files" => $res],
                "/")
        );
        return $response;
    }
    
    

}
