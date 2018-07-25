<?php
namespace Visit\VisitTablets\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Kris Raich 
 */
class InmateControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Visit\VisitTablets\Controller\InmateController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Visit\VisitTablets\Controller\InmateController::class)
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
    public function listActionFetchesAllInmatesFromRepositoryAndAssignsThemToView()
    {

        $allInmates = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $inmateRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\InmateRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $inmateRepository->expects(self::once())->method('findAll')->will(self::returnValue($allInmates));
        $this->inject($this->subject, 'inmateRepository', $inmateRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('inmates', $allInmates);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenInmateToInmateRepository()
    {
        $inmate = new \Visit\VisitTablets\Domain\Model\Inmate();

        $inmateRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\InmateRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $inmateRepository->expects(self::once())->method('add')->with($inmate);
        $this->inject($this->subject, 'inmateRepository', $inmateRepository);

        $this->subject->createAction($inmate);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenInmateToView()
    {
        $inmate = new \Visit\VisitTablets\Domain\Model\Inmate();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('inmate', $inmate);

        $this->subject->editAction($inmate);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenInmateInInmateRepository()
    {
        $inmate = new \Visit\VisitTablets\Domain\Model\Inmate();

        $inmateRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\InmateRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $inmateRepository->expects(self::once())->method('update')->with($inmate);
        $this->inject($this->subject, 'inmateRepository', $inmateRepository);

        $this->subject->updateAction($inmate);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenInmateFromInmateRepository()
    {
        $inmate = new \Visit\VisitTablets\Domain\Model\Inmate();

        $inmateRepository = $this->getMockBuilder(\Visit\VisitTablets\Domain\Repository\InmateRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $inmateRepository->expects(self::once())->method('remove')->with($inmate);
        $this->inject($this->subject, 'inmateRepository', $inmateRepository);

        $this->subject->deleteAction($inmate);
    }
}
