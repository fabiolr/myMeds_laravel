@extends('common.main')

@section('content')

<h5>Edit Medication</h5>

<form action="/meds/{{ $med->id }}" method="POST">
  
  {{ method_field('PATCH') }}

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
            <div class="col-md-3">

              <input type="text" name="name" class="form-control" value="{{$med->name}}" aria-describedby="basic-addon1">
            </div>

            <div class="col-md-2">


          <div class="form-group form-group-sm">

              <select  name="type_id" class="form-control" id="sel1">
                <option class="form-control" selected value="{{ $med->type->id }}">{{$med->type->type}}</option>
                <option class="form-control">---</option>
                @foreach ($types as $type) 
                  <option class="form-control" value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
        
            </select>
            </div>
        </div>

            <div class="col-md-3">
            <input type="text" name="ingredient" class="form-control" value="{{ $med->ingredient }}" aria-describedby="basic-addon1">
        </div>

            <div class="col-md-2">

            <input type="text" name="dosage" class="form-control" value="{{ $med->dosage }}" aria-describedby="basic-addon1">
        </div>

            <div class="col-md-2">

            <button class="btn btn-primary" type="submit">Update Med</button>
        </div>

    </div>

  </form>

<form action="/meds/{{ $med->id }}" method="POST">
  
  {{ method_field('DELETE') }}

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <button class="btn btn-danger" type="submit">Delete Med</button>


@stop
