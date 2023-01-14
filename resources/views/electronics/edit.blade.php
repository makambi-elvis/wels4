@extends('layout.layout')
@section('content')

    <div class="row text-center text-primary mb-3">
        <h1>Edit Electronic Information</h1>
    </div>
    <div class="row text-center">
        <div class="col-xs-12 col-md-5 mx-auto">
            <form method="POST" action="/electronics/edit/{{$electronic->id}}" class="bg-light p-3 shadow" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="input-group mb-3">
                    <span class="input-group-text" id="manufacturer">Manufacturer</span>
                    <input type="text" class="form-control" name="manufacturer" value="{{$electronic->manufacturer}}" placeholder="e.g. Sony, Samsung, HP"
                           aria-label="manufacturer" aria-describedby="manufacturer">
                </div>
                @error('manufacturer')
                <p class="text-danger fs-6">
                    {{$message}}
                </p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="manufacturer">Model</span>
                    <input type="text" class="form-control" name="model" value="{{$electronic->model}}" placeholder=""
                           aria-label="model" aria-describedby="model">
                </div>
                @error('model')
                <p class="text-danger fs-6">
                    {{$message}}
                </p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text">Electronic Tags</span>
                    <input type="text" class="form-control" name="tags" value="{{ $electronic->tags }}" placeholder="Like: camera, sony"
                           aria-label="tags" aria-describedby="tags">
                </div>
                @error('tags')
                    <p class="text-danger fs-6">
                        {{$message}}
                     </p>
                    @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="manufacturer">Estimated value</span>
                    <input type="number" class="form-control" name="estimated_value" step=".01" value="{{$electronic->estimated_value}}" placeholder="in Ksh"
                           aria-label="estimated_value" aria-describedby="estimated_value">
                </div>
                @error('estimated_value')
                <p class="text-danger fs-6">
                    {{$message}}
                </p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="cost_per_day">Daily rates</span>
                    <input type="number" class="form-control" name="cost_per_day" step=".01" value="{{$electronic->cost_per_day}}" placeholder="in Ksh"
                           aria-label="cost_per_day" aria-describedby="cost_per_day">
                </div>
                @error('cost_per_day')
                <p class="text-danger fs-6">
                    {{$message}}
                </p>
                @enderror

                <div class="input-group mb-3">
                    <section>
                        <img src="{{$electronic->image ? asset('storage/' . $electronic -> image) : asset('images/no-image.png')}}" class="card-img-top" alt="electronic image">
                    </section>
                    <span class="input-group-text" id="image">Image</span>
                    <input type="file" class="form-control" name="image" value="{{old('image')}}" placeholder="Choose an image"
                           aria-label="image" aria-describedby="image">
                </div>
                @error('image')
                <p class="text-danger fs-6">
                    {{$message}}
                </p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text" id="description">Description</span>
                    <textarea class="form-control" rows="10" name="description" placeholder="Write something about your electronic" aria-label="Description" aria-describedby="basic-addon7">
                    {{$electronic->description}}
                </textarea>
                </div>
                @error('description')
                <p class="text-danger fs-6">
                    {{$message}}
                </p>
                @enderror
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>


@endsection
