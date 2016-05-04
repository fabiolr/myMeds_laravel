@extends('common.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">{{ $dash->medc }}</span>
                           <a href="/meds">System Meds</a> 
                        </li>
                        <li class="list-group-item">
                            <span class="badge">{{ $dash->mymedc }}</span>
                            <a href="/mymeds">My Meds</a>
                        </li>
                        
                        <li class="list-group-item">
                            <span class="badge">{{ count($dash->friends) }}</span>
                            <a href="/friends">Friends</a> 
                        </li>
                        
                
                       
                    </ul>

                   <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading1"> 
                        <h6 class="panel-title"> <a class="" role="button" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="true" aria-controls="collapseListGroup1"> Pending Friend Requests </a><span style="float:right" class="badge">{{ count($dash->unsansweredRequests) }}</span> </h6> 
                    </div> 
                    <div id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true"> 
                        <ul class="list-group"> 
                            
                        @foreach ($dash->unsansweredRequests as $uar)
                        
                            <a class="list-group-item" href="/friend/{{ $uar->user->id }}">{{ $uar->user->name }}</a>

                        @endforeach

                        </ul> 
                
                    </div>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
