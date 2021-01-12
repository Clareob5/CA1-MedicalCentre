@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <p id="alert-message" class"alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h4>Doctors</h4>
                    <a href="{{ route('admin.doctors.create')}}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if (count($doctors) === 0)
                    <p>There are no Doctors</p>
                    @else
                    <table id="table-doctors" class="table table-hover">
                        <thead class="thead-dark">
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date Started</th>
                            <th>Actions</th>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr data-id="{{ $doctor->id }}">
                                <td>Dr. {{ $doctor->user->name }}</td>
                                <td>{{ $doctor->user->address }}</td>
                                <td>{{ $doctor->user->phone }}</td>
                                <td>{{ $doctor->user->email }}</td>
                                <td>{{ date('j F, Y', strtotime($doctor->date_started)) }}</td>
                                <td>
                                    <a href="{{ route('admin.doctors.show', $doctor->id )}}" class="btn btn-outline-primary">View</a>
                                    <a href="{{ route('admin.doctors.edit', $doctor->id )}}" class="btn btn-outline-warning">Edit</a>
                                    <form style="display:inline-block" method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="form-control btn btn-outline-danger">Delete</button>
                                    </form>

                                    {{-- <a href="{{ route('admin.doctors.destroy', $doctor->id) }}" class="btn btn-outline-danger">Delete</a>
                                    <div class="clearfix"></div>
                                    <div class="modal fade" id="delete-modal">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Doctor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure! If this doctor has visits they will also be deleted</p>
                                            </div>
                                            <div class="modal-footer">
                                              <form style="display:inline-block" method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}">
                                                  <input type="hidden" name="_method" value="DELETE">
                                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                  <button type="submit" class="btn btn-outline-danger">Proceed</button>
                                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                              </form>

                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}" id="delete-form">
                                    @csrf
                                    @method('DELETE') --}}
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
