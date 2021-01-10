@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in as a patient!') }}

                    </br>
                    </br>
                    <p>Hi {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Phone: {{ Auth::user()->phone }}</p>
                    <p>Address: {{ Auth::user()->address }}</p>
                    @if(Auth::user()->patient->med_insurance_id === NULL)

                        @else
                        <p>Insurance Company: {{ Auth::user()->patient->med_insurance->insurance_company }}</p>
                        @endif

                        @if(Auth::user()->patient->med_insurance_id === NULL)

                            @else
                            <p>Policy Number: {{ Auth::user()->patient->policy_num }}</p>
                            @endif

                            </br>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Visits
                </div>
                <div class="card-body">
                    @if (count(Auth::user()->patient->visits) == 0)
                    <p>There are no visits for this patient.</p>
                    @else
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>Cost</th>
                            <th>Doctor</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->patient->visits as $visit)
                            <tr>
                                <td>{{ date('j F, Y', strtotime($visit->date)) }}</td>
                                <td>{{ date('G:i', strtotime($visit->start_time)) }}</td>
                                <td>{{ date('G:i', strtotime($visit->end_time)) }}</td>
                                <td>{{ date('G:i', strtotime($visit->duration)) }}</td>
                                <td>€{{ $visit->cost }}</td>
                                <td>Dr. {{ $visit->doctor->user->name}}
                                <th>
                                    <form style="display:inline-block" method="POST" action="{{ route('user.patients.visits.destroy', [ 'id' => $visit->id]) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="form-control btn btn-danger">Cancel</a>
                                    </form>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
