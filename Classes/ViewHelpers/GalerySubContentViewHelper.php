<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Domain\Repository\GaleryContentSubElementRepository;
use Visit\VisitTablets\Helper\Util;

/**
 * Class LanguageViewHelper
 */
class GalerySubContentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function initializeArguments(){
        $this->registerArgument('galeryContentElement', 'object', 'the galery content element');
    }

    public function render(){
        $galeryContentSubElementRepository = Util::getInstance("Visit\VisitTablets\Domain\Repository\GaleryContentSubElementRepository");
        $galeryContentElement = $this->arguments["galeryContentElement"];
        $varName = "galerySubContentElements";
        $this->templateVariableContainer->add($varName, $galeryContentSubElementRepository->findByGaleryContentElement($galeryContentElement));
        $renderedChild = $this->renderChildren();
        $this->templateVariableContainer->remove($varName);
        return $renderedChild;
    }
    
}
