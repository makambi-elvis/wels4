<?php

namespace App\Http\Controllers;

use App\Models\Hire;
use App\Models\User;
use App\Models\Electronic;
use App\Models\HireRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //show main page

    public function index()
    {
        return view('dashboard.index', [
            'page_title' => 'WELS|Dashboard',
            'users' => User::latest()->paginate(10),
            'electronics' => Electronic::latest(),
            'hire_requests' => HireRequest::join('electronics', 'hire_requests.electronic_id', '=', 'electronics.id')
                ->select('hire_requests.*', 'electronics.owner_id AS owner_id')
                ->get(),
            'user_hires' => auth()->user()->hires()->get(),
            'hires' => Hire::all()

        ]);
    }

    ///******Admin pages******///

    //manage users

    public function manage_users()
    {
        return view('dashboard.admin.manage_users', [
            'page_title' => 'WELS|Manage Users',
            'users' => User::latest()->paginate(10)
        ]);
    }

    //manage electronics

    public function manage_electronics()
    {
        return view('dashboard.admin.manage_electronics', [
            'page_title' => 'WELS|Manage Electronics',
            'electronics' => Electronic::latest()->paginate(10),
            'users' => User::all()
        ]);
    }

    //view hires

    public function manage_hires(){
        return view('dashboard.admin.manage_hires',[
            'page_title' => 'WELS|View Hires',
            'hires' => Hire::all(),
            'electronics' => Electronic::all(),
            'users' => User::all()
        ]);
    }


    ///******User pages******///

    //manage user electronics

    public function manage_user_electronics()
    {
        return view('dashboard.users.manage_electronics', [
            'page_title' => 'WELS|Manage Your Electronics',
            'electronics' => auth()->user()->electronics()->get()
        ]);
    }

    //manage user hired items

    public function manage_user_hires(){
        return view('dashboard.users.manage_hires',[
            'page_title' => 'WELS|Your Hires',
            'hires' => auth()->user()->hires()->get(),
            'hired' => Hire::all(),
            'electronics' => Electronic::all(),
            'users' => User::all()
        ]);
    }
}
