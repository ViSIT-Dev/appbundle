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

    public static $VISIT_PUBLIC_URL  = "https://database.visit.uni-passau.de/drupal/wisski/navigate";

    public static $ALLOWED_FILE_TYPES_FOR_UPLOAD = [
        "jpeg",
        "jpg",
        "mp4",
        "png"
    ];

}
