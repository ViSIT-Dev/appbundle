<?php

namespace Visit\VisitTablets\SchedulerTasks;

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

use Visit\VisitTablets\Helper\Constants;

/**
 * Aufgaben:
 * Löscht den Temp folder für den Ajax Upload
 * 
 * @author Kris
 */
class ClearAjaxUploadTempFolderTask extends AbstractVisitTask {

    public function execute(): bool {

        $files = \glob(Constants::$AJAX_UPLOAD_TEMP_DIR . '*'); 
        foreach($files as $file){ // iterate files
          if(\is_file($file)){
            \unlink($file); // delete file
          }
        }
        return true;
    }
    
}
