<?php
namespace Visit\VisitTablets\Domain\Repository;

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
 * The repository for Inmates
 */
class InmateRepository extends AbstractVisitRepository{

    protected $defaultOrderings = array(
        'firstName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

}
