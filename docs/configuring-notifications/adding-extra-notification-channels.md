---
title: Adding extra notification channels
weight: 3
---

By default the package can send notifications via mail or Slack. You can easily add any other
[Laravel notification channel](https://laravel-notification-channels.com) such as Telegram or Pusher.

### 1. Install the notification channel driver

For example, to use Pusher push notifications install the channel package:

```bash
composer require laravel-notification-channels/pusher-push-notifications
```

### 2. Create your own notification class

Extend `Spatie\Health\Notifications\CheckFailedNotification` and implement a method
for the channel you want to use.

```php
namespace App\Notifications;

use Spatie\Health\Notifications\CheckFailedNotification as BaseNotification;
use NotificationChannels\PusherPushNotifications\Message;

class CheckFailedNotification extends BaseNotification
{
    public function toPushNotification($notifiable)
    {
        return Message::create()
            ->iOS()
            ->badge(1)
            ->sound('fail')
            ->body("The health check has failed");
    }
}
```

### 3. Register the notification in the config file

Reference your notification class and the channel in `config/health.php`.

```php
use NotificationChannels\PusherPushNotifications\Channel as PusherChannel;

// ...
'notifications' => [
    App\Notifications\CheckFailedNotification::class => ['mail', 'slack', PusherChannel::class],
],
```
