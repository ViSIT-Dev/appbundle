<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Helper\Util;

/**
 * Class LanguageViewHelper
 */
class LanguageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function initializeArguments(){
        $this->registerArgument('varName', 'string', 'name of var in which the prices will be stored', false, "languages");
    }


    public function render(){

        $varName = $this->arguments["varName"];

        $this->templateVariableContainer->add($varName, Util::getLanguages());

        $renderedChild = $this->renderChildren();

        $this->templateVariableContainer->remove($varName);

        return $renderedChild;
    }


}