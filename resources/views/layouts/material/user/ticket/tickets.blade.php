@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست نیکت ها </title>

@endsection
@section('content')

    <div class="modal fade" id="modal-default" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-right"> ایجاد تیکت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>


                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12">


                    <form method="POST" action="{{ route('newTicket') }}" enctype="multipart/form-data">


                        @csrf
                             <div class="col-md-12">

                                <div class="form-group form-group--float">
                                    <input id="subject" type="text" class="form-control" name="subject"
                                           value="{{old('price')}}">
                                    <label> موضوع تیکت</label>
                                    <i class="form-group__bar"></i>

                                </div>


                            </div>

                            <div class="col-md-12">

                                <div class="form-group form-group--float">
                                        <textarea id="message" type="text" class="form-control" name="message"
                                        >{{old('message')}}</textarea>
                                    <label> توضیحاتی مختصر در این قسمت بنویسید</label>
                                    <i class="form-group__bar"></i>

                                </div>


                            </div>


                            <div class="form-group">
                                <div class="col-md-12">

                                    <input type="file" name="image" id="image" class="form-control">
                                    <div id="fileUploadsContainer"></div>
                                </div>

                            </div>



                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            <button type="button" class="btn btn-link" data-dismiss="modal">بستن</button>
                        </div>


                    </form>
                </div>

                </div>

            </div>
        </div>
    </div>



        <div class="col-md-12 col-sm-12">


            <div class="card">
                <div class="m-b-30">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"> ثبت تیکت جدید
                    </button>


                </div>

                <div class="table-rep-plugin">
                    <div class="table-wrapper">

                        <div class="table-responsive" data-pattern="priority-columns">
                            <table class="table table-hover mb-0">

                                <thead>
                                <tr>

                                    <th>#</th>

                                    <th>موضوع</th>
                                    <th>توضیحات</th>


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

                                            </td>
                                            <td>
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