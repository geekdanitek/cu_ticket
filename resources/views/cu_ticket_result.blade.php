@extends('layouts.admin_master')
    @section('title', 'Result')
        @section('name', $name)
            @section('content')
                <div class="container">
                    <div class="row">
                          <div class="col-md-4">
                              <h1 class="text-left">Hello</h1>
                          </div>
                          <div class="col-md-8 text-right">
                             <div class="btn-group btn-head-action">
                                    <button type="button" class="btn btn-primary">Queue</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Electricity</a></li>
                                        <li><a href="#">Plumbing</a></li>
                                        <li><a href="#">Carpentary</a></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                    <hr  style="border: solid 1px #6f3f6f;" />
                    <div class="table-responsive"> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Subject
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Time
                                    </th>
                                    <th>
                                        Queue
                                    </th>
                                    <th>
                                        Location
                                    </th>
                                    <th>
                                        Picture
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0;$i<4;$i++)
                                    <tr>
                                        <td>
                                        Broken Socket
                                        </td>
                                        <td>
                                            bla bla bla bla gijn........
                                        </td>
                                        <td>
                                            12/07/18
                                        </td>
                                        <td>
                                            Plumbing
                                        </td>
                                        <td>
                                            Daniel - Hall (Room : 321)
                                        </td>
                                        <td>
                                            img/queuepics.jpg
                                        </td>
                                       <td>
                                            Pending
                                       </td>
                                       <td>
                                       <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-action-state">
                                                <li><a href="#">Accept</a></li>
                                                <li><a href="#">Reject</a></li>
                                                <li><a href="#">Pending</a></li>
                                            </ul>
                                        </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            @endsection
        