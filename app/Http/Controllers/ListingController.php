<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show All Listing
    public function index(/*Request $request*/) {
        // dd($request->tag);
        // dd(request('tag')); // Same as above, but doesn't need the Dependency Injection in the parenthesis of index

        return view('listings.index', [
            // 'heading' => 'Latest Listings',

            // 'listings' => Listing::all()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6) // latest()->get() is same as all, but sorting to latest first
        ]);
    }

    // Show Single Listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Listing Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        // Validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')], // listings is the table name, company is the field name
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // For Image
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public'); // logos is a folder that will be created in public folder "storage/app/public"
        }

        // Getting id of the user
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully');
    }

    // Show Edit Listing Form
    public function edit(Listing $listing) {
        // Make sure logged in user is the owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is the owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        // Validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // For Image
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public'); // logos is a folder that will be created in public folder "storage/app/public"
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully');
    }

    // Delete Listing Data
    public function destroy(Listing $listing) {
        // Make sure logged in user is the owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted succesfully');
    }

    // Manage Listing Data
    public function manage() {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->paginate(5)
        ]);
    }
}
