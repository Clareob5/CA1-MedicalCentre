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
                            <th>Time</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->patient->visits as $visit)
                            <tr>
                                <th>{{ $visit->date }}</th>
                                <th>{{ $visit->time }}</th>
                                <th>
                                    <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', [ 'id' => Auth::user()->patient->id, 'rid' => $visit->id]) }}">
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
