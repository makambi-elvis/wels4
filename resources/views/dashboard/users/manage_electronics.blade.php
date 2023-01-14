@extends('layout.layout')

@section('content')

<div class="row bg-secondary mx-auto mb-3 text-light text-center">
    <h3 class="my-3">Manage Electronics</h3>
</div>

<div class="row">
    <div class="col-12">
        <table class="table align-middle table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Model</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Estimated Value</th>
                    <th scope="col">Daily Charges</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($electronics as $electronic)
                    <tr scope="row">
                        <td>
                            <img src="{{ $electronic->image ? asset('storage/' . $electronic->image) : asset('images/no-image.png') }}"
                            class="" height="100rem" width="auto" alt="electronic image">
                        </td>
                        <td> {{ $electronic -> manufacturer }} </td>
                        <td> {{ $electronic -> model }} </td>
                        <td> {{ $electronic -> tags }} </td>
                        <td> {{ $electronic -> estimated_value }} </td>
                        <td> {{ $electronic -> cost_per_day }} </td>
                        <td> {{ $electronic -> description }} </td>
                        <td>
                            @include('partials._electronic-functionality')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
