<!-- Modal -->
<div class="modal fade" id="type_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Med Type</h4>
      </div>
      <div class="modal-body">


        <form action="/meds/newtype" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
          <div class="row">
            <div class="col-md-6">
            <br>
            <input type="text" name="type" class="form-control" placeholder="Med Type" aria-describedby="basic-addon1">
            <br>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Med Type</button>
          </div>
        </form>
    </div>
  </div>
</div>

  <script>

// monitor selected med type, and launch modal to create new if necessary.

$("#sel1").change( function() {
  var selectedOption = $("#sel1 option:selected");
  var selectedText = selectedOption.text();
  if (selectedText == "New Type") {
  $("#type_modal").modal('show');
  }

});

</script>