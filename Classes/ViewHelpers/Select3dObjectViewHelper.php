<?php
namespace Visit\VisitTablets\ViewHelpers;


use Visit\VisitTablets\Helper\Util;

/**
 * Class LanguageViewHelper
 */
class Select3dObjectViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    public function initializeArguments(){
        $this->registerArgument('objVarName', 'string', 'name of obj var', false, "objects");
        $this->registerArgument('includeFile', 'boolean', 'add file to objects', false, true);
    }


    public function render(){
        $varName = $this->arguments["objVarName"];
        $includeFile = $this->arguments["includeFile"];

        if($includeFile){
            $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        }
        $sysFileQueryBuilder = Util::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('sys_file');

        $statement = $sysFileQueryBuilder
            ->select(
                'sys_file.uid',
                'sys_file.type',
                'sys_file.identifier',
                'sys_file.extension',
                'sys_file.mime_type',
                'sys_file.name',
                'sys_file.size',
                'sys_file.creation_date',
                'metadata.title',
                'metadata.description',
                'metadata.alternative'
            )
            ->from('sys_file')
            ->join(
                'sys_file',
                'sys_file_metadata',
                'metadata',
                $sysFileQueryBuilder->expr()->eq('metadata.file', $sysFileQueryBuilder->quoteIdentifier('sys_file.uid'))
            )
            ->where(
                $sysFileQueryBuilder->expr()->like('sys_file.identifier',  $sysFileQueryBuilder->createNamedParameter('%.obj'))
            )
            ->orderBy('metadata.title')
            ->execute();

        $out = array();

        while($objRow =  $statement->fetch()){
            $currentUid = $objRow["uid"];
            $out[$currentUid] = $objRow;
            if($includeFile){
                $out[$currentUid]["file"] = $resourceFactory->getFileObject($currentUid);
            }
        }

        $this->templateVariableContainer->add($varName, $out);
        $renderedChild = $this->renderChildren();
        $this->templateVariableContainer->remove($varName);
        return $renderedChild;
    }

}