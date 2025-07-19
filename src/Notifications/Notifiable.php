<?php

namespace Spatie\Health\Notifications;

use Illuminate\Notifications\Notifiable as NotifiableTrait;
use Illuminate\Support\Str;

class Notifiable
{
    use NotifiableTrait;

    public function routeNotificationFor(string $driver, mixed $notification = null): mixed
    {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}($notification);
        }

        $customChannels = config('health.notifications.custom_channels', []);

        if (array_key_exists($driver, $customChannels)) {
            return $customChannels[$driver];
        }

        return match ($driver) {
            'database' => $this->notifications(),
            'mail' => $this->routeNotificationForMail(),
            default => null,
        };
    }

    /** @return string|array<int, string> */
    public function routeNotificationForMail(): string|array
    {
        return config('health.notifications.mail.to');
    }

    public function routeNotificationForSlack(): string
    {
        return config('health.notifications.slack.webhook_url');
    }

    public function getKey(): int
    {
        return 1;
    }
}
