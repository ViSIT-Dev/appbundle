<?php
namespace Visit\VisitTablets\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Kris Raich 
 */
class PrisonCellTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Visit\VisitTablets\Domain\Model\PrisonCell
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Visit\VisitTablets\Domain\Model\PrisonCell();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );

    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getImatesReturnsInitialValueForInmate()
    {
        self::assertEquals(
            null,
            $this->subject->getImates()
        );

    }

    /**
     * @test
     */
    public function setImatesForInmateSetsImates()
    {
        $imatesFixture = new \Visit\VisitTablets\Domain\Model\Inmate();
        $this->subject->setImates($imatesFixture);

        self::assertAttributeEquals(
            $imatesFixture,
            'imates',
            $this->subject
        );

    }
}
