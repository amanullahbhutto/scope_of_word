<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;


class ContactController extends Controller {
    public function index() {
        $contacts = Contacts::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create() {
        return view('admin.contacts.create');
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contacts,email',
            'description' => 'required'
        ]);

        Contacts::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show(Contacts $contact) {
        return view('admin.contacts.show', compact('contact'));
    }

    public function edit(Contacts $contact) {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contacts $contact) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'description' => 'required'
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contacts $contact) {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
