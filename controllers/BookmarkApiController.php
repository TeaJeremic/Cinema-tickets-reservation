<?php
namespace App\Controllers;

use App\Core\ApiController;
use App\Models\ProjekcijaModel;

class BookmarkApiController extends ApiController {
    public function getBookmarks() {
        $bookmarks = $this->getSession()->get('bookmarks', []);
        $this->set('bookmarks', $bookmarks);
        $this->set('error', 0);
    }

    public function addBookmark($auctionId) {
        $bookmarks = $this->getSession()->get('bookmarks', []);

        $am = new AuctionModel($this->getDatabaseConnection());
        $auction = $am->getById($auctionId);

        if (!$auction) {
            $this->set('error', -1);
            return;
        }

        $bookmarks[] = $auction;

        $this->getSession()->put('bookmarks', $bookmarks);
        $this->set('error', 0);
    }

    public function clear() {
        $this->getSession()->put('bookmarks', []);
        $this->set('error', 0);
    }
}
