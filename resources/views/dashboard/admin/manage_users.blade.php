@extends('layout.layout')

@section('content')

<div class="row bg-secondary mx-auto mb-3 text-light text-center">
    <h3 class="my-3">Manage Users</h3>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr scope="row">
                        <td> {{ $user -> name}} </td>
                        <td> {{ $user -> email}} </td>
                        <td> {{ $user -> created_at }}
                        <td>
                            @if ($user->hasRole('admin'))
                            <span class="bg-warning p-1">Admin</span>
                            @else
                            @include('partials._manage-user')
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>



@endsection
