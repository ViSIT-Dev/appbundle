<?php
namespace Visit\VisitTablets\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Kris Raich 
 */
class PrisonCellControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Visit\VisitTablets\Controller\PrisonCellController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Visit\VisitTablets\Controller\PrisonCellController::class)
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
    public function listActionFetchesAllPrisonCellsFromRepositoryAndAssignsThemToView()
    {

        $allPrisonCells = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $prisonCellRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\PrisonCellRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $prisonCellRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPrisonCells));
        $this->inject($this->subject, 'prisonCellRepository', $prisonCellRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('prisonCells', $allPrisonCells);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPrisonCellToView()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('prisonCell', $prisonCell);

        $this->subject->showAction($prisonCell);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPrisonCellToPrisonCellRepository()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();

        $prisonCellRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\PrisonCellRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $prisonCellRepository->expects(self::once())->method('add')->with($prisonCell);
        $this->inject($this->subject, 'prisonCellRepository', $prisonCellRepository);

        $this->subject->createAction($prisonCell);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPrisonCellToView()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('prisonCell', $prisonCell);

        $this->subject->editAction($prisonCell);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPrisonCellInPrisonCellRepository()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();

        $prisonCellRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\PrisonCellRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $prisonCellRepository->expects(self::once())->method('update')->with($prisonCell);
        $this->inject($this->subject, 'prisonCellRepository', $prisonCellRepository);

        $this->subject->updateAction($prisonCell);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPrisonCellFromPrisonCellRepository()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();

        $prisonCellRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\PrisonCellRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $prisonCellRepository->expects(self::once())->method('remove')->with($prisonCell);
        $this->inject($this->subject, 'prisonCellRepository', $prisonCellRepository);

        $this->subject->deleteAction($prisonCell);
    }
}
