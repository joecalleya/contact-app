<?php
//this separates the application logic from the data storage

namespace App\Repositories;
use App\Models\Company;

class CompanyRepository
{

    public function pluck()
    {
        $data = [];
        $companies = Company::orderBy('name')->get();
        foreach($companies as $company){
            $data[$company->id] = $company->name . "(" . $company->contacts()->count() . ")";
        }
    return $data;
    }

}
