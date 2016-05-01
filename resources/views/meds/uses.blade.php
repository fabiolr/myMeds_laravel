@extends('common.main')



@section('content')

@if(session('data')[0])
<div class="alert alert-{{session('data')[0]}}" role="alert">{{ session('data')[1] }}</div>
@endif

  <h5>System Wide Uses</h5>

<div class="table-responsive">

            <table class="table table-striped">
              <thead>
                <tr>
					
                </tr>
                <tr>
                  <th>Name</th>
                  <th>Active Ingredient</th>
                  <th>Type</th>
                  <th>Suggested Uses</th>
                </tr>
              </thead>
              <tbody>
              
              	@foreach ($meds as $med)

              		<tr>
              		 <td> <a href="/meds/{{ $med->id }}">{{ $med->name }}</a> </td>
                   <td> {{ $med->ingredient }} </td>
                   <td> {{ $med->type->type }} </td>
              		 <td> @foreach ($med->uses as $use)
                        {{ $use->use }} (<i>{{ $use->user->name }}</i>),
                        @endforeach
                  </td>

					 </tr>

              	@endforeach


              </tbody>
            </table>

 
@stop
