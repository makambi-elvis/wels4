@extends('layout.layout')
@section('content')
    <div class="row text-center text-primary mb-3">
        <h1>Request to Hire Electronic</h1>
    </div>

    <div class="row text-center ">
        <div class="col-xs-12 col-md-5 mx-auto my-auto p-3">
            <div class="card shadow">
                <img src="{{ $electronic->image ? asset('storage/' . $electronic->image) : asset('images/no-image.png') }}"
                    class="card-img-top" alt="electronic image">
                <div class="card-body">
                    <h5 class="card-title"><span class="text-primary">
                            {{ $electronic->manufacturer . ' ' . $electronic->model }}</span></h5>
                    <p class="card-text">Estimated Value : <span class="text-primary">
                            {{ $electronic->estimated_value }}</span></p>
                    <p class="card-text">Daily Charges : <span class="text-primary"> {{ $electronic->cost_per_day }}</span>
                    </p>
                </div>
                <div class="card-footer">
                    <p class="card-text">Posted by : <span class="text-primary">
                        {{$user->find($electronic->owner_id)->name}}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-5 mx-auto my-auto p-3">
            <div class="bg-light p-3 shadow">
                <form method="POST" action="/request/{{$electronic->id}}/create" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Name</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            placeholder="Enter your Names" aria-label="name" aria-describedby="name">
                    </div>
                    @error('name')
                        <p class="text-danger fs-6">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="location">Location</span>
                        <input type="text" class="form-control" name="location" value="{{ old('location') }}"
                            placeholder="Enter your Location" aria-label="location" aria-describedby="location">
                    </div>
                    @error('location')
                        <p class="text-danger fs-6">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">Phone Number</span>
                        <input type="tel" class="form-control" name="phone_number" value="{{ old('phone_number') }}"
                            placeholder="0700000000" aria-label="phone_number" aria-describedby="phone_number">
                    </div>
                    @error('phone_number')
                        <p class="text-danger fs-6">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="days">Days to hire</span>
                        <input type="number" class="form-control" name="days" step="1"
                            value="{{ old('days') }}" placeholder="No of days to hire item" aria-label="days"
                            aria-describedby="days">
                    </div>
                    @error('days')
                        <p class="text-danger fs-6">
                            {{ $message }}
                        </p>
                    @enderror


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="message">Message</span>
                        <textarea class="form-control" rows="5" name="message" placeholder="Write a message to the owner"
                            aria-label="message" aria-describedby="basic-addon7">
                    {{ old('message') }}
                </textarea>
                    </div>
                    @error('message')
                        <p class="text-danger fs-6">
                            {{ $message }}
                        </p>
                    @enderror
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
