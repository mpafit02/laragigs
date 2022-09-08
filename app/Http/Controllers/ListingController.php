<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //// Common Resource Routes: ////
    // index - Show all items
    // show - Show single item
    // create - Show form to create a new item
    // store - Store the new item
    // edit - Show form to edit the new item
    // update - Update the new item
    // destroy - Delete the item


    // Show all listings 
    public function index()
    {
        // dd(request()->tag);
        // Pass data to the view, usually those will be fetched from a database through the model
        return view('listings.index', [

            // 1. Load all the data from the model and filter them by accessing the scopeFilter method in the ./app/Models/Listing.php 
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()

            // 2. Use pagination to load the data from the model and filter them by accessing the scopeFilter method in the ./app/Models/Listing.php 
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show a single listing
    public function show(Listing $listing)
    {
        // In case the listing doesn't exist automatically is going to return 404.
        return view('listings.show', [
            'listing' => $listing // Find the listing with this id from the model
        ]);
    }

    // Edit a listing
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }


    // Show Create Form to create a new listing
    public function create()
    {
        return view('listings.create');
    }

    // Store a new listing in the database controller
    public function store(Request $request)
    {
        // Do some validation, if any of these fail it will respond with failure
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        // Check if there is an image logo uploaded
        if ($request->hasFile('logo')) {
            // Store the logo in the folder logos and return the path to the formFields as well to be added in the database
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Get the current logged in user's id and assign it to the new listings user_id
        $formFields['user_id'] = auth()->id();

        // Once everything is validated call the create
        // +++++ IMPORTANT ++++++: In the ./app/Models/Listing.php define the following variable in order for the form submission to work:
        // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];
        // +++++ or +++++
        // in the ./app/Providers/AppServiceProvider.php set in the boot() method define: Model::unguard();
        Listing::create($formFields);

        // Normal redirect
        // return redirect('/');

        // Redirect with alert message
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Update the listing
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        // Do some validation, if any of these fail it will respond with failure
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        // Check if there is an image logo uploaded
        if ($request->hasFile('logo')) {
            // Store the logo in the folder logos and return the path to the formFields as well to be added in the database
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Once everything is validated call the update in the existing $listing
        $listing->update($formFields);

        // Redirect with alert message
        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully!');
    }

    // Manage Listing
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
