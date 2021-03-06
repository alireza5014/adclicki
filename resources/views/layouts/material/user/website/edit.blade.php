@extends('layouts.material.layout')



@section('content')


    <div class="card">


        <a href="{{route('user.website.list')}}" class="btn btn-success btn-xs">
            لیست سایت های من </a>
    </div>
    <div class="card">


        <div class="container">

            <div class="row group">

                <div class="col-sm-6">


                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.website.modify',['id'=>$website->id]) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="col-sm-12">
                            <div class="form-group form-group--float">
                                <select id="type" type="text"
                                        class="form-control" name="type">

                                    <option @if($website->type=='banner') selected @endif value="banner"> بنری</option>
                                    {{--<option @if($website->type=='popup') selected @endif value="popup"> پاپ آپ</option>--}}
                                    {{--<option @if($website->type=='pop_box') selected @endif value="pop_box"> پاپ باکس</option>--}}


                                </select>
                                <label>نوع </label>
                                <i class="form-group__bar"></i>

                            </div>


                        </div>


                        <div class="form-group form-group--float">
                            <input dir="ltr" placeholder="http://www.example.com" id="url" type="text"
                                   class="form-control" name="url"
                                   value="{{$website->url}}">
                            <label> آدرس سایت </label>
                            <i class="form-group__bar"></i>

                        </div>


                        <div class="col-sm-12">
                            <div class="form-group form-group--float">
                                <select class="select2 orm-control" dir="rtl" id="subject" type="text"
                                        name="subject[]" multiple data-placeholder="یک یا چند موضوع را انتخاب کنید">
                                    @foreach(\App\Model\Subject::all() as $subject)
                                        @if(in_array($subject->id,$subjects))
                                            <option selected value="{{$subject->id}}"> {{$subject->title}}</option>
                                        @else
                                            <option value="{{$subject->id}}"> {{$subject->title}}</option>
                                        @endif
                                    @endforeach


                                </select>

                                <i class="form-group__bar"></i>

                            </div>


                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary  btn-block">
                                    <i class="fa fa-btn  "></i> ویرایش اطلاعات
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="col-sm-6">


                    {{--<ul class="list-group">--}}

                        {{--<p class="alert alert-info m-b-5">--}}
                            {{--حداقل مبلغ درخواست برداشت برای بار اول ۲,۰۰۰ تومان می باشد.--}}
                            {{--<br/>--}}
                            {{--حداقل مبلغ درخواست برداشت برای بار دوم ۵,۰۰۰ تومان می باشد.--}}
                            {{--<br/>--}}
                            {{--حداقل مبلغ درخواست برداشت برای بار سوم و به بعد ۱۰,۰۰۰ تومان می باشد.--}}

                        {{--</p>--}}
                        {{--<p class="alert alert-danger m-b-20">--}}
                            {{--شما در هر ۲۴ ساعت یکبار می توانید درخواست واریز وجه کنید.--}}
                        {{--</p>--}}

                        {{--<p class="alert alert-success m-b-20">--}}
                            {{--مبلغ درخواست شده کمتر از ۲۴ ساعت به حساب شما واریز خواهد شد.--}}
                        {{--</p>--}}
                    {{--</ul>--}}

                </div>


            </div>
        </div>
    </div>
@stop
