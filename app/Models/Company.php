<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    // protected $table = "app_companies";

    //specify primary key
    // protected $primaryKey = "_id";

    //only let us update exting cols
    protected $guarded = [];

    //only let us update specified cols
    protected $fillable = [ 'name','address','email','website'];

}
