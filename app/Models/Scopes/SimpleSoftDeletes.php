<?php
namespace App\Models\Scopes;

trait SimpleSoftDeletes{

    //this class allows us to apply specific global scope functions to the data
    protected static function bootSimpleSoftDeletes(){
        static::addGlobalScope(new SimpleSoftDeletingScope);
    }

}
