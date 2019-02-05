<?php
namespace Visit\VisitTablets\Controller;

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
 * GalleryController
 */
class GalleryController extends AbstractVisitController  implements IRenderFrontend{


    /**
     * action renderFrontend
     * @allowAllUsers
     *
     * @return void
     */
    public function renderFrontendAction()
    {
        $this->view->assign('title', "test");
    }

}
