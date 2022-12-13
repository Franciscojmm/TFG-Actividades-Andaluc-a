<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activities";
    protected $fillable = ['ID', 'name', 'date','description','type','place','teaching'];

    public function teachings(){
        return $this->belongsTo(Teaching::class, 'teaching');
    }

    public function places(){
        return $this->belongsTo(Place::class, 'place');
    }

    public function types(){
        return $this->belongsTo(type_activities::class, 'type');
    }


    public function scopeEnseñanza($query ,$buscar){
        if(isset($buscar))
        if($buscar != -1)
            return $query->where('teaching','=',"$buscar");
    }

}
