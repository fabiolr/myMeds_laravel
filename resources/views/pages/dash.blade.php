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
                            <span class="badge">14</span>
                            Total Meds
                        </li>
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            My Meds
                        </li>
                        
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Friends
                        </li>
                        
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Friend Requests Pending
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
