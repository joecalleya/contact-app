<?php

// this contains the logic to link the data (models) and views.

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
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

        // here we get the model data from the contacts table.
        // we also need to use PAGINATION - this is breaking down results into pages

        $contacts = Contact::Latest()->paginate(10);
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
