@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  Name: {{ $patient->user->name }}
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
                              <td>{{ $patient->med_insurance->insurance_company}}</td>
                            </tr>
                            <tr>
                              <td>Policy Number</td>
                              <td>{{ $patient->policy_num }}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.patients.index')}}" class="btn">Back</a>
                    <a href="{{ route('admin.patients.edit', $patient->id)}}" class="btn btn-secondary">Edit</a>
                    <form style="display:inline-block" method="POST" action="{{ route('admin.patients.destroy', $patient->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="form-control btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-header">
              Visits
              <a href="{{ route('admin.visits.create')}}" class="btn btn-primary float-right">Add</a>
            </div>
            <div class="card-body">
              @if (count($patient->visits) == 0)
              <p>There are no visits for this patient.</p>
            @else
            <table class="table">
                <thead>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($patient->visits as $visit)
                    <tr>
                        <th>{{ $visit->date }}</th>
                        <th>{{ $visit->time }}</th>
                        <th>{{ $visit->doctor->user->name }}</th>
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
@endsection
