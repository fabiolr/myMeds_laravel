@extends('common.main')

@section('content')

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
              		<tr>
              		 <td> {{$med["name"] }} </td>
					         <td> {{$med->type["type"]}} </td>
              		 <td> {{$med["ingredient"]}} </td>
              		 <td> {{$med["dosage"]}} </td>
              		 <td>
              		 <a href="med/{{$med['id']}}">Edit</a>
              		 </td>
					 </tr>
              </tbody>
            </table>


@stop
