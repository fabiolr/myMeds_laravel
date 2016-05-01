@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif


<div class="row">

@if (count($meds))
<div class="col-sm-4">

  <h6>Meds</h6>

<ul class="list-group">
    @foreach ($meds as $med)
  <li class="list-group-item"><a href="/meds/{{ $med->id }}">{{ $med->name }}</a></li>
      @endforeach
</ul>


</div>
@endif
@if (count($users))

<div class="col-sm-4">
  <h6>People</h6>

<ul class="list-group">
    @foreach ($users as $user)
  <li class="list-group-item"><a href="/friend/{{ $user->id }}">{{ $user->name }}</a></li>
      @endforeach
</ul>
</div>
@endif

  

 
@stop
