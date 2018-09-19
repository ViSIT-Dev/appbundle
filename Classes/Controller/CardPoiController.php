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

use \Visit\VisitTablets\Domain\Model\CardPoi;

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
        $out = array();
        
        /* @var $cardPoi \Visit\VisitTablets\Domain\Model\CardPoi */
        foreach ($this->cardPoiRepository->findAll() as $cardPoi) {
            $out[$cardPoi->getUid()] = [
                "title" => $cardPoi->getTitle(),
                "subTitle" => $cardPoi->getSubTitle(),
                "flagText" => $cardPoi->getFlagText(),
                "description" => $cardPoi->getDescription(),
                "latlng" => [
                    "lat" => $cardPoi->getLatitude(), 
                    "lng" => $cardPoi->getLongitude()]
            ];
        }
        
        $this->view->assign('cardPois', \json_encode($out));
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
    public function createAction(CardPoi $newCardPoi)
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
    public function editAction(CardPoi $cardPoi)
    {
        $this->view->assign('cardPoi', $cardPoi);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @return void
     */
    public function updateAction(CardPoi $cardPoi)
    {
        $this->addImageFromTempToModel($cardPoi);
        $this->addFlashMessage('Änderungen wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->cardPoiRepository->update($cardPoi);
        $this->redirect("edit", null, null, array("cardPoi" => $cardPoi));
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi
     * @return void
     */
    public function deleteAction(CardPoi $cardPoi)
    {
        $this->addFlashMessage('Eintrag wurde gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->cardPoiRepository->remove($cardPoi);
        $this->redirect('list');
    }

    /**
     * action deleteImage
     *
     * @param \Visit\VisitTablets\Domain\Model\CardPoi $cardPoi,  \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function deleteImageAction(CardPoi $cardPoi, \TYPO3\CMS\Extbase\Domain\Model\FileReference $media)
    {
        $this->addFlashMessage('Media wurde entfernt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->removeImageFromModel($cardPoi, $media);
        $this->cardPoiRepository->update($cardPoi);
        $this->redirect("edit", null, null, array("cardPoi" => $cardPoi));
    }
    
    
    
    /**
     * action renderFronten
     * @allowAllUsers
     * 
     * @return void
     */
    public function renderFrontendAction()
    {
        $this->view->assign("test", true);
    }
    
}
