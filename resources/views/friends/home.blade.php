@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif




<div class="table-responsive">

            <table class="table table-striped">
              <thead>
                <tr>
                </tr>
                <tr>
                  <th>Friend</th>
                  <th>e-mail</th>
                  <th>Meds</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              
              	@foreach ($friends as $friend)

              	<tr> 
                  <td><a href="/friend/{{ $friend->friend_id }}">{{ $friend->who["name"] }}</a></td>
                  <td>{{ $friend->who["email"] }}</td>
					       <td> {{ $friend["medcount"] }} </td>
              		
					 </tr>

              	@endforeach


              </tbody>
            </table>




  <hr>

 
@stop
