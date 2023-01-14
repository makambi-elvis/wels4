@extends('layout.layout')

@section('content')
    <div class="row text-center text-primary mb-3">
        <h1>Login to your WELS account</h1>
    </div>
    <div class="row text-center">
        <div class="col-xs-12 col-md-5 mx-auto">
            <form class="bg-light p-3 shadow" method="POST" action="/authenticate">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Enter your email" aria-label="Email" aria-describedby="basic-addon2">
                </div>
                @error('email')
                    <p class="fs-6 text-danger mt-1">{{ $message }}</p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Password</span>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                        placeholder="Password" aria-label="Password" aria-describedby="basic-addon3">
                </div>
                @error('password')
                    <p class="fs-6 text-danger mt-1">{{ $message }}</p>
                @enderror

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
            <p>Already have an account? <a href="/register">Sign Up</a></p>
        </div>
    </div>
@endsection
