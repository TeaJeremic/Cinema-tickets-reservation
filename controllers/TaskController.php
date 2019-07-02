<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\NotificationModel;

class TaskController extends Controller {
    public function sendNotifications($secretKey) {
        
        $hash = strtoupper(hash('sha512', $secretKey));

        if ($hash != '580C57A4B6357B16CD88FB5328EA0AFB2D5D0A0DB329D1110E4E5F53D964D0D4375A3C9F5155004D0A41C49CFED731A5A9BB4118C4C41E5EE15FE162F929B8EC') {
            die('KEY ERROR');
        }

        $nm = new NotificationModel($this->getDatabaseConnection());
        $unsentNotifications = $nm->getAllByFieldName('is_sent', 0);
        
        foreach ($unsentNotifications as $notification) {
            $res = $this->sendNotification($notification);

            if ($res) {
                $nm->editById($notification->notification_id, [
                    'is_sent' => 1
                ]);
            }
        }

        die('DONE');
    }

    private function sendNotification($notification) {
        echo "Sending notification " . $notification->notification_id . '...<br>';

        $mailer = new \PHPMailer\PHPMailer\PHPMailer();
        $mailer->isSMTP();
        $mailer->SMTPAuth = true;
        $mailer->Host = \Configuration::MAIL_HOST;
        $mailer->Port = \Configuration::MAIL_PORT;
        $mailer->SMTPSecure = \Configuration::MAIL_PROTOCOL;
        $mailer->Username = \Configuration::MAIL_USERNAME;
        $mailer->Password = \Configuration::MAIL_PASSWORD;

        $mailer->Subject = $notification->subject;
        $mailer->isHTML();
        $mailer->Body = $notification->content;
        $mailer->setFrom(\Configuration::MAIL_USERNAME, 'Milan Tair - studentska adresa');
        $mailer->addAddress($notification->email);

        return $mailer->send();
    }
}
