<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $company;
    public function __construct()
    {
        $this->company = new CompanyRepository;
    }
    public function index(CompanyRepository $company)
    {
        $companies = $this->company->pluck();
        $contacts = $this->getContacts();
        return view('contacts.index' ,  compact('contacts','companies'));
    }
     private function getContacts()
     {
        return[
            1 => [ 'id' => '1', 'name'=> 'Joe', 'phone' => '12345678990'],
            2 => [ 'id' => '2',  'name'=> 'jake', 'phone' => '12345678990'],
            3 => [ 'id' => '3',  'name'=> 'john', 'phone' => '12345678990'],
        ];
    }
    public function showContacts($id)
    {
        $contacts = $this->getContacts();
        abort_unless(isset($contacts[$id]), 404);
        $contact = $contacts[$id];
        return view('contacts.show')->with('contact',$contact);
    }
    public function createContacts()
    {
        return view('contacts.create');
    }
}
