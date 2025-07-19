---
title: Customizing the notifiable
weight: 5
---

Notifications are sent to a notifiable class. The package uses
`Spatie\Health\Notifications\Notifiable` by default. This class reads the
configuration values from `config/health.php` to determine where
notifications should be delivered.

If your custom notification channel needs extra information you can
extend the default notifiable and add the required routing method.

```php
namespace App\Notifications;

use Spatie\Health\Notifications\Notifiable;

class HealthNotifiable extends Notifiable
{
    public function routeNotificationForAnotherChannel()
    {
        return config('health.notifications.another_channel.property');
    }
}
```

Register your notifiable in the config file:

```php
// in config/health.php
'notifications' => [
    // ...
    'notifiable' => App\Notifications\HealthNotifiable::class,
],
```
