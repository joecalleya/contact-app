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

    // this function gets the data on load
    // here we get the model data from the contacts table.
    // we also need to use PAGINATION - this is breaking down results into pages
    // we can add our where clause data here too?
    // also adding local scope by injecting it into query
    public function index(CompanyRepository $company)
    {
        $companies = $this->company->pluck();
        //logs queries to page
        //  DB::enableQueryLog();
        //  dump(DB::getQueryLog());
        $query = Contact::query();
        if(request()->query('trash')){
            $query->onlyTrashed();
        }

        $contacts = $query->sortByItem(['first_name','last_name','email'])
                          ->filterByItem('company_id')
                          ->searchByItem(['first_name','last_name','email'])
                          ->paginate(10);

        // navigate to index view , with this data.
        return view('contacts.index' ,  compact('contacts','companies'));
    }

    //this is the show contact controller
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact',$contact);
    }

    //this is the create contact controller
    // we might want to get url with parameters, we can also use it to do other things
    public function create()
    {
        //dd(request()->fullUrl());
        $companies = $this->company->pluck();
        $contact = new Contact();
        return view('contacts.create',compact('companies', 'contact'));
    }

    // this funtion controls saving & validating form data
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

        // save data and return view
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message','Contact has been added successfully');
    }

    // this function controls the editing of contact info
    public function edit($id)
    {
        $companies = $this->company->pluck();
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('companies', 'contact'));
    }

    // this function will update and validate new contacts
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
        return redirect()->route('contacts.index')->with('message','Contact has been updated successfully');
    }

    // here we can add some functionality to delete items
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $redirect = request()->query("redirect");
        return ($redirect ? redirect()->route($redirect ): back())
            ->with('message','Contact has been moved to trash.')
            ->with('undoRoute', $this->getUndoRoute('contacts.restore' , $contact));
    }

    // here we can add some functionality to restore the deleted item from trash using soft delete
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return back()
            ->with('message','Contact has been restored from trash.')
            ->with('undoRoute',$this->getUndoRoute('contacts.destroy' , $contact));
    }

    //this controls showing the undo  button in UI
    protected function getUndoRoute($name, $resource){

        return request()->missing('undo') ? route($name , [$resource->id, 'undo' => true]) : null;
    }

    // here we can add some functionality to remove permanently the deleted item from trash.
    public function forceDelete($id)
        {
            $contact = Contact::onlyTrashed()->findOrFail($id);
            $contact->forceDelete();
            return back()
                ->with('message','Contact has been permanently deleted');
        }
}
