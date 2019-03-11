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
 * The repository for CardPois
 */
class ScopePoiRepository extends AbstractVisitRepository {

    public function findAllEager() {
        $query = $this->createQuery();
        return $query->execute(true);
    }

}
