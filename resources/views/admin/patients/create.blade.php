@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
     <div class="card">
       <div class="card-header">
         Add New Patient
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
        <form action="{{ route('admin.patients.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" />
                </div>
                <div class="form-check margin-top">
                    <label class="form-check-label" for="has_insurance">Check box if you have insurance</label>
                    <input type="hidden" name="has_insurance" value="0"/>
                    <input type="checkbox" class="form-check-input checkbox" name="has_insurance" id="has_insurance" value="1" {{ old('has_insurance') ? 'checked="checked"' : '' }} />
                </div>
                <div>Dont fill in the two following fields if you dont have insurance</div>
                <div class="form-group">
                    <label for="insurance_company">Insurance Company</label>
                    <select class="form-control" name='med_insurance_id'>
                       <option value=''>Select Insurance Company</option>
                      @foreach ($med_insurances as $med_insurance)
                        <option value="{{ $med_insurance->id }}" {{ (old('med_insurance_id') == $med_insurance->id) ? "selected" : "" }}>{{ $med_insurance->insurance_company }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="policy_num">Policy Number</label>
                    <input type="text" class="form-control" name="policy_num" id="policy_num" value="{{ old('policy_num') }}" />
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
