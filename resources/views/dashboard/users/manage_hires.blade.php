@extends('layout.layout')

@section('content')
    <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Your Hires</h3>
    </div>
    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info">Electronics hired out</h3>
        </div>
    </div>
    <div class="row">
        @if ($hires->where('returned', 0)->count() > 0)
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Customer</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Accept Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hires as $hire)
                            @unless($hire->returned == 1)
                                <tr>
                                    <td scope="row">
                                        {{ $electronics->find($hire->electronic_id)->manufacturer . ' ' . $electronics->find($hire->electronic_id)->model }}
                                    </td>
                                    <td scope="row">{{ $users->find($hire->customer_id)->name }}</td>
                                    <td scope="row">{{ $hire->start_date }}</td>
                                    <td scope="row">{{ $hire->return_date }}</td>
                                    <td scope="row">
                                        <form action="/hire/{{ $hire->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="returned" value="1">
                                            <button class="btn p-1 btn-success">Receive Electronic</button>
                                        </form>
                                    </td>
                                </tr>
                            @endunless
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/not-interesting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        Nothing here at the moment.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info">Hire Out History</h3>

        </div>
    </div>
    <div class="row">
        @if ($hires->where('returned', 1)->count() > 0)
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Customer</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Returned On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hires as $hire)
                            @unless($hire->returned == 0)
                                <tr>
                                    <td scope="row">
                                        {{ $electronics->find($hire->electronic_id)->manufacturer . ' ' . $electronics->find($hire->electronic_id)->model }}
                                    </td>
                                    <td scope="row">{{ $users->find($hire->customer_id)->name }}</td>
                                    <td scope="row">{{ $hire->start_date }}</td>
                                    <td scope="row">{{ $hire->return_date }}</td>
                                    <td scope="row">
                                        {{ $hire->updated_at }}
                                    </td>
                                </tr>
                            @endunless
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/not-interesting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        No hires completed
                    </p>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info">Your Hiring History</h3>

        </div>
    </div>
    <div class="row">
        @if ($hired->where('customer_id', Auth::user()->id)->count() > 0)
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Owner</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hired->where('customer_id', Auth::user()->id) as $hire)

                                <tr>
                                    <td scope="row">
                                        {{ $electronics->find($hire->electronic_id)->manufacturer . ' ' . $electronics->find($hire->electronic_id)->model }}
                                    </td>
                                    <td scope="row">{{ $users->find($hire->owner_id)->name }}</td>
                                    <td scope="row">{{ $hire->start_date }}</td>
                                    <td scope="row">{{ $hire->return_date }}</td>
                                    <td scope="row">
                                        @if ($hire->returned == 1)
                                            <span class="bg-success p-1 text-white">Returned</span>
                                        @else
                                        <span class="bg-warning p-1 text-white">Not Returned</span>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/not-interesting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        No successful hires
                    </p>
                </div>
            </div>
        @endif
@endsection
