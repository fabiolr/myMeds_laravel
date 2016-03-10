@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif

  <h5>System Wide Meds</h5>




<div class="table-responsive">

            <table class="table table-striped">
              <thead>
                <tr>
					
                </tr>
                <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Active Ingredient</th>
                  <th>Dosage</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              
              	@foreach ($meds as $med)

              		<tr>
              		 <td> {{$med["name"] }} </td>
					 <td> {{$med->type["type"]}} </td>
              		 <td> {{$med["ingredient"]}} </td>
              		 <td> {{$med["dosage"]}} </td>
              		 <td>
              		 <a href="/meds/{{$med['id']}}/edit">Edit</a>
              		 </td>
					 </tr>

              	@endforeach


              </tbody>
            </table>




  <hr>

  @include('meds.med_form')
 
@stop
