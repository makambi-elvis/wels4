<?php

namespace App\Http\Controllers;

use App\Models\Hire;
use App\Models\User;
use App\Models\Electronic;
use Illuminate\Http\Request;

class ElectronicController extends Controller
{
    //Display all electronics(welcome page)

    public function index()
    {
        return view('electronics.index', [
            'page_title' => 'WELS|Home',
            'electronics' => Electronic::latest()->filter(request(['tag', 'search']))->paginate(10),
            'users' => User::all(),
            'hires' => Hire::all()
        ]);
    }

    //See a single electronic

    public function show(Electronic $electronic)
    {
        return view('electronics.show', [
            'page_title' => 'WELS | Electronic',
            'electronic' => $electronic,
            'hires' => Hire::all()
        ]);
    }

    //Display create form

    public  function create()
    {
        return view('electronics.create', data: [
            'page_title' => 'WELS | create post',
        ]);
    }

    //Store electronic data in database

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'manufacturer' => 'required',
            'model' => 'required',
            'tags' => 'required',
            'estimated_value' => 'required',
            'cost_per_day' => 'required',
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'description' => 'required'
        ]);

        $formFields['owner_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('electronic_images', 'public');
        }

        Electronic::create($formFields);

        return redirect('/')->with('message', 'Electronic listed successfully created!');
    }

    //Display electronic edit form

    public function edit(Electronic $electronic)
    {
        return view('electronics.edit', [
            'page_title' => 'WELS | Edit electronic',
            'electronic' => $electronic
        ]);
    }

    //update database values from edited form

    public function update(Request $request, Electronic $electronic)
    {
        $formFields = $request->validate([
            'manufacturer' => 'required',
            'model' => 'required',
            'tags' => 'required',
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'estimated_value' => 'required',
            'cost_per_day' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('electronic_images', 'public');
        }

        $electronic->update($formFields);

        return redirect('/dashboard/manage/user/electronics')->with('message', 'Electronic updated successfully!');
    }

    //Delete electronic

    public function destroy(Electronic $electronic)
    {
        $electronic->delete();

        return redirect('/')->with('message', 'Electronic deleted successfully!');
    }
}
