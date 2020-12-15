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
                Address: {{ Auth::user()->doctor->date_started }}
                </br>
                Phone: {{ Auth::user()->phone }}
                </br>
               </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
