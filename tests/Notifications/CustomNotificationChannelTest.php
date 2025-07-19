<?php

use Spatie\Health\Notifications\Notifiable;

it('can route custom notification channels', function () {
    $notifiable = new Notifiable();

    config()->set('health.notifications.custom_channels.telegram', '12345');

    expect($notifiable->routeNotificationFor('telegram'))->toEqual('12345');
});
