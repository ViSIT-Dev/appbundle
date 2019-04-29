<?php

namespace Visit\VisitTablets\Domain\Repository;

/* * *
 *
 * This file is part of the "fernrohr" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Robert Kathrein
 *
 * * */

/**
 * The repository for Galery Content Elements
 */
class GaleryContentSubElementRepository extends AbstractVisitRepository {

    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    public function findAllEager() {
        $query = $this->createQuery();
        return $query->execute(true);
    }

}
