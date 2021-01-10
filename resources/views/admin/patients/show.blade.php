@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  <h3>Name: {{ $patient->user->name }}</h3>
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>
                            <tr>
                              <td>Name</td>
                              <td>{{ $patient->user->name }}</td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td>{{ $patient->user->address }}</td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td>{{  $patient->user->phone }}</td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td>{{  $patient->user->email }}</td>
                            </tr>
                            <tr>
                              <td>Insurance Company</td>
                              {{-- this if statment is for displaying a value when the patient does not have insurance --}}
                              @if($patient->med_insurance_id === NULL)
                                <td>No Insurance</td>
                               @else
                                  <td>{{ $patient->med_insurance->insurance_company }}</td>
                                @endif
                            </tr>
                            <tr>
                              <td>Policy Number</td>
                              @if($patient->med_insurance_id === NULL)
                                <td>Not Applicable</td>
                               @else
                              <td>{{ $patient->policy_num }}</td>
                            @endif
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.patients.index')}}" class="btn btn-outline-dark">Back</a>
                    <a href="{{ route('admin.patients.edit', $patient->id)}}" class="btn btn-outline-secondary">Edit</a>
                    {{-- Delete modal displays a message to confirm that you want to delete the patient --}}
                    <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-modal">Delete</a>
                    <div class="clearfix"></div>
                    <div class="modal fade" id="delete-modal">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Patient</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure! If this patient has any visits they will be deleted</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.patients.destroy', $patient->id) }}" id="delete-form">
                        @csrf
                        @method('DELETE')
                </div>
            </div>

            <div class="card">
            <div class="card-header">
              <h2> Visits </h2>
              <a href="{{ route('admin.visits.create', $patient->id)}}" class="btn btn-primary float-right">Add</a>
            </div>
            <div class="card-body">
              @if (count($patient->visits) == 0)
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
                    @foreach ($patient->visits as $visit)
                    <tr>
                        <td>{{ $visit->date }}</td>
                        <td>{{ $visit->start_time }}</td>
                        <td>{{ $visit->end_time }}</td>
                        <td>{{ $visit->duration }}</td>
                        <td>{{ $visit->cost }}</td>
                        <td>{{ $visit->doctor->user->name }}</td>
                        <th>
                            <a href="{{ route('admin.visits.show', $visit->id )}}" class="btn btn-outline-primary">View</a>
                            <a href="{{ route('admin.visits.edit', $visit->id )}}" class="btn btn-outline-warning">Edit</a>
                            <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', [ 'id' => $patient->id, 'rid' => $visit->id]) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-outline-danger">Cancel</a>
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
