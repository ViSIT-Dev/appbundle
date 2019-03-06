<?php
namespace Visit\VisitTablets\Controller;

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

use Visit\VisitTablets\Helper\Util;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;

/**
 * InmateController
 */
class InmateController extends AbstractVisitController  implements IRenderFrontend{

    /**
     * inmateRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\InmateRepository
     * @inject
     */
    protected $inmateRepository = null;

    /**
     * prisonCellRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\PrisonCellRepository
     * @inject
     */
    protected $prisonCellRepository = null;

    
    public function initializeAction() {

        parent::initializeAction(); //DO NOT FORGET!

        if ($this->arguments->hasArgument('newInmate') || $this->arguments->hasArgument('inmate')) {
            $argument = ($this->arguments->hasArgument('inmate')) ? "inmate" : "newInmate";
            // fix dates from imput
            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('dateOfBirth')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'d.m.Y');
            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('dayOfPassing')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'d.m.Y');
            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('prisonStart')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'d.m.Y');
            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('prisonEnd')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'d.m.Y');
        }
    }
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $inmates = $this->inmateRepository->findAll();
        $this->view->assign('inmates', $inmates);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $this->view->assign('prisonCells', $this->prisonCellRepository->findAll());
    }

    /**
     * action create
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $newInmate
     * @return void
     */
    public function createAction(\Visit\VisitTablets\Domain\Model\Inmate $newInmate)
    {
        //$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->inmateRepository->add($newInmate);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmate
     * @ignorevalidation $inmate
     * @return void
     */
    public function editAction(\Visit\VisitTablets\Domain\Model\Inmate $inmate)
    {
        $this->view
            ->assign('inmate', $inmate)
            ->assign('prisonCells', $this->prisonCellRepository->findAll());
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmate
     * @return void
     */
    public function updateAction(\Visit\VisitTablets\Domain\Model\Inmate $inmate)
    {
//        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->inmateRepository->update($inmate);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmate
     * @return void
     */
    public function deleteAction(\Visit\VisitTablets\Domain\Model\Inmate $inmate)
    {
        $this->inmateRepository->remove($inmate);
        $this->redirect('list');
    }


    /**
     * action settings
     *
     * @return void
     */
    public function settingsAction(){
        $this->view->assign('title', Util::getConfigForAllLanguages("title"));
        $this->view->assign('imprint', Util::getConfigForAllLanguages("imprint"));
        $this->view->assign('splash', Util::getConfigForAllLanguages("splash"));

    }

    /**
     * action updateSettings
     *
     * @return void
     */
    public function updateSettingsAction(){

        $this->configRepository->processRequest($this->request, "title");
        $this->configRepository->processRequest($this->request, "imprint");
        $this->configRepository->processRequest($this->request, "splash");

        $this->addFlashMessage("Änderungen gespeichert", '', AbstractMessage::INFO);

        $this->redirect('settings');

    }

    /**
     * action renderFrontend
     * @allowAllUsers
     *
     * @return void
     */
    public function renderFrontendAction()
    {
        $this->addSettingsForTablets();

        $persons = json_decode(
            file_get_contents("typo3conf/ext/visit_tablets/Resources/Public/SampleData/MOCK_DATA.json"),
            true
        );

        \usort($persons, function($a, $b){
            return \strcmp($a["first_name"], $b["first_name"]);
        });



        $out = [];
        foreach ($persons  as $person){
            $current =  \strtoupper($person["first_name"][0]);
            if(! \array_key_exists($current, $out)){
                $out[$current] = array();
            }
            $out[$current][] = $person;
        }

        $this->view
            ->assign('persons', $out);

    }


}
