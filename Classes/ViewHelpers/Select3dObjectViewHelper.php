<?php
namespace Visit\VisitTablets\ViewHelpers;


/**
 * Class LanguageViewHelper
 */
class Select3dObjectViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function render(){
        $varName = "objects";
        $this->templateVariableContainer->add($varName, ["Test1", "Test2", "Test3"]);
        $renderedChild = $this->renderChildren();
        $this->templateVariableContainer->remove($varName);
        return $renderedChild;
    }
    
}