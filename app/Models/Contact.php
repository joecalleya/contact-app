<?php

namespace App\Models;

use App\Models\Scopes\SimpleSoftDeletes;
use App\Models\Scopes\SimpleSoftDeleteScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Messages\SimpleMessage;

class Contact extends Model
{
    use HasFactory , SimpleSoftDeletes;
    protected $fillable = [ 'first_name','last_name','email','phone', 'address','company_id'];

    // we need this to relate the models to each other
    public function company()
    {
        return $this-> belongsTo(Company::class);
    }

    public function tasks(){

        return $this->hasMany(Task::class);
    }
    
    //lets define local scope for sorting
    public function scopeSortByNameAlpha(Builder $query){

        return $query->orderBy('first_name');
    }

    //lets define local scope for filtering by company
    public function scopeFilterByCompany(Builder $query){

        if($companyId = request()->query("company_id")){
            $query->where("company_id",$companyId );
        }
        return $query;
    }
}
