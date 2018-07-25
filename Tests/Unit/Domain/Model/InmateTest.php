<?php
namespace Visit\VisitTablets\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Kris Raich 
 */
class InmateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Visit\VisitTablets\Domain\Model\Inmate
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Visit\VisitTablets\Domain\Model\Inmate();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getFirstNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFirstName()
        );

    }

    /**
     * @test
     */
    public function setFirstNameForStringSetsFirstName()
    {
        $this->subject->setFirstName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'firstName',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLastNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLastName()
        );

    }

    /**
     * @test
     */
    public function setLastNameForStringSetsLastName()
    {
        $this->subject->setLastName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lastName',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getDateOfBirthReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDateOfBirth()
        );

    }

    /**
     * @test
     */
    public function setDateOfBirthForDateTimeSetsDateOfBirth()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDateOfBirth($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'dateOfBirth',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPlaceOfBirthReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPlaceOfBirth()
        );

    }

    /**
     * @test
     */
    public function setPlaceOfBirthForStringSetsPlaceOfBirth()
    {
        $this->subject->setPlaceOfBirth('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'placeOfBirth',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getNationalityReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNationality()
        );

    }

    /**
     * @test
     */
    public function setNationalityForStringSetsNationality()
    {
        $this->subject->setNationality('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nationality',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getDayOfPassingReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDayOfPassing()
        );

    }

    /**
     * @test
     */
    public function setDayOfPassingForStringSetsDayOfPassing()
    {
        $this->subject->setDayOfPassing('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'dayOfPassing',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getProfessionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getProfession()
        );

    }

    /**
     * @test
     */
    public function setProfessionForStringSetsProfession()
    {
        $this->subject->setProfession('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'profession',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPrisonStartReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getPrisonStart()
        );

    }

    /**
     * @test
     */
    public function setPrisonStartForDateTimeSetsPrisonStart()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setPrisonStart($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'prisonStart',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPrisonEndReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getPrisonEnd()
        );

    }

    /**
     * @test
     */
    public function setPrisonEndForDateTimeSetsPrisonEnd()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setPrisonEnd($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'prisonEnd',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getSubtitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSubtitle()
        );

    }

    /**
     * @test
     */
    public function setSubtitleForStringSetsSubtitle()
    {
        $this->subject->setSubtitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'subtitle',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getTeasertextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTeasertext()
        );

    }

    /**
     * @test
     */
    public function setTeasertextForStringSetsTeasertext()
    {
        $this->subject->setTeasertext('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'teasertext',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getTextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getText()
        );

    }

    /**
     * @test
     */
    public function setTextForStringSetsText()
    {
        $this->subject->setText('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'text',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getImageReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getImage()
        );

    }

    /**
     * @test
     */
    public function setImageForFileReferenceSetsImage()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setImage($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'image',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getVipReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getVip()
        );

    }

    /**
     * @test
     */
    public function setVipForBoolSetsVip()
    {
        $this->subject->setVip(true);

        self::assertAttributeEquals(
            true,
            'vip',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPrisonCellReturnsInitialValueForPrisonCell()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPrisonCell()
        );

    }

    /**
     * @test
     */
    public function setPrisonCellForObjectStorageContainingPrisonCellSetsPrisonCell()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();
        $objectStorageHoldingExactlyOnePrisonCell = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePrisonCell->attach($prisonCell);
        $this->subject->setPrisonCell($objectStorageHoldingExactlyOnePrisonCell);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOnePrisonCell,
            'prisonCell',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addPrisonCellToObjectStorageHoldingPrisonCell()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();
        $prisonCellObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $prisonCellObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($prisonCell));
        $this->inject($this->subject, 'prisonCell', $prisonCellObjectStorageMock);

        $this->subject->addPrisonCell($prisonCell);
    }

    /**
     * @test
     */
    public function removePrisonCellFromObjectStorageHoldingPrisonCell()
    {
        $prisonCell = new \Visit\VisitTablets\Domain\Model\PrisonCell();
        $prisonCellObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $prisonCellObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($prisonCell));
        $this->inject($this->subject, 'prisonCell', $prisonCellObjectStorageMock);

        $this->subject->removePrisonCell($prisonCell);

    }
}
