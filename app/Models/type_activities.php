<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_activities extends Model
{
    use HasFactory;
    protected $table = "type_activities";
    protected $fillable = ['ID', 'name', 'description'];
}
