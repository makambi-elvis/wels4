<?php

namespace App\Http\Controllers;

use App\Models\Hire;
use Illuminate\Http\Request;

class HireController extends Controller
{
    //store hire information
    public function store(Request $request){

        $formFields['hireRequest_id'] = $request->hireRequest_id;
        $formFields['electronic_id'] = $request->electronic_id;
        $formFields['owner_id'] = $request->owner_id;
        $formFields['customer_id'] = $request->customer_id;
        $formFields['start_date'] = $request->start_date;
        $formFields['return_date'] = $request->return_date;
        $formFields['returned'] = 0;
        $formFields['owner_id'] = auth()->id();

        //dd($formFields);

        Hire::create($formFields);

        return back()->with('message', 'Electronic hired out successfully!');
    }

    //returned

    public function returned(Hire $hire, Request $request){
        $formField['returned'] = $request->returned;

        $hire->update($formField);

        return back()->with('message', 'Success!');
    }
}
