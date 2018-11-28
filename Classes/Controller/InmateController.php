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

/**
 * InmateController
 */
class InmateController extends AbstractVisitController {
    /**
     * inmateRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\InmateRepository
     * @inject
     */
    protected $inmateRepository = null;

    
    public function initializeAction() {
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
        $this->view->assign('inmate', $inmate);
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
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->inmateRepository->remove($inmate);
        $this->redirect('list');
    }
}
