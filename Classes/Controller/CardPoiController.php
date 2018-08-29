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
 * CardPoiController
 */
class CardPoiController extends AbstractVisitController {
    /**
     * cardPoiRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\CardPoiRepository
     * @inject
     */
    protected $cardPoiRepository = null;

    /**
     * action showOnCard
     *
     * @return void
     */
    public function showOnCardAction(){
        $this->view->assign('cardPois', $this->cardPoiRepository->findAll());
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction(){
        $cardPois = $this->cardPoiRepository->findAll();
        $this->view->assign('cardPois', $cardPois);
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
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $newCardPoi
     * @return void
     */
    public function createAction(\Visit\VisitTablets\Domain\Model\CardPoi $newCardPoi)
    {
        $this->addImageFromTempToModel($newCardPoi);
        $this->addFlashMessage('Karten Element angelegt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->cardPoiRepository->add($newCardPoi);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @ignorevalidation $cardPoi
     * @return void
     */
    public function editAction(\Visit\VisitTablets\Domain\Model\CardPoi $cardPoi)
    {
        $this->view->assign('cardPoi', $cardPoi);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @return void
     */
    public function updateAction(\Visit\VisitTablets\Domain\Model\CardPoi $cardPoi)
    {
        $this->addImageFromTempToModel($cardPoi);
        $this->addFlashMessage('Änderungen wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->cardPoiRepository->update($cardPoi);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @return void
     */
    public function deleteAction(\Visit\VisitTablets\Domain\Model\CardPoi $cardPoi)
    {
        $this->addFlashMessage('Eintrag wurde gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->cardPoiRepository->remove($cardPoi);
        $this->redirect('list');
    }
}
