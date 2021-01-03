@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Name: {{ $doctor->user->name }}
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>
                            <tr>
                              <td>Name</td>
                              <td>{{ $doctor->user->name }}</td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td>{{ $doctor->user->address }}</td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td>{{  $doctor->user->phone }}</td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td>{{  $doctor->user->email }}</td>
                            </tr>
                            <tr>
                              <td>Date Started</td>
                              <td>{{ $doctor->date_started }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.doctors.index')}}" class="btn">Back</a>
                    <a href="{{ route('admin.doctors.edit', $doctor->id)}}" class="btn btn-secondary">Edit</a>
                    <form style="display:inline-block" method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="form-control btn btn-danger">Delete</button>
                    </form>
                </div>
                <div class="card-header">
                  Visits
                  <a href="{{ route('admin.visits.create')}}" class="btn btn-primary float-right">Add</a>
                </div>
                <div class="card-body">
                  @if (count($doctor->visits) == 0)
                  <p>There are no visits for this patient.</p>
                @else
                <table class="table">
                    <thead>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Patient</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($doctor->visits as $visit)
                        <tr>
                            <th>{{ $visit->date }}</th>
                            <th>{{ $visit->time }}</th>
                            <th>{{ $visit->patient->user->name }}</th>
                            <th>
                                <a href="{{ route('admin.visits.show', $visit->id )}}" class="btn btn-primary">View</a>
                                <a href="{{ route('admin.visits.edit', $visit->id )}}" class="btn btn-warning">Edit</a>
                                <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', [ 'id' => $patient->id, 'rid' => $visit->id]) }}">
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
@endsection
