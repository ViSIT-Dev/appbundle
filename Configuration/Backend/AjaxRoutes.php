<?php
use Visit\VisitTablets\Controller\BackendEndpoints;

return [
  'fileUpload' => [
      'path' => '/visit/fileUpload', 
      'target' => BackendEndpoints\FileUploadController::class . '::fileUploadAction',
  ],
 
];