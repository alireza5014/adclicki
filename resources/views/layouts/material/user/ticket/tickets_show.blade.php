@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست تیکت ها </title>

@endsection
@section('content')


    <div class="content__inner">
        <header class="content__title">
            <h1> پیام ها</h1>


        </header>

        <div class="messages">
            <div class="messages__sidebar">


                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">  {{$tickets->subject}}</h2>
                    </div>

                    <div class="card-block">
                        <p>
                            {{$tickets->message}}
                        </p>

                    </div>
                </div>


            </div>

            <div class="messages__body">
                <div class="messages__header">
                    <div class="toolbar toolbar--inner mb-0">
                        <div class="toolbar__label">لیست گفت و گو</div>


                    </div>
                </div>

                <div class="messages__content">


                    <div class="messages__item  messages__item--right">
                        <img src="{{url(auth('user')->user()->image_path)}}"
                             class="messages__avatar" alt="">

                        <div class="messages__details">
                            <p>
                                {!!  nl2br($tickets->message)!!}
                            </p>
                            <small><i class="zmdi zmdi-time"></i> {{$tickets->created_at}}</small>
                        </div>
                    </div>

                    @foreach($tickets->tickets_answers as $ticket)






                        <div class="messages__item @if($ticket->sender_type==0)messages__item--right @else messages__item--left @endif ">
                            <img src="@if($ticket->sender_type==0) {{url(auth('user')->user()->image_path)}}@else {{url('admin.png')}} @endif "
                                 class="messages__avatar" alt="">

                            <div class="messages__details">
                                <p>
                                    {!!  nl2br($ticket->message)!!}
                                </p>
                                <small><i class="zmdi zmdi-time"></i> {{$ticket->created_at}}</small>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="messages__reply">
                    <form method="POST" action="{{route('user_save_ticket',['id'=>$tickets->id])}}">
                        @csrf


                        <div class="btn-group" style="width: 100%" role="group" aria-label="Basic example">
      <textarea name="message" id="message" class="messages__reply__text"
                placeholder="Type a message..."></textarea>

                            <button class="btn btn-success btn--icon  waves-effect mr-2"><i
                                        class="zmdi zmdi-mail-send"></i></button>

                            <a class="btn btn-primary btn--icon  waves-effect text-white mr-2"><i
                                        class="zmdi zmdi-mic"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop