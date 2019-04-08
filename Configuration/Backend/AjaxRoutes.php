<?php
use Visit\VisitTablets\Controller\BackendEndpoints;

return [
  'fileUpload' => [
      'path' => '/visit/fileUpload', 
      'target' => BackendEndpoints\FileUploadController::class . '::fileUploadAction',
  ],
 
  'listFilesForBrowser' => [
      'path' => '/visit/listFilesForBrowser', 
      'target' => BackendEndpoints\FileController::class . '::listFilesForBrowserAction',
  ],
 
];