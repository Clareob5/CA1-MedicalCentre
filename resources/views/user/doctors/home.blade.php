@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <h2 class="card-header">{{ __('Dashboard') }}</h2>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>Hi {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Date Started: {{ Auth::user()->doctor->date_started }}</p>
                    <p>Phone: {{ Auth::user()->phone }}</p>
                    </br>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Visits
                    <a href="{{ route('user.doctors.visits.create', Auth::user()->doctor->id)}}" class="btn btn-outline-primary float-right">Add</a>
                </div>
                <div class="card-body">
                    @if (count(Auth::user()->doctor->visits) == 0)
                    <p>There are no visits for this doctor.</p>
                    @else
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>Cost</th>
                            <th>Patient</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->doctor->visits as $visit)
                            <tr>
                                <td>{{ date('j F, Y', strtotime($visit->date)) }}</td>
                                <td>{{ date('G:i', strtotime($visit->start_time)) }}</td>
                                <td>{{ date('G:i', strtotime($visit->end_time)) }}</td>
                                <td>{{ date('G:i', strtotime($visit->duration)) }}hr/s</td>
                                <td>€{{ $visit->cost }}</td>
                                <td>{{ $visit->patient->user->name }}</td>
                                <th>
                                    <a href="{{ route('user.doctors.visits.edit', $visit->id)}}" class="btn btn-outline-secondary">Edit</a>
                                    <form style="display:inline-block" method="POST" action="{{ route('user.doctors.visits.destroy', [ 'id' => $visit->id]) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="form-control btn btn-outline-danger">Cancel</a>
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
