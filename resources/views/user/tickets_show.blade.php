@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست نیکت ها </title>

@endsection
@section('content')


    <br><br>

    <div class="row">
        <div class="col-md-3 pull-md-right whmcs-sidebar sidebar-primary">
            <div menuitemname="Ticket Information" class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-ticket"></i> اطلاعات تیکت
                    </h3>
                </div>
                <div class="list-group">
                    <div menuitemname="Subject" class="list-group-item ticket-details-children"
                         id="Primary_Sidebar-Ticket_Information-Subject">
                        <div class="truncate">{{$tickets->ticket_id}}
                            - {{$tickets->user->fname." ".$tickets->user->lname}} </div>
                        <span class="label label-success">   پاسخ ادمین </span>
                    </div>
                    <div menuitemname="Department" class="list-group-item ticket-details-children"
                         id="Primary_Sidebar-Ticket_Information-Department">
                        <span class="title">دپارتمان</span><br> پشتیبانی فنی
                    </div>
                    <div menuitemname="Date Opened" class="list-group-item ticket-details-children"
                         id="Primary_Sidebar-Ticket_Information-Date_Opened">
                        <span class="title">ارسال شده</span><br> {{$tickets->created_at}}
                    </div>
                    <div menuitemname="Last Updated" class="list-group-item ticket-details-children"
                         id="Primary_Sidebar-Ticket_Information-Last_Updated">
                        <span class="title">آخرین به روز رسانی</span><br>{{$tickets->updated_at}}
                    </div>
                    <div menuitemname="Priority" class="list-group-item ticket-details-children"
                         id="Primary_Sidebar-Ticket_Information-Priority">
                        <span class="title">اهمیت</span><br>کم
                    </div>
                </div>

                <div class="panel-footer clearfix">
                    <div class="col-xs-6 col-button-left">
                        <button class="btn btn-success btn-sm btn-block" id="answer_ticket_btn"
                                onclick="jQuery('#ticketReply').click()">
                            <i class="fa fa-pencil"></i> پاسخ
                        </button>
                    </div>
                    <div class="col-xs-6 col-button-right">
                        <button class="btn btn-danger btn-sm btn-block" disabled="disabled"
                                onclick="window.location='?tid=742135&amp;c=QXIXdPmY&amp;closeticket=true'"><i
                                    class="fa fa-times"></i> بسته شده
                        </button>
                    </div>
                </div>
            </div>


        </div>

        <div id="internal-content" class="col-md-9 pull-md-left">
            <!-- Display custom module wrapper if applicable -->



            @if($tickets->status==3)
                <div class="alert alert-info text-center">
                    این تیکت بسته شده است. در صورت تمایل با پاسخ دادن می توانید مجددا آن را باز نمایید.
                </div>
            @endif
            <div id="replyform" class="panel panel-pink panel-collapsable hidden-print panel-collapsed">
                <div class="panel-heading" id="ticketReply">
                    <div class="collapse-icon pull-right">
                        <i class="fa fa-plus"></i>
                    </div>
                    <h3 class="panel-title">
                        <i class="fa fa-pencil"></i> پاسخ
                    </h3>
                </div>


                <div id="replybody" class="panel-body panel-body-collapsed" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('user_save_ticket',['id'=>$tickets->id])}}" enctype="multipart/form-data" id="insert_ticket_answer"
                                  class="form-horizontal">

                                {{csrf_field()}}
                                <input class="form-control disabled" type="hidden" id="ticket_id" name="ticket_id"
                                       value="TK-574768083">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-3 control-label">نام</label>
                                    <div class="col-sm-6">
                                        <input class="form-control disabled" type="text" id="inputName" value="{{auth()->user('user')->fname." ".auth('user')->user()->lname}}"
                                               disabled="disabled"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">آدرس ایمیل</label>
                                    <div class="col-sm-6">
                                        <input class="form-control disabled" type="text" id="inputEmail"
                                               value="{{auth()->user()->email}}" disabled="disabled"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage" class="col-sm-3 control-label">پیام</label>
                                    <div class="col-sm-7">

                                        <textarea name="message" class="form-control" rows="12"></textarea>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputAttachments" class="col-sm-3 control-label">پیوست ها</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="image" id="image" class="form-control">
                                        <div id="fileUploadsContainer"></div>
                                        <p class="help-block">فرمت فایل های مجاز: .jpg, .gif, .jpeg, .png
                                        </p></div>

                                </div>


                                <button id="submit2" type="submit" class="btn btn-primary"><i
                                            class="fa fa-envelope-o"></i>
                                    ارسال پاسخ
                                </button>


                                <input class="btn btn-default  " type="reset" value="لغو"
                                       onclick="jQuery('#ticketReply').click()">


                            </form>
                        </div>





                    </div>
                </div>


            </div>


            <div class="panel panel-info visible-print-block">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        اطلاعات تیکت
                    </h3>
                </div>
                <div class="panel-body container-fluid">
                    <div class="row">
                        <div class="col-md-2 col-xs-6">
                            <b>کد تیکت</b><br>742135
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <b>موضوع</b><br>آدرس سرور smtp
                        </div>
                        <div class="col-md-2 col-xs-6">
                            <b>اهمیت</b><br>زیاد
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <b>دپارتمان</b><br>پشتيبان فنی
                        </div>
                    </div>
                </div>
            </div>

            @foreach($tickets->tickets_answers as $ticket)


                @if($ticket->sender_type==1)
                    <div class="panel panel-primary ticket-reply markdown-content">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-user"></i> &nbsp; admin (کارشناس)
                                <div class="date pull-right">
                                    {{$ticket->created_at}}
                                </div>
                            </h3>
                        </div>
                        <div class="panel-body message">
                            {!!  nl2br($ticket->message)!!}

                            <hr>
                            <div class="pull-left">

