@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست نیکت ها </title>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 ">




            <div  class="row quick-stats">
                <a href="all" class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-light-green">
                        <div class="quick-stats__info">
                            <h2>{{$data[4]}}</h2>
                            <small> همه تیکت ها</small>
                        </div>

                        <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                    </div>
                </a>

                <a href="0" class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-red">
                        <div class="quick-stats__info">
                            <h2>{{$data[0]}}</h2>
                            <small>پاسخ مشتری</small>
                        </div>

                        <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                    </div>
                </a>

                <a href="1" class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-purple">
                        <div class="quick-stats__info">
                            <h2>{{$data[1]}}</h2>
                            <small> پاسخ داده شده</small>
                        </div>

                        <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                    </div>
                </a>

                <a href="2" class="col-sm-6 col-md-3">
                    <div class="quick-stats__item bg-amber">
                        <div class="quick-stats__info">
                            <h2>{{$data[2]}}</h2>
                            <small>      باز</small>
                        </div>

                        <div class="quick-stats__chart sparkline-bar-stats"><canvas width="58" height="36" style="display: inline-block; width: 58px; height: 36px; vertical-align: top;"></canvas></div>
                    </div>
                </a>


            </div>



            <div class="card">
                <div class="card-block">




                    <div class="table-wrapper">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table  table-hover">
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

                                                <a class="btn-info btn btn-sm " href="{{route('show_ticket',['id'=>$ticket->id])}}"><i class="zmdi zmdi-edit"></i></a>

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