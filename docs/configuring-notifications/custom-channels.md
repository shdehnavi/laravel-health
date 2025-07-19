---
title: Custom channels
weight: 5
---

The `notifications.custom_channels` option in the `health` config file allows you to configure additional notification channels. The key should match the channel name and the value will be returned from the notifiable's `routeNotificationFor{Channel}` method.

For example, to send notifications via Telegram you can install a notification channel such as [`laravel-notification-channels/telegram`](https://github.com/laravel-notification-channels/telegram) and configure the chat identifier:

```php
// in config/health.php

'notifications' => [
    'notifications' => [
        Spatie\Health\Notifications\CheckFailedNotification::class => ['telegram'],
    ],

    'custom_channels' => [
        'telegram' => env('TELEGRAM_CHAT_ID'),
    ],
],
```

Any value specified in `custom_channels` will be passed to the notification channel. This makes it possible to use any Laravel notification channel package without having to extend the notifiable class.
