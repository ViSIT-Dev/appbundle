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
 * PrisonCellController
 */
class PrisonCellController extends AbstractVisitController {
    /**
     * prisonCellRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\PrisonCellRepository
     * @inject
     */
    protected $prisonCellRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $prisonCells = $this->prisonCellRepository->findAll();
        $this->view->assign('prisonCells', $prisonCells);
    }

    /**
     * action show
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function showAction(\Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell)
    {
        $this->view->assign('prisonCell', $prisonCell);
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
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $newPrisonCell
     * @return void
     */
    public function createAction(\Visit\VisitTablets\Domain\Model\PrisonCell $newPrisonCell)
    {
//        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->prisonCellRepository->add($newPrisonCell);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @ignorevalidation $prisonCell
     * @return void
     */
    public function editAction(\Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell)
    {
        $this->view->assign('prisonCell', $prisonCell);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function updateAction(\Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell)
    {
//        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->prisonCellRepository->update($prisonCell);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function deleteAction(\Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->prisonCellRepository->remove($prisonCell);
        $this->redirect('list');
    }
}
