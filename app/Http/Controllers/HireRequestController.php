<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Electronic;
use App\Models\Hire;
use App\Models\HireRequest;
use Illuminate\Http\Request;

class HireRequestController extends Controller
{
    //display hire request form

    public function create(Electronic $electronic)
    {
        return view('hire_requests.create', [
            'page_title' => 'WELS|Request Electronic',
            'electronic' => $electronic,
            'user' => User::all()
        ]);
    }

    //save hire request

    public function store(Request $request, Electronic $electronic)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:6'],
            'location' => ['required'],
            'phone_number' => 'required|numeric|digits:10',
            'days' => ['required', 'numeric', 'min:1'],
            'message' => ['nullable']
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['electronic_id'] = $electronic->id;

        //Store the data in the database
        HireRequest::create($formFields);

        return redirect('/')->with('message', 'Hire request sent successfully.');
    }


    //manage hire requests

    public function manage(){
        return view('dashboard.users.hire_requests',[
            'page_title' => 'WELS|Hire Requests',
            'receivedHireRequests' => HireRequest::join('electronics', 'hire_requests.electronic_id', '=', 'electronics.id')
            ->select('hire_requests.*', 'electronics.manufacturer AS electronic_make', 'electronics.model AS model', 'electronics.cost_per_day AS daily_charges', 'electronics.estimated_value as electronic_value')
            ->where('electronics.owner_id','=', auth()->id())
            ->get(),
            'sentHireRequests' => auth()->user()->hire_requests()->join('electronics', 'hire_requests.electronic_id', '=', 'electronics.id')
            ->select('hire_requests.*', 'electronics.manufacturer AS electronic_make', 'electronics.model AS model', 'electronics.cost_per_day AS daily_charges', 'electronics.owner_id AS owner_id')
            ->get(),
            'user' => User::all(),
            'currentDate' => Carbon::now(),
            'hires' => Hire::all()
        ]);
    }

    //accept hire request

    public function accept(Request $request, HireRequest $hireRequest){
        $formFields = $request->validate([
            'rejected' => 'required',
            'accepted' => 'required'
        ]);

        $hireRequest->update($formFields);

        return back()->with('message', 'Request accepted successfully');
    }

    //decline hire request

    public function decline(Request $request, HireRequest $hireRequest){
        $formFields = $request->validate([
            'rejected' => 'required',
            'accepted' => 'required'
        ]);


        $hireRequest->update($formFields);

        return back()->with('message', 'Request declined successfully');
    }

}
