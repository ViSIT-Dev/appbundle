<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Helper\Util;

/**
 * Class ObjRenderViewHelper
 */
class ObjRenderViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function initializeArguments(){
        $this->registerArgument('media', 'object', 'the media');
        $this->registerArgument('objVarName', 'string', 'name of obj var', false, "object");
        $this->registerArgument('mtlVarName', 'string', 'name of mtl var', false, "material");
        $this->registerArgument('textureVarName', 'string', 'name of texture var', false, "texture");
    }

    public function render(){

        $media = $this->arguments["media"];
        $mtlVarName = $this->arguments["mtlVarName"];
        $textureVarName = $this->arguments["textureVarName"];
        $objVarName = $this->arguments["objVarName"];

        if (! ($media instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference || $media instanceof \TYPO3\CMS\Core\Resource\File ) ){
            throw new \Exception('You must either specify a FileReference or a File as media.', 1554284716);
        }

        if ($media instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference){
            $media = $media->getOriginalResource()->getOriginalFile();
        }

        $fileIdentifier = $media->getIdentifier();

        if(substr($fileIdentifier , strrpos($fileIdentifier , '.')) === ".mtl"){
            return;
        }

        if(
            substr($fileIdentifier , strrpos($fileIdentifier , '.')) !== ".obj")
        {
            throw new \Exception('Not a OBJ File', 1554285497);
        }

        $this->templateVariableContainer->add($objVarName, $media);

        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();

        $sysFileQueryBuilder = Util::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('sys_file');


        //suche datei mit .mtl endung, erzeuge fileref
        $mtlFileIdentifier = \substr_replace($fileIdentifier , 'mtl', \strrpos($fileIdentifier , '.') +1);
        $mtlStatement = $sysFileQueryBuilder->select('uid')
            ->from('sys_file')
            ->where(
                $sysFileQueryBuilder->expr()->eq('identifier', $sysFileQueryBuilder->createNamedParameter($mtlFileIdentifier))
            )
            ->execute();
        $mtlFileUid =  $mtlStatement->fetch()["uid"];
        $this->templateVariableContainer->add($mtlVarName,
             $mtlFileUid ?
                 $resourceFactory->getFileObject($mtlFileUid) :
                 null
        );

        //suche datei mit .jpg, .jpeg oder .png endung, erzeuge fileref
        $fileBasename = substr($fileIdentifier , 0, strrpos($fileIdentifier , '.'));
        $textureStatement = $sysFileQueryBuilder->select('uid')
            ->from('sys_file')
            ->orWhere(
                $sysFileQueryBuilder->expr()->eq('identifier', $sysFileQueryBuilder->createNamedParameter($fileBasename . '.jpg')),
                $sysFileQueryBuilder->expr()->eq('identifier', $sysFileQueryBuilder->createNamedParameter($fileBasename . '.jpeg')),
                $sysFileQueryBuilder->expr()->eq('identifier', $sysFileQueryBuilder->createNamedParameter($fileBasename . '.png'))
            )
            ->execute();
        $textureUid =  $textureStatement->fetch()["uid"];

        $this->templateVariableContainer->add($textureVarName,
            $textureUid ?
                $resourceFactory->getFileObject($textureUid) :
                null
        );


        $renderedChild = $this->renderChildren();

        $this->templateVariableContainer->remove($mtlVarName);
        $this->templateVariableContainer->remove($textureVarName);
        $this->templateVariableContainer->remove($objVarName);

        return $renderedChild;
    }

}