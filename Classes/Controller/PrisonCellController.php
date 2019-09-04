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

use \Visit\VisitTablets\Domain\Model\PrisonCell;

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
    public function createAction(PrisonCell $newPrisonCell)
    {
        $this->prisonCellRepository->add($newPrisonCell);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function editAction(PrisonCell $prisonCell)
    {
        $this->view->assign('prisonCell', $prisonCell);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function updateAction(PrisonCell $prisonCell)
    {
        $this->addFlashMessage('Änderungen wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->prisonCellRepository->update($prisonCell);
        $this->redirect("edit", null, null, array("prisonCell" => $prisonCell));
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\PrisonCell $prisonCell
     * @return void
     */
    public function deleteAction(PrisonCell $prisonCell)
    {
        $this->addFlashMessage('Zelle gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->prisonCellRepository->remove($prisonCell);
        $this->redirect('list');
    }
}
