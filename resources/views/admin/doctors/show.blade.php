@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Name: {{ $doctor->user->name }}
                </div>

                <div class="card-body">
                      <table class="table table-hover ">
                        <tbody>
                            <tr>
                              <td>Name</td>
                              <td>Dr. {{ $doctor->user->name }}</td>
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
                              <td>{{ date('j F, Y', strtotime($doctor->date_started)) }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.doctors.index')}}" class="btn">Back</a>
                    <a href="{{ route('admin.doctors.edit', $doctor->id)}}" class="btn btn-secondary">Edit</a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal">Delete</a>
                    <div class="clearfix"></div>
                    <div class="modal fade" id="delete-modal">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Doctorr</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure! this doctor may have visits</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}" id="delete-form">
                        @csrf
                        @method('DELETE')
                </div>
                <div class="card-header">
                  Visits
                  <a href="{{ route('admin.visits.create', $doctor->id )}}" class="btn btn-primary float-right">Add</a>
                </div>
                <div class="card-body">
                  @if (count($doctor->visits) == 0)
                  <p>There are no visits for this doctor.</p>
                @else
                <table class="table">
                    <thead class="thead-dark">
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Cost</th>
                        <th>Patient</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($doctor->visits as $visit)
                        <tr>
                            <td>{{ date('j F, Y', strtotime($visit->date)) }}</td>
                            <td>{{ date('G:i', strtotime($visit->start_time)) }}</td>
                            <td>{{ date('G:i', strtotime($visit->end_time)) }}</td>
                            <td>{{ date('G', strtotime($visit->duration)) }} hour's</td>
                            <td>€{{ $visit->cost }}</td>
                            <td>{{ $visit->patient->user->name }}</td>
                            <th>
                                <a href="{{ route('admin.visits.show', $visit->id )}}" class="btn btn-primary">View</a>
                                <a href="{{ route('admin.visits.edit', $visit->id )}}" class="btn btn-warning">Edit</a>
                                <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', [ 'id' => $visit->doctor->id, 'rid' => $visit->id]) }}">
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
