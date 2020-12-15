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
            </div>
        </div>
    </div>
</div>
@endsection
