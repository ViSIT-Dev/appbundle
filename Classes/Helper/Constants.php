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
 * Description of Constants
 *
 * @author RaichKrispin
 */
class Constants {
    
    public static $EXTENSION_NAME = "visit_tablets";

    public static $AJAX_UPLOAD_TEMP_DIR = PATH_site . "typo3temp/ajax_upload/";

//    public static $VISIT_PUBLIC_URL  = "https://database.visit.uni-passau.de/drupal/wisski/navigate";
    public static $VISIT_PUBLIC_URL  = "https://database-test.visit.uni-passau.de/drupal/wisski/navigate";


    static public $SYNCTHING_DEFAULT_FOLDER_PATH = "/var/www/Sync";
    static public $SYNCTHING_PRIVATE_FOLDER_PATH = "/var/www/Private";
    static public $SYNCTHING_PARTNER_FOLDER_PATH = "/var/www/Partner";


    public static $ALLOWED_FILE_TYPES_FOR_UPLOAD = [
        "jpeg",
        "jpg",
        "mp4",
        "png"
    ];

    public static $CACHING_TIME = 0;

}
