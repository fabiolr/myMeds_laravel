        <form action="/meds/newuse" method="POST">
			        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	      <div class="row">
			  <div class="col-lg-4">
			    <div class="input-group">
			            <input type="text" name="use" class="form-control" placeholder="New Med Use" aria-describedby="basic-addon1">
			            <input type="hidden" name="med_id" class="form-control" value="{{ $med->id }}" aria-describedby="basic-addon1">
			      <span class="input-group-btn">
			        <button type="submit" class="btn btn-default" type="button">Add</button>
			      </span>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div><!-- /.row -->
        </form>
