<?php
namespace Visit\VisitTablets\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Kris Raich 
 */
class CardPoiTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Visit\VisitTablets\Domain\Model\CardPoi
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Visit\VisitTablets\Domain\Model\CardPoi();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );

    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLongitudeReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLongitude()
        );

    }

    /**
     * @test
     */
    public function setLongitudeForFloatSetsLongitude()
    {
        $this->subject->setLongitude(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'longitude',
            $this->subject,
            '',
            0.000000001
        );

    }

    /**
     * @test
     */
    public function getLatitudeReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLatitude()
        );

    }

    /**
     * @test
     */
    public function setLatitudeForFloatSetsLatitude()
    {
        $this->subject->setLatitude(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'latitude',
            $this->subject,
            '',
            0.000000001
        );

    }

    /**
     * @test
     */
    public function getFlagTextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFlagText()
        );

    }

    /**
     * @test
     */
    public function setFlagTextForStringSetsFlagText()
    {
        $this->subject->setFlagText('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'flagText',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getSubTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSubTitle()
        );

    }

    /**
     * @test
     */
    public function setSubTitleForStringSetsSubTitle()
    {
        $this->subject->setSubTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'subTitle',
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
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );

    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );

    }
}
