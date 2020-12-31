@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
     <div class="card">
       <div class="card-header">
         Edit Patient
       </div>

       <div class="card-body">
         @if($errors->any())
             <div class="alert alert-danger">
               <ul>
                 @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                 @endforeach
               </ul>
             </div>
         @endif
        <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $patient->user->name) }}" />
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $patient->user->address) }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $patient->user->phone) }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $patient->user->email) }}" />
                </div>
                <div class="form-group">
                    <label for="has_insurance">Check box if you have insurance</label>
                    <input type="hidden" name="has_insurance" value="0"/>
                    <input type="checkbox" class="form-control checkbox" name="has_insurance" id="has_insurance" value="1" {{ old('has_insurance', $patient->has_insurance) ? 'checked="checked"' : '' , }} />
                </div>
                <div class="form-group">
                    <label for="insurance_company">Insurance Company</label>
                    <input type="text" class="form-control" name="insurance_company" id="insurance_company" value="{{ old('insurance_company', $patient->insurance_company) }}" />
                </div>
                <div class="form-group">
                    <label for="policy_num">Policy Number</label>
                    <input type="text" class="form-control" name="policy_num" id="policy_num" value="{{ old('policy_num', $patient->policy_num) }}" />
                </div>
                <div>
                  <a href="{{ route('admin.patients.index') }}" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </form>
           </div>
        </div>
      </div>
   </div>
</div>
@endsection
