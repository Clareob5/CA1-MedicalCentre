@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as a doctor!') }}
                  </br>

                  Hi {{ Auth::user()->name }}
                </br>
                Email: {{ Auth::user()->email }}
                </br>
                Date Started: {{ Auth::user()->doctor->date_started }}
                </br>
                Phone: {{ Auth::user()->phone }}
                </br>
               </div>
             </div>
             <div class="card">
               <div class="card-header">
                 Visits
                   <a href="{{ route('user.doctors.visits.create')}}" class="btn btn-primary float-right">Add</a>
               </div>
               <div class="card-body">
                 @if (count(Auth::user()->doctor->visits) == 0)
                 <p>There are no visits for this doctor.</p>
               @else
               <table class="table">
                   <thead>
                       <th>Date</th>
                       <th>Start Time</th>
                       <th>End Time</th>
                       <th>Duration</th>
                       <th>Cost</th>
                       <th>Actions</th>
                   </thead>
                   <tbody>
                       @foreach (Auth::user()->doctor->visits as $visit)
                       <tr>
                           <td>{{ $visit->date }}</td>
                           <td>{{ $visit->start_time }}</td>
                           <td>{{ $visit->end_time }}</td>
                           <td>{{ $visit->duration }}</td>
                           <td>€{{ $visit->cost }}</td>
                           <th>
                                 <a href="{{ route('user.doctors.visits.edit', $visit->id)}}" class="btn btn-secondary">Edit</a>
                               <form style="display:inline-block" method="POST" action="{{ route('user.doctors.visits.destroy', [ 'id' => $visit->id]) }}">
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
</div>
@endsection
