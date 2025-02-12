<?php

interface MessageInterface {
    public function send() :string;
}

class Email implements MessageInterface {
    public function send() :string{
        return "Email sent";
    }
}

class SMS implements MessageInterface {
    public function send() :string{
        return "SMS sent";
    }
}

readonly class NotificationService{
    public function __construct(private MessageInterface $message){}

    private function trackNotification(): int
    {
        return mt_rand(1, 100);
    }
    public function send() :string{
        $trackingNumber = $this->trackNotification();
        echo "Sending notification with tracking number: $trackingNumber";
        return $this->message->send();
    }
}

$notification = new NotificationService(new Email());
echo $notification->send();