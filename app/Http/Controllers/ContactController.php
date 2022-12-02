<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(protected CompanyRepository $company)
    {
    }

    public function index (CompanyRepository $company, Request $request)
    {

        // dd($request->sort_by);

        $companies = $company->pluck();
        $contacts = $this->getContacts();
    
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create () {
        return view('contacts.create');
    }

    public function show ($id) {
        abort_if(!isset($id), 404);
        
        $contacts = $this->getContacts();
        
        abort_if($id < 0 || $id > count($contacts), 404);
        
        $contact = $contacts[$id];
    
        return view('contacts.show')->with('contact', $contact);
    }

    protected function getContacts() {
        return [
            1 => ['id' => 1, 'name' => "Name 1", 'phone' => "1234567890"],
            2 => ['id' => 2, 'name' => "Name 2", 'phone' => "5555551234"],
            3 => ['id' => 3, 'name' => "Name 3", 'phone' => "6612222222"],
        ];
    }
}
