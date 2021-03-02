<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{id}', function ($user,$id) {
    return (int) $user->id==(int) $id;
});
Broadcast::channel('joinedUsers', function ($user) {
    return $user;
});
Broadcast::channel('post-like.{id}', function ($user,$id) {
    return (int) $user->id==(int) $id;
});
Broadcast::channel('addfriend.{id}', function ($user,$id) {
    return (int) $user->id==(int) $id;
});
