<?php
namespace Visit\VisitTablets\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Kris Raich 
 */
class CardPoiControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Visit\VisitTablets\Controller\CardPoiController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Visit\VisitTablets\Controller\CardPoiController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllCardPoisFromRepositoryAndAssignsThemToView()
    {

        $allCardPois = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cardPoiRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\CardPoiRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $cardPoiRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCardPois));
        $this->inject($this->subject, 'cardPoiRepository', $cardPoiRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('cardPois', $allCardPois);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenCardPoiToCardPoiRepository()
    {
        $cardPoi = new \Visit\VisitTablets\Domain\Model\CardPoi();

        $cardPoiRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\CardPoiRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $cardPoiRepository->expects(self::once())->method('add')->with($cardPoi);
        $this->inject($this->subject, 'cardPoiRepository', $cardPoiRepository);

        $this->subject->createAction($cardPoi);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenCardPoiToView()
    {
        $cardPoi = new \Visit\VisitTablets\Domain\Model\CardPoi();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('cardPoi', $cardPoi);

        $this->subject->editAction($cardPoi);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenCardPoiInCardPoiRepository()
    {
        $cardPoi = new \Visit\VisitTablets\Domain\Model\CardPoi();

        $cardPoiRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\CardPoiRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $cardPoiRepository->expects(self::once())->method('update')->with($cardPoi);
        $this->inject($this->subject, 'cardPoiRepository', $cardPoiRepository);

        $this->subject->updateAction($cardPoi);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenCardPoiFromCardPoiRepository()
    {
        $cardPoi = new \Visit\VisitTablets\Domain\Model\CardPoi();

        $cardPoiRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\CardPoiRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $cardPoiRepository->expects(self::once())->method('remove')->with($cardPoi);
        $this->inject($this->subject, 'cardPoiRepository', $cardPoiRepository);

        $this->subject->deleteAction($cardPoi);
    }
}
