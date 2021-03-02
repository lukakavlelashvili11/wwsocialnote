<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'key',
        'message',
        'chat_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
