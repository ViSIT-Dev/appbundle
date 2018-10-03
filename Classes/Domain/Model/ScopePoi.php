<?php

namespace Visit\VisitTablets\Domain\Model;

/***
 *
 * This file is part of the "fernrohr" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Robert Kathrein
 *
 ***/

/**
 * CardPoi
 */
class ScopePoi extends AbstractEntityWithMedia {
    
    /**
     * title
     * @validate NotEmpty
     * @var string
     */
    protected $title = '';

    /**
     * subTitle
     *
     * @var string
     */
    protected $subTitle = '';

    /**
     * x
     * @validate NotEmpty
     * @var int
     */
    protected $x = 0;

    /**
     * y
     * @validate NotEmpty
     * @var int
     */
    protected $y = 0;
    
    /**
     * radius
     * @validate NotEmpty
     * @var int
     */
    protected $radius = 0;

    /**
     * description
     * @validate NotEmpty
     * @var string
     */
    protected $description = '';

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the x
     *
     * @return int $x
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Sets the x
     *
     * @param int $x
     * @return void
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * Returns the y
     *
     * @return int $y
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Sets the y
     *
     * @param int $y
     * @return void
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    
    /**
     * Sets the radius
     *
     * @param int $radius
     * @return void
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * Returns the radius
     *
     * @return int $radius
     */
    public function getRadius()
    {
        return $this->radius;
    }
    
    /**
     * Returns the radius
     *
     * @return int $radius
     */
    public function getRadiusHalf()
    {
        return $this->radius / 2;
    }
    
    /**
     * Returns the subTitle
     *
     * @return string $subTitle
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Sets the subTitle
     *
     * @param string $subTitle
     * @return void
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
}
