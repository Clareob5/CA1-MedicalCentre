@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

          <p id="alert-message" class"alert collapse"></p>

            <div class="card">
                <div class="card-header">
                  Patients
                  <a href="{{ route('admin.patients.create')}}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if (count($patients) === 0)
                      <p>There are no Patients</p>
                    @else
                      <table id="table-patients" class="table table-hover">
                        <thead>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Policy Number</th>
                        <tbody>
                          @foreach ($patients as $patient)
                            <tr data-id="{{ $patient->id }}">
                              <td>{{ $patient->user->name }}</td>
                              <td>{{ $patient->user->address }}</td>
                              <td>{{ $patient->user->phone }}</td>
                              <td>{{ $patient->user->email }}</td>
                              <td>{{ $patient->policy_num }}</td>
                              <td>
                                <a href="{{ route('admin.patients.show', $patient->id )}}" class="btn btn-primary">View</a>
                                <a href="{{ route('admin.patients.edit', $patient->id )}}" class="btn btn-warning">Edit</a>
                                <form style="display:inline-block" method="POST" action="{{ route('admin.patients.destroy', $patient->id) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="form-control btn btn-danger">Delete</button>
                                </form>
                              </td>
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
