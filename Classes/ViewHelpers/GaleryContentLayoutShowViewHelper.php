<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Helper\Util;
use Visit\VisitTablets\Domain\Enums\GaleryContentLayout;

/**
 * Class GaleryContentLayoutShowViewHelper
 */
class GaleryContentLayoutShowViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function initializeArguments(){
        $this->registerArgument('layout', 'int', 'layout ID', 0);
    }


    public function render(){

        $layout = $this->arguments["layout"];

        $this->templateVariableContainer->add("layoutName", GaleryContentLayout::getValues()[$layout]);

        $renderedChild = $this->renderChildren();

        $this->templateVariableContainer->remove("layoutName");

        return $renderedChild;
    }


}