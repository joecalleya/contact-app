<?php
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait AllowedSort{

    //this class allows us to apply specific global scope functions to the data
    public function parseSortDirection(){
        return strpos(request()->query('sort_by') , '-') === 0 ? 'desc' : 'asc';
    }

    //lets us get the column from the URL
    public function parseSortColumn(){
        return ltrim(request()->query('sort_by'),'-');
    }

    //lets define local scope for sorting
    public function scopeSortByItem(Builder $query, array $columns, $defaultColumn=null){
        $column = $this->parseSortColumn();
        if (in_array($column,$columns)){
            return $query->orderBy($column, $this->parseSortDirection());
        }
    }

}
