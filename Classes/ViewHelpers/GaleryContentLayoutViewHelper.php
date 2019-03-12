<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Domain\Enums\GaleryContentLayout;
/**
 * Class LanguageViewHelper
 */
class GaleryContentLayoutViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function render(){
        $varName = "galeryContentLayouts";
        $this->templateVariableContainer->add($varName, GaleryContentLayout::getValues());
        $renderedChild = $this->renderChildren();
        $this->templateVariableContainer->remove($varName);
        return $renderedChild;
    }
    
}