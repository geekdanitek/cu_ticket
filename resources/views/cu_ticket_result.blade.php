@extends('layouts.admin_master')
    @section('title', 'Ticket Page')
        @section('name', $name)
            @section('content')
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{route('admin_page')}}" class="btn btn-block btn-primary ticket-pag"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        </div>
                          <div class="col-md-7">
                              <h1 class="text-left ticket-name">{{$status_name}} Tickets ({{count($tickets)}})</h1>
                          </div>
                          <div class="col-md-4 text-right">
                             <div class="btn-group btn-head-action">
                                     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span id="queue-text">All Queues</span> <span class="caret"></span>
                                    </button>
                                    <!-- <button type="button" class="btn btn-primary"><span id="queue-text">All Queues</span></button> -->
                                   <!--  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button> -->
                                    <ul class="dropdown-menu">
                                        <li class="filter" data-link="All"><a>All</a></li>
                                        @foreach($queues as $queue)
                                          
                                        <li class="filter" data-link="{{$queue->name}}"><a>{{ $queue->name }}</a></li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                    </div>
                    <hr  style="border: solid 1px #6f3f6f;" />
                    <div class="table-responsive table-all" id="table_All">
                        <table class="table table-bordered table-hover myTable">
                            <thead>
                                <tr>
                                    <th class="col-md-2">
                                        Subject
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th class="col-md-2">
                                        Date Available
                                    </th>
                                    <th>
                                        Queue
                                    </th>
                                    <th class="col-md-2">
                                        Location
                                    </th>
                                   <!--  <th>
                                        Picture
                                    </th> -->
                                    <th>
                                        Status
                                    </th>
                                    <th class="col-md-2">
                                        Created
                                    </th>
                                    <th class="">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($tickets) < 1)
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-info text-center" role="alert">
                                                Table is empty
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @foreach($tickets as $ticket)
                                    <tr class="
                                        @if($ticket->status == 'rejected')
                                        danger
                                        @endif
                                        @if($ticket->status == 'inprogress')
                                        warning
                                        @endif
                                        @if($ticket->status == 'finished')
                                        success
                                        @endif
                                    ">
                                        <td>
                                            {{$ticket->subject}}
                                        </td>
                                        <td>
                                            <a tabindex='0' role='button' class='pop_this' data-trigger='focus' class='btn btn-link' 
                                                data-toggle='popover' title='Description' data-container='body' data-content='{{$ticket->description}}'>
                                                    {{ substr($ticket->description, 0, 30)."..." }}
                                            </a>
                                        </td>
                                        <td title="{{$ticket->date}}">
                                            {{$ticket->date->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$ticket->queue->name}}
                                        </td>
                                        <td>
                                            {{$ticket->location}}
                                        </td>
                                        <!-- <td>
                                            {{$ticket->picture}}
                                        </td> -->
                                       <td>
                                            {{$ticket->status}}
                                       </td>
                                       <td title="{{$ticket->created_at}}">
                                           {{$ticket->created_at->diffForHumans()}}
                                       </td>
                                       <td>
                                       <div class="btn-group">

                                         <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span>Change Status</span> <span class="caret"></span>
                                    </button>

                                            <!-- <button type="button" class="btn btn-danger">Change Status</button> -->
                                            <!-- <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button> -->
                                            <ul class="dropdown-menu dropdown-action-state">
                                                <li><a href="{{route('update_status', ['id' => $ticket->id])}}?status=finished">Accept</a></li>
                                                <li><a href="{{route('update_status', ['id' => $ticket->id])}}?status=inprogress">Inprogress</a></li>
                                                <li><a href="{{route('update_status', ['id' => $ticket->id])}}?status=rejected">Reject</a></li>
                                            </ul>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                                @foreach($queues as $queue)

                <div class="table-responsive queue_tables" id="table_{{$queue->name}}">
                    <table class="table table-hover table-bordered myTable">
                        <thead>
                            <tr>
                                    <th class="col-md-2">
                                        Subject
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th class="col-md-2">
                                        Date Available
                                    </th>
                                    <th>
                                        Queue
                                    </th>
                                    <th class="col-md-2">
                                        Location
                                    </th>
                                   <!--  <th>
                                        Picture
                                    </th> -->
                                    <th>
                                        Status
                                    </th>
                                    <th class="col-md-2">
                                        Created
                                    </th>
                                    <th class="">
                                        Action
                                    </th>
                                </tr>
                        </thead>
                        <tbody>

                            <?php
                                if($status_name == 'all'){
                                    $_tickets = $queue->tickets;
                                }else{
                                    $_tickets = $queue->tickets()->where('status', $status_name)->get();
                                }
                            ?>
                            @if(count($_tickets) < 1)
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-info text-center" role="alert">
                                                Table is empty
                                            </div>
                                        </td>
                                    </tr>
                            @endif
                            @foreach($_tickets as $tickets)
                            
                                <tr>
                                    <td>
                                        {{$tickets->subject}}
                                    </td>
                                    <td>
                                        <a tabindex='0' role='button' class='pop_this' data-trigger='focus' class='btn btn-link' 
                                                data-toggle='popover' title='Description' data-container='body' data-content='{{$tickets->description}}'>
                                                    {{ substr($tickets->description, 0, 30)."..." }}
                                        </a>
                                    </td>
                                    <td title="{{$tickets->date}}">
                                        {{$tickets->date->diffForHumans()}}
                                    </td>
                                    <td>
                                        {{$tickets->queue->name}}
                                    </td>
                                    <td>
                                        {{$tickets->location}}
                                    </td>
                                   <!--  <td>
                                        {{$tickets->picture}}
                                    </td> -->
                                    <td>
                                        {{$tickets->status}}
                                    </td>
                                    <td title="{{$tickets->created_at}}">
                                        {{$tickets->created_at->diffForHumans()}}
                                    </td>
                                    <td>
                                       <div class="btn-group">

                                         <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span>Change Status</span> <span class="caret"></span>
                                        </button>
                                            <!-- <button type="button" class="btn btn-danger">Change Status</button> -->
                                            <!-- <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button> -->
                                            <ul class="dropdown-menu dropdown-action-state">
                                                <li><a href="{{route('update_status', ['id' => $tickets->id])}}?status=finished">Accept</a></li>
                                                <li><a href="{{route('update_status', ['id' => $tickets->id])}}?status=inprogress">Inprogress</a></li>
                                                <li><a href="{{route('update_status', ['id' => $tickets->id])}}?status=rejected">Reject</a></li>
                                            </ul>
                                        </div>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                @endforeach
                </div>

            @endsection
            

            @section("js")
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('.pop_this').each(function(){
                            $(this).popover();
                        });
                    });

                    $(".queue_tables").hide();


                    

                    $(".filter").click(function(event) {
                        var name = $(this).attr("data-link");
                        $(".queue_tables").hide();
                        $(".table-all").hide();
                        $("#table_" + name).show();

                        $("#queue-text").text(name + " Queues");
                    });
                </script>
            @endsection