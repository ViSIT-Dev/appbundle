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
use Visit\VisitTablets\Helper\Util;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;

/**
 * CardPoiController
 */
class CardPoiController extends AbstractVisitController implements IRenderFrontend {

    /**
     * cardPoiRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\CardPoiRepository
     * @inject
     */
    protected $cardPoiRepository = null;

    /**
     * configRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\ConfigRepository
     * @inject
     */
    protected $configRepository = null;


    private function prepareForFrontend(){
        $out = array();

        $cardBois = $this->cardPoiRepository->findAll();

        /* @var $cardPoi \Visit\VisitTablets\Domain\Model\CardPoi */
        foreach ($cardBois as $cardPoi) {

            $out[$cardPoi->getLanguage()][$cardPoi->getUid()] = [
                "uid" => $cardPoi->getUid(),
                "flagText" => $cardPoi->getFlagText(),
                "latlng" => [
                    "lat" => $cardPoi->getLatitude(),
                    "lng" => $cardPoi->getLongitude()
                ]
            ];
        }

        $this->view
            ->assign('languages',  \json_encode(Util::getLanguages()))
            ->assign('cardPoisJson', \json_encode($out))
            ->assign('dataPoints', $cardBois);
    }

    /**
     * action showOnCard
     *
     * @return void
     */
    public function showOnCardAction(){
       $this->prepareForFrontend();
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
     * action new
     *
     * @return void
     */
    public function newAction(){

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
     * action renderFrontend
     * @allowAllUsers
     * 
     * @return void
     */
    public function renderFrontendAction()
    {
        $this->prepareForFrontend();

        //add pwa manifest
        $this->response->addAdditionalHeaderData('<link rel="manifest" href="/typo3conf/ext/visit_tablets/Resources/Public/manifest.json" />');
        $this->response->addAdditionalHeaderData('<script href="/typo3conf/ext/visit_tablets/Resources/Public/js/cache.js" type="text/javascript"></script>');
        $this->response->addAdditionalHeaderData('<meta name="apple-mobile-web-app-capable" content="yes">');

        $this->view->assign('title', Util::getConfigForAllLanguages("title"));
        $this->view->assign('imprint', Util::getConfigForAllLanguages("imprint"));
        $this->view->assign('splash', Util::getConfigForAllLanguages("splash"));
    }
    
}
