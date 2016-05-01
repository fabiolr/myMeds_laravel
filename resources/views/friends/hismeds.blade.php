@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif


@if (count($hismeds) > 0)

  <h5>{{$friend->name}}'<s></s> Meds</h5>

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
              
              	@foreach ($hismeds as $hismed)


              		<tr>
                   <td><a href="/minus/{{ $hismed->pivot->id }}"> <strong> - </strong></a> | {{ $hismed->pivot->qty }} | <a href="/plus/{{ $hismed->pivot->id }}"><strong>+ </strong></a></td>
                   <td> <a href="/meds/{{ $hismed->pivot->med_id }}">{{$hismed["name"] }} </a></td>
					 <td> {{$hismed->type["type"]}} </td>
              		 <td> {{$hismed["ingredient"]}} </td>
                   <td> {{$hismed["dosage"]}} </td>
                   <td> {{$hismed->pivot->expiration}} </td>
                   <td> {{$hismed->interval}} </td>
              		 <td>
              		 
              		 </td>
					 </tr>

              	@endforeach


              </tbody>
            </table>


@else

  <hr>

  <h7>{{$friend->name}} does not have any meds</h7>

@endif

  <hr>

 
@stop
