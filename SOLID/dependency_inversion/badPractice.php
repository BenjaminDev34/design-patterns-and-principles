<?php

class Mailer
{
    public function sendMail(): string
    {
        echo "Sending mail";
        return "Mail sent successfully";
    }
}

class Notification
{
    public function __construct(private Mailer $mailer)
    {
        $this->mailer = new Mailer();
    }

    private function trackNotification(): int
    {
        return mt_rand(1, 100);
    }

    public function sendNotification(): string
    {
        $trackingNumber = $this->trackNotification();
        echo "Sending notification with tracking number: $trackingNumber";
        return $this->mailer->sendMail();
    }
}