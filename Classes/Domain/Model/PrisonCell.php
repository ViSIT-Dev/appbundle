<?php
namespace Visit\VisitTablets\Domain\Model;

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
 * PrisonCell
 */
class PrisonCell extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * imates
     *
     * @var \Visit\VisitTablets\Domain\Model\Inmate
     * @lazy
     */
    protected $imates = null;

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the imates
     *
     * @return \Visit\VisitTablets\Domain\Model\Inmate $imates
     */
    public function getImates()
    {
        return $this->imates;
    }

    /**
     * Sets the imates
     *
     * @param \Visit\VisitTablets\Domain\Model\Inmate $imates
     * @return void
     */
    public function setImates(\Visit\VisitTablets\Domain\Model\Inmate $imates)
    {
        $this->imates = $imates;
    }
}
