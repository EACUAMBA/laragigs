<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    //Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show create form
    public function create()
    {
        return view('listings.create');
    }

    //Store listing data
    public function store(Request $request)
    {
        //Fazendo a validação dos campos.
        $formFields = $request->validate([
            'title' => 'required',
            //Se quisermos que um campo seja unique no banco de dados podemos usar Rule::unique para isso.
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos',  'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {

        //Make sure user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized!');
        }

        //Fazendo a validação dos campos.
        $formFields = $request->validate([
            'title' => 'required',

            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos',  'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete listing
    public function destroy(Request $request, Listing $listing)
    {
        //Make sure user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized!');
        }
        $listing->delete();

        return redirect(route('listings.index'))->with('message', 'Listing deleted successfully!');
    }

    //Manage listing
    public function manage()
    {
        return view('listings.manage', ['listings' => Auth::user()->listings()->get()]);
    }
}
