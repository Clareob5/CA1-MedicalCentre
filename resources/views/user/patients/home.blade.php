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
                    Hi {{ Auth::user()->name }}
                    </br>
                    Email: {{ Auth::user()->email }}
                    </br>
                    Policy Number: {{ Auth::user()->patient->policy_num }}
                    </br>
                    Phone: {{ Auth::user()->phone }}
                    </br>
                 </div>
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
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->patient->visits as $visit)
                            <tr>
                                <th>{{ $visit->date }}</th>
                                <th>{{ $visit->start_time }}</th>
                                <th>{{ $visit->end_time }}</th>
                                <th>{{ $visit->duration }}</th>
                                <th>{{ $visit->cost }}</th>
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
