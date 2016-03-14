



	<h5>Add New Med</h5>
	<form action="meds" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
		        <div class="col-md-3">

		        	<input type="text" name="name" class="form-control" placeholder="Commercial Name" aria-describedby="basic-addon1">
		        </div>

		        <div class="col-md-2">


					<div class="form-group form-group-sm">

					  	<select  name="type_id" class="form-control" id="sel1">
					    <option class="form-control">Type</option>
					    <option class="form-control">--------</option>
					  
					    @foreach ($types as $type) 
						<option class="form-control" value="{{$type->id}}">{{$type->type}}</option>
					    @endforeach
						<option class="form-control">--------</option>
						<option class="form-control">New Type</option>

						</select>
				    </div>
				</div>

		        <div class="col-md-3">
						<input type="text" name="ingredient" class="form-control" placeholder="Active Ingredient" aria-describedby="basic-addon1">
				</div>

		        <div class="col-md-2">

						<input type="text" name="dosage" class="form-control" placeholder="Dosage" aria-describedby="basic-addon1">
				</div>

		      	<div class="col-md-2">

						<button class="btn btn-default" type="submit">Add Medication</button>
				</div>

		</div>

	</form>








