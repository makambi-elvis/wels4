@extends('layout.layout')

@section('content')

<div class="row pb-4 text-center text-primary">
    <h1>{{$electronic->manufacturer}} {{$electronic->model}}</h1>
    <p class="fs-6 text-secondary">
    	posted on {{$electronic->created_at}}
    </p>
</div>

<div class="row">
    <div class="d-flex justify-content-center">
    <div class="card rounded-0 border-white shadow bg-gray text-center mb-3 col-xs-12 col-md-6">
        <img src="{{$electronic->image ? asset('storage/' . $electronic -> image) : asset('images/no-image.png')}}" class="card-img-top" alt="electronic image">
        <div class="card-body">
            <p class="card-text">{{$electronic->description}}</p>
            <div>
                <table class="table table-striped table-success shadow-sm">
                    <tr>
                        <td>
                            Estimated value
                        </td>
                        <td>
                            Ksh {{$electronic -> estimated_value}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Daily charges
                        </td>
                        <td>
                            Ksh {{$electronic -> cost_per_day}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Availability
                        </td>
                        <td>
                            @if ($hires->where('electronic_id', $electronic->id)->where('returned', 0)->count() > 0)
                                Unavailable
                            @else
                               Available
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection
