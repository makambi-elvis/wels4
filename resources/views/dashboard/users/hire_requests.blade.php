@extends('layout.layout')

@section('content')
    <div class="row bg-secondary mx-auto mb-3 text-light text-center">
        <h3 class="my-3">Your Hires Requests</h3>
    </div>

    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info"> Hire Requests Received</h3>
        </div>

        @if ($receivedHireRequests->count() < 1)
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/not-interesting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        No hire requests sent yet.
                    </p>
                </div>
            </div>
        @else
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Requestor</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Days requested</th>
                            <th scope="col">Charges per day</th>
                            <th scope="col">Gross income</th>
                            <th scope="col">Insurance charges</th>
                            <th scope="col">Net income</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($receivedHireRequests as $receivedHireRequest)
                            <tr>
                                <td>{{ $receivedHireRequest->electronic_make . ' ' . $receivedHireRequest->model }}</td>
                                <td>{{ $receivedHireRequest->name }}</td>
                                <td>{{ '0' . $receivedHireRequest->phone_number }}</td>
                                <td>{{ $receivedHireRequest->days }}</td>
                                <td>{{ $receivedHireRequest->daily_charges }}</td>
                                <td>{{ $receivedHireRequest->days * $receivedHireRequest->daily_charges }}</td>
                                <td>{{ 0.05 * $receivedHireRequest->electronic_value }}</td>
                                <td>{{ $receivedHireRequest->days * $receivedHireRequest->daily_charges - 0.05 * $receivedHireRequest->electronic_value }}
                                </td>
                                <td>
                                    @if ($receivedHireRequest->accepted == 1)
                                        <span class="p-2 bg-success text-white">Accepted</span>
                                    @elseif ($receivedHireRequest->rejected == 1)
                                        <span class="p-2 bg-danger text-white">Rejected</span>
                                    @else
                                        <div class="btn-group" role="group" aria-label="hireRequestFunctionality">
                                            {{-- Accept form --}}
                                            <form action="/hire/request/accept/{{ $receivedHireRequest->id }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="accepted" value="1">
                                                <input type="hidden" name="rejected" value="0">
                                                <button class="btn btn-success">Accept</button>
                                            </form>

                                            {{-- decline form --}}
                                            <form class="btn-group"
                                                action="/hire/request/decline/{{ $receivedHireRequest->id }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="rejected" value="1">
                                                <input type="hidden" name="accepted" value="0">
                                                <button class="btn btn-danger">Decline</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info"> Hire Requests You Have Accepted</h3>
        </div>

        @if ($receivedHireRequests->where('accepted', 1)->count() < 1)
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/waiting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        No hire requests accepted yet.
                    </p>
                </div>
            </div>
        @else
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Requestor</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Days requested</th>
                            <th scope="col">Charges per day</th>
                            <th scope="col">Gross income</th>
                            <th scope="col">Insurance charges</th>
                            <th scope="col">Net income</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receivedHireRequests->where('accepted', 1) as $receivedHireRequest)
                            <tr>
                                <td>{{ $receivedHireRequest->electronic_make . ' ' . $receivedHireRequest->model }}</td>
                                <td>{{ $receivedHireRequest->name }}</td>
                                <td>{{ '0' . $receivedHireRequest->phone_number }}</td>
                                <td>{{ $receivedHireRequest->days }}</td>
                                <td>{{ $receivedHireRequest->daily_charges }}</td>
                                <td>{{ $receivedHireRequest->days * $receivedHireRequest->daily_charges }}</td>
                                <td>{{ 0.05 * $receivedHireRequest->electronic_value }}</td>
                                <td>{{ $receivedHireRequest->days * $receivedHireRequest->daily_charges - 0.05 * $receivedHireRequest->electronic_value }}
                                </td>
                                <td>
                                    @if ($hires->where('hireRequest_id', $receivedHireRequest->id)->count() == 0)
                                        <div class="btn-group" role="group" aria-label="hireRequestFunctionality">
                                            {{-- Hire out form --}}
                                            {{-- Button trigger modal --}}
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Finish Up
                                            </button>

                                            {{-- Modal --}}
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Hire
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> Only click the hire out button once you have met and handed
                                                                over the electronic.</p>
                                                            <p> Make sure you have paid your insurance premium to XYZ Insurance <span class="text-primary">paybill 123456 Account WELS-Your ID</span> to cover for loss or damages</p>
                                                            <p class="text-info">Your electronic is expected to be returned
                                                                on
                                                                {{ $currentDate->addDay($receivedHireRequest->days)->toDateTimeString() }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <form method="POST" action="/hire/out">
                                                                @csrf
                                                                <input type="hidden" name="hireRequest_id"
                                                                    value="{{ $receivedHireRequest->id }}">
                                                                <input type="hidden" name="electronic_id"
                                                                    value="{{ $receivedHireRequest->electronic_id }}">
                                                                <input type="hidden" name="customer_id"
                                                                    value="{{ $receivedHireRequest->user_id }}">
                                                                <input type="hidden" name="start_date"
                                                                    value="{{ $currentDate }}">
                                                                <input type="hidden" name="return_date"
                                                                    value="{{ $currentDate->addDay($receivedHireRequest->days) }}">

                                                                <button type="submit" class="btn btn-primary">Hire Out
                                                                    Item</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Cancel form --}}
                                            <form class="btn-group"
                                                action="/hire/request/decline/{{ $receivedHireRequest->id }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="rejected" value="1">
                                                <input type="hidden" name="accepted" value="0">
                                                <button class="btn btn-danger">Cancel</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="p-2 bg-success text-white">Hired Out</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info"> Hire Requests You Have Rejected</h3>
        </div>

        @if ($receivedHireRequests->where('rejected', 1)->count() < 1)
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/waiting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        No hire requests rejected yet.
                    </p>
                </div>
            </div>
        @else
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Requestor</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Days requested</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receivedHireRequests->where('rejected', 1) as $receivedHireRequest)
                            <tr>
                                <td>{{ $receivedHireRequest->electronic_make . ' ' . $receivedHireRequest->model }}</td>
                                <td>{{ $receivedHireRequest->name }}</td>
                                <td>{{ '0' . $receivedHireRequest->phone_number }}</td>
                                <td>{{ $receivedHireRequest->days }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 p-2 m-3 shadow">
            <h3 class="text-center text-info"> Hire Requests Sent</h3>
        </div>

        @if ($sentHireRequests->count() < 1)
            <div class="col-12 p-3 mb-3 mx-auto">
                <div class="text-center">
                    <img class="h-50" src="{{ asset('gifs/waiting.gif') }}">
                </div>
                <div class="text-center">
                    <p class="fs-6 text-primary">
                        No hire requests sent yet.
                    </p>
                </div>
            </div>
        @else
            <div class="table-responsive col-12 p-3 mb-3 mx-auto">
                <table class="table align-middle text-center table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Electronic</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Email</th>
                            <th scope="col">Days requested</th>
                            <th scope="col">Charges per day</th>
                            <th scope="col">Gross Charges</th>
                            <th scope="col">Request status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sentHireRequests as $sentHireRequest)
                            <tr>
                                <td>{{ $sentHireRequest->electronic_make . ' ' . $sentHireRequest->model }}</td>
                                <td>{{ $user->find($sentHireRequest->owner_id)->name }}</td>
                                <td>{{ $user->find($sentHireRequest->owner_id)->email }}</td>
                                <td>{{ $sentHireRequest->days }}</td>
                                <td>{{ $sentHireRequest->daily_charges }}</td>
                                <td>{{ $sentHireRequest->days * $sentHireRequest->daily_charges }}</td>
                                <td>
                                    @if ($sentHireRequest->accepted == 1)
                                        <span class="p-2 bg-success text-white">Accepted</span>
                                    @elseif ($sentHireRequest->rejected == 1)
                                        <span class="p-2 bg-danger text-white">Rejected</span>
                                    @else
                                        <span class="p-2 bg-warning text-white">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
