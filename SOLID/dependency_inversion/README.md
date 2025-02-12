# Dependency Inversion 

The Dependency Inversion stands for D in the SOLID design pattern.

## Definition

In simple terms, the Dependency Inversion Principle means that high-level classes shouldn't depend on low-level classes. Instead, both should depend on abstractions, like interfaces or abstract classes.

This way we are making our classes dependant of the abstract signature and not a practical implementation of it, the code is more flexible and scalable.


## Bad Practice :no_entry:

```php
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
```

This code is a perfect example of a violation of the Dependency Inversion Principle. The Notification class directly depends on the Mailer class, creating a tight coupling between them. This makes the code harder to extend because if, in the future, I want to send notifications via SMS or social media, I would have to modify the Notification class.

## ✅ Solution: using the interface signature


```php
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
```

## Why is it better ?

1. It's much more flexible—Notification doesn't need to know whether it's using an email, SMS, or any other communication service. It simply calls the send method. As long as the injected class implements MessageInterface, it will work .
2. We can now add a tons of other Services, Notification will always work.
3. Notification depends on an abstraction, not a direct concrete implementation.