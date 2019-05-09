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

    public static $VISIT_API_URL  = "https://database-test.visit.uni-passau.de/metadb-rest-api/";

    public static $VISIT_RDF_PREFIX_MEDIA_TRIPLE_URL = "http://visit.de/metadb/";
    public static $VISIT_RDF_PREFIX_OBJECT_TRIPLE_URL = "http://visit.de/data/";


    static public $SYNCTHING_DEFAULT_FOLDER_PATH = "/var/www/sync";
    static public $SYNCTHING_PUBLIC_FOLDER_PATH =  "/var/www/sync/public";
    static public $SYNCTHING_PRIVATE_FOLDER_PATH = "/var/www/private";

    static public $SYNCTHING_CONFIG_PATH = "/var/www/syncthing/config.xml";

    public static $ALLOWED_FILE_TYPES_FOR_UPLOAD = [
        "jpeg",
        "jpg",
        "mp4",
        "png"
    ];

    /**
     * @var int Zeit in sekunden 8 Mio ca 3 Monate
     */
    public static $CACHING_TIME = 8000000;

    public static $FILE_NAME_CACHE_TAG = "file-name";

    public static $FILE_DEFAULT_FOLDER = "/user_upload/";

}
