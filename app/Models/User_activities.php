<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_activities extends Model
{
    use HasFactory;
    protected $table = "usersActivities";
    protected $fillable = ['ID', 'id_user' ,'id_activity' , 'description'];

    public function users(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function activities(){
        return $this->belongsTo(Activity::class, 'id_activity');
    }

}
