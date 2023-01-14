@extends('layout.layout')

@section('content')
    </div>
    <div class="bg-dark text-secondary px-4 py-5 text-center">
        <div class="py-5">
            <h1 class="display-5 fw-bold text-white">Welcome to <span class="text-primary">WELS</span> official website. </h1>
            <div class="col-lg-6 mx-auto">
                <p class="fs-5 mb-4">
                    WELS allows users to post their electronics for people to find and request to hire.
                    Feel free to explore the inventory available for hire and post more items for hire.
                </p>
                @role('admin')
                @else
                    <a href="/electronics/create" class="btn mt-3 p-2 btn-light text-primary">Post Electronic</a>
                @endrole
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-4">
            @include('partials._search')
        </div>
        <div class="row mb-2 mt-2">
            @if ($electronics->count() > 0)
                @foreach ($electronics as $electronic)
                    <div class=" col-xs-12 col-sm-4">
                        <div class="card my-2 rounded-3 border-white shadow-lg text-bg-light  text-center">
                            <div class="card-head pt-3 mx-auto">
                                <img src="{{ $electronic->image ? asset('storage/' . $electronic->image) : asset('images/no-image.png') }}"
                                    class="" height="150rem" width="auto" alt="electronic image">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a
                                        href="/electronics/{{ $electronic->id }}">{{ $electronic->manufacturer }}
                                        {{ $electronic->model }}</a>
                                </h5>
                                <x-electronic-tags :tagsCsv="$electronic->tags" />
                                <p class="card-text">Availability:
                                    @if ($hires->where('electronic_id', $electronic->id)->where('returned', 0)->count() > 0)
                                        <span class="text-primary">Unavailable</span>
                                    @else
                                        <span class="text-primary">Available</span>
                                    @endif
                                </p>
                                @role('admin')
                                @else
                                    @if ($hires->where('electronic_id', $electronic->id)->where('returned', 0)->count() > 0)
                                    @else
                                        <a href="/hire/request/{{ $electronic->id }}" class="btn btn-primary">Request to
                                            hire</a>
                                    @endif
                                @endrole
                            </div>
                            <div class="card-footer">
                                <p class="text-sm"> posted by {{ $users->find($electronic->owner_id)->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 p-3 mb-3 mx-auto">
                    <div class="text-center">
                        <img class="h-50" src="{{ asset('gifs/not-interesting.gif') }}">
                    </div>
                    <div class="text-center">
                        <p class="fs-6 text-dark">
                            There are no electronics posted for hire yet! come back later
                        </p>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            {{ $electronics->links() }}
        </div>
    </div>
@endsection
