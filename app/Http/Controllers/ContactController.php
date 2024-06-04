<?php

// this contains the logic to link the data (models) and views.

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
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
        // we can add our where clause data here too?
        $contacts = Contact::Latest()->where(function ($query
        ){
            if($companyId = request()->query("company_id")){
                $query->where("company_id",$companyId );
            }
        })->paginate(10);

        // manual pagination
        // $contactsCollection = Contact::Latest()->get();
        // $perPage = 10;
        // $currentPage = request()->query('page',1);
        // $items = $contactsCollection->slice(($currentPage * $perPage) - $perPage, $perPage);
        // $total = $contactsCollection->count();
        // $contacts = new LengthAwarePaginator($items, $total,$perPage, $currentPage,[
        //     'path'=>request()->url(),
        //     'query'=>request()->query()
        // ]);
        // navigate to index view , with this data.
        return view('contacts.index' ,  compact('contacts','companies'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact',$contact);
    }
    public function create()
    {
        // we might want to get url with parameters, we can also use it to do other things
        //dd(request()->fullUrl());

        $companies = $this->company->pluck();

        return view('contacts.create',compact('companies'));
    }
    public function store(Request $request)
    {
        //validations
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'required|string|max:50',
            'company_id' => 'required|exists:companies,id',
        ]);
        // dependency injection we are checking the URL here.
        // if ($request->all())
        //     dd($request->first_name);

        // save data and return veiw
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message','Contact has been added sucessfully');
    }

    public function edit($id)
    {
        $companies = $this->company->pluck();
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        //validations
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'required|string|max:50',
            'company_id' => 'required|exists:companies,id',
        ]);
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message','Contact has been updated sucessfuly');
    }
}
