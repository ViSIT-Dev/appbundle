<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Helper\Util;

/**
 * Class ConfigViewHelper
 */
class ConfigViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function initializeArguments(){
        $this->registerArgument('varName', 'string', 'name of var in which the prices will be stored', false, "content");
        $this->registerArgument('name', 'string', 'name of the config');
        $this->registerArgument('language', 'int', 'language ID', 0);
    }


    public function render(){

        $varName = $this->arguments["varName"];
        $name =  $this->arguments["name"];
        $language = $this->arguments["language"];

        $this->templateVariableContainer->add($varName, Util::getConfig($name, $language));

        $renderedChild = $this->renderChildren();

        $this->templateVariableContainer->remove($varName);

        return $renderedChild;
    }


}