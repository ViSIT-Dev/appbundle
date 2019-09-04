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

use \Visit\VisitTablets\Domain\Model\Event;

/**
 * PrisonCellController
 */
class EventController extends AbstractVisitController {

    /**
     * eventRepository
     *
     * @var \Visit\VisitTablets\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $events = $this->eventRepository->findAll();
        $this->view->assign('events', $events);
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
     * @param \Visit\VisitTablets\Domain\Model\Event $newEvent
     * @return void
     */
    public function createAction(Event $newEvent)
    {
        $this->eventRepository->add($newEvent);
        $this->redirect('list');
    }



    /**
     * action edit
     *
     * @param \Visit\VisitTablets\Domain\Model\Event $event
     * @return void
     */
    public function editAction(Event $event)
    {
        $this->view->assign('event', $event);
    }

    /**
     * action update
     *
     * @param \Visit\VisitTablets\Domain\Model\Event $event
     * @return void
     */
    public function updateAction(Event $event)
    {
        $this->addFlashMessage('Änderungen wurden gespeichert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->eventRepository->update($event);
        $this->redirect("edit", null, null, array("event" => $event));
    }

    /**
     * action delete
     *
     * @param \Visit\VisitTablets\Domain\Model\Event $event
     * @return void
     */
    public function deleteAction(Event $event)
    {
        $this->addFlashMessage('Event gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->eventRepository->remove($event);
        $this->redirect('list');
    }
}
