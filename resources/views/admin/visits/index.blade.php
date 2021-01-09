@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

          <p id="alert-message" class"alert collapse"></p>

            <div class="card">
                <div class="card-header">
                  <h4>Visits</h4>
                  <a href="{{ route('admin.visits.create')}}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if (count($visits) === 0)
                      <p>There are no Visits</p>
                    @else
                      <table id="table-visits" class="table table-light table-striped table-hover">
                        <thead class="thead-dark">
                          <th>Date</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Duration</th>
                          <th>Cost</th>
                          <th>Patients Name</th>
                          <th>Doctors Name</th>
                          <th>Actions</th>
                        <tbody>
                          @foreach ($visits as $visit)
                            <tr data-id="{{ $visit->id }}">
                              <td>{{ date('j F, Y', strtotime($visit->date)) }}</td>
                              <td>{{ date('G:i', strtotime($visit->start_time)) }}</td>
                              <td>{{ date('G:i', strtotime($visit->end_time)) }}</td>
                              <td>{{ date('G', strtotime($visit->duration)) }} hour's</td>
                              <td>€{{ $visit->cost }}</td>
                              <td>{{ $visit->patient->user->name }}</td>
                              <td>{{ $visit->doctor->user->name }}</td>
                              <td>
                                <a href="{{ route('admin.visits.show', $visit->id )}}" class="btn btn-outline-primary">View</a>
                                <a href="{{ route('admin.visits.edit', $visit->id )}}" class="btn btn-outline-warning">Edit</a>
                                <form style="display:inline-block" method="POST" action="{{ route('admin.visits.destroy', $visit->id) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="form-control btn btn-outline-danger">Delete</button>
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
