@extends('layout.layout')

@section('content')
    <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Hires</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Electronic</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Customer</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Return Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hires as $hire)
                        <tr>
                            <td scope="row">{{ $electronics->find($hire->electronic_id)->manufacturer . " " . $electronics->find($hire->electronic_id)->model }}</td>
                            <td scope="row">{{ $users->find($hire->owner_id)->name }}</td>
                            <td scope="row">{{ $users->find($hire->customer_id)->name }}</td>
                            <td scope="row">{{ $hire->start_date }}</td>
                            <td scope="row">{{ $hire->return_date }}</td>
                            <td scope="row"> @unless ( $hire->returned == 1)
                                                Not returned
                                            @else
                                                Returned
                                            @endunless

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
