<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    // protected $table = "app_companies";

    //specify primary key
    // protected $primaryKey = "_id";

    //only let us update exting cols
    protected $guarded = [];

    //only let us update specified cols
    protected $fillable = [ 'name','address','email','website'];
    public function contacts()
    {
        // we need this to relate the models to each other
        return $this-> hasMany(Contact::class);
    }
}