{{--                                <p>{{$ticket->ip}}</p>--}}
                            </div>

                            <div class="pull-right">
                                @if($ticket->image_path!=='dd')
                                    <a href=" {{url($ticket->image_path)}} " target="_blank">    <i class="fa fa-download "> Attached </i>
                                        @endif
                                    </a>
                            </div>


                        </div>

                    </div>
                @elseif($ticket->sender_type==0)

                    <div class="panel panel-info ticket-reply markdown-content">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-user"></i>  {{$tickets->user->fname." ".$tickets->user->lanme}} (مشتری)
                                <div class="date pull-right">
                                    {{$ticket->created_at}}

                                </div>
                            </h3>
                        </div>
                        <div class="panel-body message">
                            {!!  nl2br($ticket->message)!!}

                            <hr>
                            <div class="pull-left">
                                <p>{{$ticket->ip}}</p>
                            </div>

                            <div class="pull-right">
                                @if($ticket->image_path!=='dd')
                                    <a href=" {{url($ticket->image_path)}} " target="_blank">    <i class="fa fa-download "> Attached </i>
                                        @endif
                                    </a>
                            </div>

                        </div>
                    </div>


                @endif

            @endforeach

            <div class="panel   ticket-reply markdown-content">
                <div class="panel-heading">

                    <div class="pull-right">
                        موضوع‌:  {{$tickets->subject}}
                    </div>
                    <div class="pull-left">
                        <i class="fa fa-user"></i>  {{$tickets->user->fname." ".$tickets->user->lname}} (مشتری)
                    </div>

                    <hr>
                    <div class="panel-body message">
                        {{$tickets->message}}
                        <hr>
                        <div class="date pull-right">
                            {{$tickets->created_at}}

                        </div>
                    </div>

                </div>
            </div>

            <!-- If page isn't shopping cart, close main content layout and display secondary sidebar (if enabled and applicable) -->
            <!-- Display custom module wrapper if applicable -->
            <!-- Close main content layout and display secondary sidebar (if enabled and applicable) -->
        </div>


        <script>
            $(document).ready(function () {
                $("#ticketReply").click(function () {
                    $("#replybody").toggle();
                });
            });
            $(document).ready(function () {
                $("#answer_ticket_btn").click(function () {
                    $("#replybody").css('display:block');
                });
            });
        </script>

@stop