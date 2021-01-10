@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

          <p id="alert-message" class"alert collapse"></p>

            <div class="card">
                <div class="card-header">
                  <h2>Visits</h2>
                  <a href="{{ route('admin.visits.create')}}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if (count($visits) === 0)
                      <p>There are no Visits</p>
                    @else
                      <table id="table-visits" class="table table-hover">
                        <thead>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Cost</th>
                          <th>Patients Name</th>
                          <th>Doctors Name</th>
                        <tbody>
                          @foreach ($visits as $visit)
                            <tr data-id="{{ $visit->id }}">
                              <td>{{ $visit->date }}</td>
                              <td>{{ $visit->start_time }}</td>
                              <td>{{ $visit->end_time }}</td>
                              <td>{{ $visit->duration }}</td>
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
