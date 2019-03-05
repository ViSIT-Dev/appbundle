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


/**
 * Aufgaben: Updated die Extension vom git repo
 * 
 * @author Kris
 */
class UpdateExtensionTask extends AbstractVisitTask {

    public function execute(): bool {

        \shell_exec("git -C /var/www/html/typo3conf/ext/visit_tablets pull && chown www-data:www-data /var/www/html/ -hR");

        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_treelist');
        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_pagesection');
        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_hash');
        $GLOBALS['TYPO3_DB']->exec_TRUNCATEquery('cache_pages');

        if($handle = opendir('./typo3conf')) {
            while (false !== ($file = readdir($handle))) {
                if(strpos($file, 'temp_CACHED_')!==false) {
                    unlink('./typo3conf/'.$file);
                }
            }
            closedir($handle);
        }


        return true;
    }

    
}
