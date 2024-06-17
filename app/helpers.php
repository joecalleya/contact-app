<?php

use Illuminate\Support\Str;

// this function will append to the current url when the user sorts
function sortable($label, $column=null) {

    $column = $column ?? Str::snake($label);
    $sortBy = request()->query('sort_by');
    $direction = '';
    if (ltrim($sortBy ,"-")  ===  $column){
        $direction = strpos($sortBy ,"-") === 0 ? 'desc':  'asc';
    }
    $sortBy = !$sortBy || strpos($sortBy ,"-") === 0 ? $column : "-{$column}";
    $url = request()->fullUrlWithQuery(['sort_by'=>$sortBy]);

    return "<a href='{$url}' class='sortable {$direction}'>{$label}</a>";
}

