@extends('layout.layout')

@section('content')
    {{-- Admin --}}
    @role('admin')
    <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Reports</h3>
    </div>

    <div class="row mb-4">

        <div class="col-xs-12 col-md-4">
            <ul class="list-group text-center">
                <li class="list-group-item active">No of Users</li>
                <li class="list-group-item"><span class="fs-4">{{ $users->count() }}</span></li>
            </ul>
        </div>

        <div class="col-xs-12 col-md-4">
            <ul class="list-group text-center">
                <li class="list-group-item active">No of Electronics</li>
                <li class="list-group-item"><span class="fs-4">{{ $electronics->count() }}</span></li>
            </ul>
        </div>

        <div class="col-xs-12 col-md-4">
            <ul class="list-group text-center">
                <li class="list-group-item active">No of Hires</li>
                <li class="list-group-item">{{ $hires->count() }}<span class="fs-4"></span></li>
            </ul>
        </div>

    </div>

    <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Manage</h3>
    </div>

    <div class="row mb-4">
        <div class=" col-xs-12 col-md-4 my-2">
            <div class="card bg-light p-2 shadow">
                <div class="mx-auto">
                    <img src="{{ asset('images/points_todo_icon.png') }}" class="mx-auto" height="100rem"
                        alt="categories icon">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">View hires</h5>
                    <p class="card-text">View Hires</p>
                    <a href="/dashboard/view/hires" class="btn btn-primary">Hires</a>
                </div>
            </div>
        </div>

        <div class=" col-xs-12 col-md-4 my-2">
            <div class="card bg-light shadow p-2">
                <div class="mx-auto my-2">
                    <img src="{{ asset('images/electronics_icons.png') }}" class="mx-auto" height="100rem"
                        alt="electronics icon">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Electronics</h5>
                    <p class="card-text">Delete Fraudulent Posts</p>
                    <a href="/dashboard/manage/electronics" class="btn btn-primary">Electronics</a>
                </div>
            </div>
        </div>

        <div class=" col-xs-12 col-md-4 my-2">
            <div class="card bg-light shadow p2">
                <div class="mx-auto my-2">
                    <img src="{{ asset('images/group_icon.png') }}" class="mx-auto" height="100rem" alt="group icon">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">Delete a User</p>
                    <a href="/dashboard/manage/users" class="btn btn-primary">Users</a>
                </div>
            </div>
        </div>
    </div>
    @else


     {{-- User --}}


     <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Reports</h3>
    </div>

    <div class="row mb-4">

        <div class="col-xs-12 col-md-4">
            <ul class="list-group text-center">
                <li class="list-group-item active">No of Electronics</li>
                <li class="list-group-item"><span class="fs-4">{{ $electronics->where('owner_id', '=', auth()->id())->count() }}</span></li>
            </ul>
        </div>

        <div class="col-xs-12 col-md-4">
            <ul class="list-group text-center">
                <li class="list-group-item active">No of Hire Requests</li>
                <li class="list-group-item"><span class="fs-4">{{ $hire_requests->where('owner_id', '=', auth()->id())->count() }}</span></li>
            </ul>
        </div>

        <div class="col-xs-12 col-md-4">
            <ul class="list-group text-center">
                <li class="list-group-item active">No of hires</li>
                <li class="list-group-item"><span class="fs-4">{{ $user_hires->count() }}</span></li>
            </ul>
        </div>

    </div>

    <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Manage</h3>
    </div>

    <div class="row mb-4">
        <div class=" col-xs-12 col-md-4 my-2">
            <div class="card bg-light p-2 shadow">
                <div class="mx-auto">
                    <img src="{{ asset('images/points_todo_icon.png') }}" class="mx-auto" height="100rem"
                        alt="categories icon">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">View Hire Requests</h5>
                    <p class="card-text">View and accept hire requests</p>
                    <a href="/hire/requests/{{ Auth::user()->name }}" class="btn btn-primary">Hire Requests</a>
                </div>
            </div>
        </div>

        <div class=" col-xs-12 col-md-4 my-2">
            <div class="card bg-light shadow p-2">
                <div class="mx-auto my-2">
                    <img src="{{ asset('images/files_storage_icon.png') }}" class="mx-auto" height="100rem"
                        alt="storage icon">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Your Hired Items</h5>
                    <p class="card-text">View and receive hired electronics</p>
                    <a href="/dashboard/manage/user/{{Auth::user()->name}}/hires" class="btn btn-primary">Hired Items</a>
                </div>
            </div>
        </div>

        <div class=" col-xs-12 col-md-4 my-2">
            <div class="card bg-light shadow p2">
                <div class="mx-auto my-2">
                    <img src="{{ asset('images/electronics_icons.png') }}" class="mx-auto" height="100rem" alt="group icon">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Your Electronics</h5>
                    <p class="card-text">Add, edit and delete electronics</p>
                    <a href="/dashboard/manage/user/electronics" class="btn btn-primary">Electronics</a>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection
