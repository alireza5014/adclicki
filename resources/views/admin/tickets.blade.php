@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست نیکت ها </title>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 ">
          <div class="card-box">

                <div class="box-body no-padding">
                    <ul class="list-inline">
                        <li  class="active"><a href="all"><i class="fa fa-inbox"></i> همه تیکت ها <span class="label label-primary pull-right">{{$data[4]}}</span></a></li>
                        <li class="list-group-item"><a href="0"><i class="fa fa-filter"></i> پاسخ مشتری <span class="label label-danger pull-right">{{$data[0]}}</span> </a></li>
                        <li class="list-group-item"><a href="1"><i class="fa fa-file-text-o"></i> پاسخ داده شده<span class="label label-success pull-right">{{$data[1]}}</span></a></li>
                        <li class="list-group-item"><a href="2"><i class="fa fa-envelope-o"></i> باز<span class="label label-primary pull-right">{{$data[2]}}</span></a></li>
                        <li class="list-group-item"><a href="3"><i class="fa fa-trash-o"></i> بسته شده<span class="label label-info pull-right">{{$data[3]}}</span></a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->




        </div>

        <div class="col-sm-12">


            <div class="card-box">


                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="btn-toolbar">
                            <div class="btn-group focus-btn-group">

                            </div>
                            <div class="btn-group dropdown-btn-group pull-right">
                                <form method="get" action="" class="input-group" style="width: 250px;">

                                    <input value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>" type="text" name="keyword" class="form-control input-sm pull-right"
                                           placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-default"><i
                                                    class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table  table-striped">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>subject</th>
                                    <th>gamenet</th>

                                    <th>کد ملی</th>


                                    <th> زمان ایجاد</th>

                                    <th>وضعیت</th>
                                    <th>مدیریت</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    @if($ticket->user!=null)
                                        <tr>
                                            <td>{{$ticket->ticket_id}}</td>
                                            <td>{{$ticket->subject}}</td>
                                            <td> {{$ticket->user->gamenet}}</td>

                                            <td>{{$ticket->user->code_melli}}<br/>
                                                {{$ticket->user->fname}} {{$ticket->user->lname}}<br/>
                                                {{$ticket->user->email}}</td>


                                            <td>{{$ticket->created_at}}</td>

                                            <td>{{getTicketType($ticket->status)}}</td>
                                            <td>
                                                {{getTicketSeen($ticket->seen)}}
                                            </td>

                                            <td>

                                                <a class="btn-info btn btn-sm " href="{{route('show_ticket',['id'=>$ticket->id])}}"><i class="fa fa-edit "></i></a>

                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="5">
                                                No resulte Found
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                {{$tickets->appends($_GET)->links()}}
            </div>
        </div>
@stop