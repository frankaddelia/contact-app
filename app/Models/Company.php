<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // if the model naming convention isn't typical, you would have to set your own name/primary key
    // protected $table = "app_companies";
    // protected $primaryKey = "_id";

    protected $fillable = ['name', 'email', 'address', 'website'];
}
