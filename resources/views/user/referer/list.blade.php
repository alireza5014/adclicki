@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست تبلیغات </title>

@endsection
@section('content')

    <div class="row">


        <div class="card  ">
            <div class="btn btn-info btn-block" href="#id_general_setting" data-toggle="collapse"><i
                        class="fa fa-plus"></i>
                لینک جذب زیر
            </div>

            <div id="id_general_setting" class="panel-collapse collapse">

                <div class="box-body table-responsive no-padding">
                    <div class="col-md-12 col-md-offset-0">


                        <div class="panel-body">

                            <div class="p-5">

                                {!! nl2br("<div class='m-r-15 m-l-15 alert alert-info'><p> نحوه جذب زیر مجموعه:<p> <p> لینک زیر را به دوستانتان ارسال کنید. بعد از ثبت نام از طریق این لینک زیر مجموعه شما خواهند شد  و ".$referer_percent." در صد از درآمد آنها به شما تعلق خواهد گرفت. </p>
                                    <textarea  dir='ltr'  class='form-control' style='min-width: 100%'> ".url('user/register').'?referer_id='.auth('user')->user()->id."</textarea>


<p>کد لینک زیر را کپی و در سایت و یا وبلاگ خود قرار دهید </p>
                     <textarea dir='ltr' class='form-control' style='min-width: 100%'> <a href='".url('user/register').'?referer_id='.auth('user')->user()->id."'><img src='".url('450.gif')."' width='450px' height='70px' /></a></textarea>

<p>پیش نمایش لینک تصویری</p>
<img src='".url('450.gif')."' width='450px' height='70px' />
                                </div>

      <textarea dir='ltr' class='form-control' style='min-width: 100%'> <a href='".url('user/register').'?referer_id='.auth('user')->user()->id."'><img src='".url('120.gif')."' width='120px' height='240px' /></a></textarea>

<p>پیش نمایش لینک تصویری</p>
<img src='".url('120.gif')."' width='120px' height='240px' />
                                </div> ")!!}


                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">


            <div class="card-box">

                <div class="btn-toolbar">

                    <div class="btn-group dropdown-btn-group pull-right">
                        <form method="get" action="" class="input-group" style="width: 250px;">

                            <input type="text" name="keyword" class="form-control input-sm pull-right"
                                   placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i
                                            class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    {{--                    <a href="{{route('user.ads.new')}}" class="btn btn-success btn-xs">ثبت تبلیغ جدبد</a>--}}
                </div>
                <p class="error text-center">زیر مجموعه هایی که با آی پی کشوری به جزء ایران ثبت نام کرده باشند حذف
                    خواهند شد</p>
                <hr/>

                @include('user.referer.table')

            </div>


        </div>
@stop