@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif

  <h5>My Meds</h5>




<div class="table-responsive">

            <table class="table table-striped">
              <thead>
                <tr>
					
                </tr>
                <tr>
                  <th>Qty</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Active Ingredient</th>
                  <th>Dosage</th>
                  <th>Expiration</th>
                  <th>Expires in</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              
              	@foreach ($mymeds as $mymed)


              		<tr>
                   <td><a href="/minus/{{ $mymed->pivot->id }}"> <strong> - </strong></a> | {{ $mymed->pivot->qty }} | <a href="/plus/{{ $mymed->pivot->id }}"><strong>+ </strong></a></td>
                   <td> <a href="/meds/{{ $mymed->pivot->med_id }}">{{$mymed["name"] }} </a></td>
					 <td> {{$mymed->type["type"]}} </td>
              		 <td> {{$mymed["ingredient"]}} </td>
                   <td> {{$mymed["dosage"]}} </td>
                   <td> {{$mymed->pivot->expiration}} </td>
                   <td> {{$mymed->interval}} </td>
              		 <td>
              		 
              		 </td>
					 </tr>

              	@endforeach


              </tbody>
            </table>




  <hr>

 
@stop
