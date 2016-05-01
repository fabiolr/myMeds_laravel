@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif

@if ($friend->message)
<div class="alert alert-{{ $friend->level }}" role="alert">{{ $friend->message }}</div>
@endif

  <p>
  <form action="/friend/{{ $friend->id }}/add" method="GET">
  <button type="submit" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span> Add {{$friend->name}} as Friend
</button>
  </form>
 
@stop
