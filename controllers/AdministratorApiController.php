<?php
namespace App\Controllers;

use App\Core\ApiController;
use App\Models\ProjekcijaModel;
use App\Models\RezervacijaModel;
use App\Models\UserModel;
use App\Models\NotificationModel;

class UserAuctionApiController extends ApiController {
    private function respond($errorCode, $message = '', $data = null) {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode([
            'error'   => $errorCode,
            'message' => $message,
            'data'    => $data
        ]);
        exit;
    }

    public function __pre() {
        if (!$this->getSession()->get('userId', null)) {
            $this->respond(-1001, 'You are not logged it!');
        }
    }

    public function postBid() {
        $auctionId = \filter_input(INPUT_POST, 'auction_id', FILTER_SANITIZE_NUMBER_INT);
        $amount    = \filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);

        $am = new AuctionModel($this->getDatabaseConnection());
        $auction = $am->getById($auctionId);

        if (!$am->isActive($auction)) {
            $this->respond(-1002, 'Inactive auction!');
        }

        if ($auction->user_id == $this->getSession()->get('userId')) {
            $this->respond(-1003, 'You cannot bid on your own auction!');
        }

        $om = new OfferModel($this->getDatabaseConnection());
        $offers = $om->getAllByAuctionId($auctionId);
        
        $price = $auction->starting_price;

        if (count($offers) > 0) {
            $lastOffer = $offers[ count($offers) - 1 ];
            $price = $lastOffer->price;
        }

        if ($price > $amount - 50) {
            $this->respond(-1004, 'You must bid at least 50 RSD more that the current maximum price!');
        }

        $offerId = $om->add([
            'auction_id' => $auctionId,
            'user_id'    => $this->getSession()->get('userId'),
            'price'      => $amount,
        ]);

        $mailSent = $this->sendAnEmailNotification($auction, $amount);

        $message = 'Bidding was successful';
        if ($mailSent) {
            $message .= ' and the owner was notified';
        }

        $this->respond(0, $message . '.', $offerId);
    }

    private function sendAnEmailNotification(&$auction, $amount) {
        $nm = new NotificationModel($this->getDatabaseConnection());

        $um = new UserModel($this->getDatabaseConnection());
        $user = $um->getById($auction->user_id);

        $html = '<p>Na Vašu aukciju &quot;' . htmlspecialchars($auction->title) .
                '&quot; je neko licitirao sa iznosom ' . $amount . ' RSD.</p>';

        $nm->add([
            'email'   => $user->email,
            'subject' => 'Nova licitacija',
            'content' => $html
        ]);
    }
}
