@extends('common.main')

@section('content')

<a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>

<h3>{{$med["name"] }}</h3>

<div class="row">

   <div class="col-md-4">
   
   <p>
  {{$med["dosage"]}}  |  <i>{{$med["ingredient"]}}</i>
   </p>
   <p>
    {{$med->type["type"]}}
  </p>
<br>

    @if ($med->users->find(Auth::user()))
      <h5>Inventory</h5>

    You currently have {{ $med->users->find(Auth::user())->pivot->qty}} in stock.
    @endif

<br>

    @if ($med->uses->count())
<br>
      <h5>Uses</h5>

  <p>
    This Med has been reported used for:
  </p>
    @endif
 
  <ul>
    @foreach ($med->uses as $use)
    <li>{{ $use->use }} <i>by user</i> {{ $use->user->name }}</li>

    @endforeach
  </ul>
</div>
</div>
<br>

@include('meds.use_form')

@stop
