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

use Visit\VisitTablets\Domain\Model\Inmate;
use Visit\VisitTablets\Helper\Util;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;

/**
 * InmateController
 */
class InmateController extends AbstractVisitController  implements IRenderFrontend{


//    public static $DATE_PICKER_FORMAT = "d.m.Y";

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

    /**
     * eventRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    
    public function initializeAction() {

        parent::initializeAction(); //DO NOT FORGET!

        if ($this->arguments->hasArgument('newInmate') || $this->arguments->hasArgument('inmate')) {
            $argument = ($this->arguments->hasArgument('inmate')) ? "inmate" : "newInmate";
            // fix dates from imput
//            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('dateOfBirth')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, self::$DATE_PICKER_FORMAT);
//            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('dateOfPassing')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,self::$DATE_PICKER_FORMAT);
//            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('dateOfImprisonment')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,self::$DATE_PICKER_FORMAT);
//            $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('dateOfRelease')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,self::$DATE_PICKER_FORMAT);
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
        $this->view
            ->assign('prisonCells', $this->prisonCellRepository->findAll())
            ->assign('events', $this->eventRepository->findAll());
    }

    /**
     * action create
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $newInmate
     * @return void
     */
    public function createAction(Inmate $newInmate)
    {
        $this->addImageFromTempToModel($newInmate);
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
    public function editAction(Inmate $inmate)
    {
        $this->view
            ->assign('inmate', $inmate)
            ->assign('prisonCells', $this->prisonCellRepository->findAll())
            ->assign('events', $this->eventRepository->findAll());
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmate
     * @return void
     */
    public function updateAction(Inmate $inmate)
    {
        $this->addImageFromTempToModel($inmate);
        $this->inmateRepository->update($inmate);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $inmate
     * @return void
     */
    public function deleteAction(Inmate $inmate)
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
        $this->view->assign('showLangSwitch', Util::getConfig("showLangSwitch"));
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
        $this->configRepository->addOrUpdate("showLangSwitch", $this->request->getArgument("showLangSwitch"));
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

        $out = [];
        /** @var Inmate $inmate */
        foreach ($this->inmateRepository->findAll() as $inmate){
            $current =  \strtoupper($inmate->getLastName()[0]);


            if(empty($current)){
                $current = \strtoupper($inmate->getFirstName()[0]);
            }
            if(empty($current)){
                //if no name skip
                continue;
            }
//            $current = iconv("utf-8","ascii//TRANSLIT",$current);
            $current = utf8_encode($current);

            if(\ord($current) < 65 || \ord($current) > 90){
                $current = "#";
            }

            if(! \array_key_exists($current, $out)){
                $out[$current] = array();
            }
            $out[$current][] = $inmate;
        }

        \ksort($out);
        if($out['#']){
            $specialLang = \array_shift($out);
            $out['#'] = $specialLang;
        }

//        Util::debug($out);

        $this->view
            ->assign('persons', $out)
            ->assign('events', $this->eventRepository->findAll())
            ->assign('cells', $this->prisonCellRepository->findAll());

    }


}
