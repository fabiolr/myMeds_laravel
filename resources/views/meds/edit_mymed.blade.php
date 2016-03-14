@extends('common.main')

@section('content')

    <script  src="/js/jquery.mask.js"></script>

<script type="text/javascript">
  
   $("#date").mask("9999-99-99",{placeholder:"YYYY-MM-DD"});

   </script>

<a href="/meds"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>

 <h5>Update your Inventory for:</h5>

<div class="row">

   <div class="col-md-4">
          <ul class="list-group">
  <li class="list-group-item"><b>{{ $med->name }}</b> | {{ $med->dosage }}</li>
  <li class="list-group-item"><i>{{ $med->ingredient }}</i></li>
  <li class="list-group-item">{{ $med->type->type }}</li>
</ul>

   
      <form action="/meds/{{ $med->id }}" method="POST">
         <div class="form-group form-group-sm">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="input-group">


            <span class="input-group-addon" id="basic-addon1">Expiration</span>

            <input id="date" type="text" name="expiration"  class="form-control" aria-describedby="basic-addon1">
          </div>
          <br>
          <div class="input-group">
              
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Quantity</span>
              <input type="text" name="qty" class="form-control"  aria-describedby="basic-addon1">         
            </div>
          
            <br>


             <button class="btn btn-primary" type="submit">Add to My Meds</button>
          </div>
        </form>

     


       </div>

</div>


@stop
