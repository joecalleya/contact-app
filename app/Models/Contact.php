<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = [ 'first_name','last_name','email','phone', 'address','company_id'];

    public function company()
    {
        // we need this to relate the models to each other
        return $this-> belongsTo(Company::class);
    }

}
