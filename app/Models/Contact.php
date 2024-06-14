<?php

namespace App\Models;

use App\Models\Scopes\AllowedSort;
use App\Models\Scopes\SimpleSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory , SimpleSoftDeletes, AllowedSort;
    protected $fillable = [ 'first_name','last_name','email','phone', 'address','company_id'];

    // we need this to relate the models to each other
    public function company()
    {
        return $this-> belongsTo(Company::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    //lets define local scope for filtering by company
    public function scopeFilterByItem(Builder $query, string $key){
        if($companyId = request()->query($key)){
            $query->where("company_id",$companyId );
        }
        return $query;
    }

    public function scopeSearchByItem(Builder $query, array $keys){
        if($search = request()->query('search')){
            foreach($keys as $index => $key){
                $method = $index === 0 ? 'where' : 'orWhere';
                $query->{$method}($key,'LIKE',"%{$search}");
            }
    }
    return $query;
    }

}
