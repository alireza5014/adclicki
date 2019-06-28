@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست نیکت ها </title>

@endsection
@section('content')

    <div id="delete_reserve" class="modal-demo" tabindex="-1" aria-labelledby="myModalLabel">
        <div class="modal-content">
            <form method="POST" action="{{ route('newTicket') }}" enctype="multipart/form-data">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ایجاد تیکت </h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject"
                                       placeholder="موضوع  تیکت" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <textarea class="form-control autogrow" name="message" required id="description"
                                          placeholder="توضیحاتی مختصر در این قسمت بنویسید"
                                          style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="form-group">
                            <div class="col-md-6">

                                <input type="file" name="image" id="image" class="form-control">
                                <div id="fileUploadsContainer"></div>
                            </div>

                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light">ذخیره تغییرات</button>
                </div>
            </form>
        </div>

    </div><!-- /.modal -->

    <div class="row">

        <div class="col-md-12 col-sm-12">


            <div class="card-box">
                <div class="m-b-30">

                    <a href="#delete_reserve"


                       class="btn btn-success    btn-sm waves-effect waves-light"
                       data-animation="fall" data-plugin="custommodal"
                       data-overlaySpeed="100"
                       data-overlayColor="#36404a">
                        ثبت تیکت جدید
                        <i class="fa fa-plus "></i>
                    </a>
                </div>

                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="btn-toolbar">
                            <div class="btn-group focus-btn-group">

                            </div>
                            <div class="btn-group dropdown-btn-group pull-right">
                                <form method="get" action="" class="input-group" style="width: 250px;">

                                    <input value="<?php if (isset($_GET['keyword'])) echo $_GET['keyword'];?>"
                                           type="text" name="keyword" class="form-control input-sm pull-right"
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

                                    <th>#</th>

                                    <th>موضوع</th>


                                    <th> زمان ایجاد</th>

                                    <th>وضعیت</th>
                                    <th>اقدامات</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    @if($ticket->user!=null)
                                        <tr>
                                            <td>{{$ticket->id}}</td>

                                            <td>{{$ticket->subject}}<br/>
                                            <td>{{$ticket->message}}<br/>


                                            <td>{{$ticket->created_at}}</td>

                                            <td>
                                                {{getTicketType($ticket->status)}}


                                                {{getTicketSeen($ticket->seen)}}


                                                <a class="btn-info btn btn-sm "
                                                   href="{{route('user_show_ticket',['id'=>$ticket->id])}}"><i
                                                            class="fa fa-edit   "></i>مشاهده</a>

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