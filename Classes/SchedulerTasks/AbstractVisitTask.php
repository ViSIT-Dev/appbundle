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
 * AbstractVisitTask
 * 
 * Don't forget to add this Task to config in ext_localconf:
 
 $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Visit\VisitTablets\SchedulerTasks\AbstractVisitTask'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Title',
    'description'      => 'desc'
);

 * 
 */

abstract class AbstractVisitTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask{
    
   
}