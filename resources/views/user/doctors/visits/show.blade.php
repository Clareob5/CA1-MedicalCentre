@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                  <h2>Visit Information</h2
                </div>

                <div class="card-body">
                      <table class="table table-hover">
                        <tbody>
                            <tr>
                              <td>Date</td>
                              <td>{{ date('j F, Y', strtotime($visit->date)) }}</td>
                            </tr>

                            <tr>
                              <td>Start Time</td>
                              <td>{{ date('G:i', strtotime($visit->start_time)) }}</td>
                            </tr>
                            <tr>
                              <td>Time</td>
                              <td>{{ date('G:i', strtotime($visit->end_time)) }}</td>
                            </tr>
                            <tr>
                              <td>Time</td>
                              <td>{{ date('G', strtotime($visit->duration)) }}</td>
                            </tr>
                            <tr>
                              <td>Cost</td>
                              <td>€{{  $visit->cost }}</td>
                            </tr>
                            <tr>
                              <td>Patient</td>
                              <td>{{  $visit->patient->user->name }}</td>
                            </tr>
                            <tr>
                              <td>Doctor</td>
                              <td>Dr. {{ $visit->doctor->user->name}}</td>
                            </tr>
                        </tbody>
                      </table>
                    <a href="{{ route('admin.visits.index')}}" class="btn">Back</a>
                    <a href="{{ route('admin.visits.edit', $visit->id)}}" class="btn btn-secondary">Edit</a>
                    <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', $visit->id) }}">
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
