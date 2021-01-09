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
                          <th>Insurance Company</th>
                          <th>Policy Number</th>
                        <tbody>
                          @foreach ($patients as $patient)
                            <tr data-id="{{ $patient->id }}">
                              <td>{{ $patient->user->name }}</td>
                              <td>{{ $patient->user->address }}</td>
                              <td>{{ $patient->user->phone }}</td>
                              <td>{{ $patient->user->email }}</td>
                              <td>{{ $patient->med_insurance->insurance_company }}</td>
                              <td>{{ $patient->policy_num }}</td>
                              <td>
                                <a href="{{ route('admin.patients.show', $patient->id )}}" class="btn btn-primary">View</a>
                                <a href="{{ route('admin.patients.edit', $patient->id )}}" class="btn btn-warning">Edit</a>
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
                                            <p>Are you sure! this patient may have visits</p>
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
