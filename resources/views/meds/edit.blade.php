@extends('common.main')

@section('content')

<a href="/meds"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>

<h5>Edit Medication</h5>

<div class="row">

   <div class="col-md-4">
   
      <form action="/meds/{{ $med->id }}" method="POST">
         <div class="form-group form-group-sm">

          {{ method_field('PATCH') }}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="input-group">

            <span class="input-group-addon" id="basic-addon1">Name</span>

            <input type="text" name="name" class="form-control" value="{{$med->name}}" aria-describedby="basic-addon1">
          </div>
          <br>
          <div class="input-group">

              <span class="input-group-addon" id="basic-addon1">Type</span>

              <select  name="type_id" class="form-control" id="sel1">
                <option class="form-control" selected value="{{ $med->type->id }}">{{$med->type->type}}</option>
                <option class="form-control">---</option>
                @foreach ($types as $type) 
                  <option class="form-control" value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach

              </select>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Active</span>
              <input type="text" name="ingredient" class="form-control" value="{{ $med->ingredient }}" aria-describedby="basic-addon1">         
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Dose</span>

            <input type="text" name="dosage" class="form-control" value="{{ $med->dosage }}" aria-describedby="basic-addon1">
            </div>
            <br>


             <button class="btn btn-primary" type="submit">Update Med</button>
          </div>
        </form>

    </div> 
</div>

<div class="row">

    <div class="col-md-4">

        <form action="/meds/{{ $med->id }}" method="POST">
          
          {{ method_field('DELETE') }}


          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="btn btn-danger" type="submit">Delete Med</button>

        </form>
    </div>

</div>

@stop
