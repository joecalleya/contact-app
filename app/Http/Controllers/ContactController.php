<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
//import contracts  model
use App\Models\Contact;
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
        // here we get the data
        $contacts = Contact::Latest()->get();
        return view('contacts.index' ,  compact('contacts','companies'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact',$contact);
    }
    public function createContacts()
    {
        return view('contacts.create');
    }
}
