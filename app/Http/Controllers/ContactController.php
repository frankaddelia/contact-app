<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct(protected CompanyRepository $company)
    {
    }

    public function index(CompanyRepository $company, Request $request)
    {

        // $companies = $this->company->pluck();
        $companies = Company::orderBy('name')->pluck('name', 'id');
        $contacts = Contact::latest()->get();

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts.show')->with('contact', $contact);
    }
}
