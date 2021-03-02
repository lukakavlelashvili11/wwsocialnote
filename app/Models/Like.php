<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id'
    ];
    public $table='likes';
    public function posts(){
        return $this->belongsTo(post::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
