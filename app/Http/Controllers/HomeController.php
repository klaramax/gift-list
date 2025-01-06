<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Gift;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Display the home page for the logged-in user
    public function index()
    {
    $persons = Person::where('user_id', auth()->id())->with('gifts')->get();

    return view('home', compact('persons'));
    }

    // Show the form to create a new person
    public function createPerson()
    {
        return view('create-person');
    }

    // Store the new person in the database
    public function storePerson(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create and save a new person
        $person = new Person();
        $person->name = $request->name;
        $person->user_id = auth()->id(); // Assign the person to the logged-in user
        $person->save();

        // Redirect the user to the home page after successful creation
        return redirect()->route('home');
    }

    // Show the form to create a new gift
    public function createGift()
    {
        return view('create-gift');
    }

    // Store the new gift in the database
    public function storeGift(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'url' => 'nullable|url',
            'where_bought' => 'nullable|string|max:255',
        ]);

        // Create and save a new gift
        $gift = new Gift();
        $gift->name = $request->name;
        $gift->price = $request->price;
        $gift->url = $request->url;
        $gift->where_bought = $request->where_bought;
        $gift->user_id = auth()->id(); // Assign the gift to the logged-in user
        $gift->save();

        // Redirect the user to the home page after successful creation
        return redirect()->route('home');
    }
}