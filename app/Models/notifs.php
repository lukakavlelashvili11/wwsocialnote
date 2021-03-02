<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifs extends Model
{
    use HasFactory;
    public $table="notifications";
    protected $fillable=[
        'user_id',
        'from',
        'notification',
        'post_id',
        'notiftype',
        'status'
    ];

}
