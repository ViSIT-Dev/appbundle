<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Helper\Util;
use Visit\VisitTablets\Domain\Enums\GaleryContentLayout;
use Visit\VisitTablets\Helper\VisitFile;

/**
 * Class CompressionNameViewHelper
 * not used
 */
class CompressionNameViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


    public function initializeArguments(){
        $this->registerArgument('compression', 'array', 'compression object', true);
    }

    public function render(){
        if($this->arguments["compression"]["paths"][0] == 0){
            return "Original";
        }

        $file = new VisitFile($this->arguments["compression"]["paths"][0], "");

        return $file->getCompressionLevel();
    }

}