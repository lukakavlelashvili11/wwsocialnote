<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'body',
        'img_name'
    ];
    public function ownedBy(User $user){
        return $user->id===$this->user_id;
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
}
