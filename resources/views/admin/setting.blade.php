@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> setting </title>

@endsection
@section('content')
    <div class="row">

        <div class=" col-xs-12  col-sm-12  col-md-12 ">

            <br/><br/> <br/><br/>

            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="panel-title">تنظیمات</div>
                </div>
                <form class="form-horizontal" role="form" method="POST"
                      action="{{route('modify_setting') }}">
                    {{ csrf_field() }}

                    <div class="panel-body">


                        <div class="btn btn-success btn-block" href="#id_general_setting" data-toggle="collapse"><i
                                    class="fa fa-plus"></i>
                            تنظیمات کلی


                        </div>

                        <div id="id_general_setting" class="panel-collapse collapse in">

                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-8 col-md-offset-2">


                                    <div class="panel-body">

                                        <div class="p-20">


                                            <div class="form-group{{ $errors->has('referer_percent') ? ' has-error' : '' }}">


                                                <label for="referer_percent" class="control-label">  درصد سود زیر مجموعه :</label>


                                                <input id="referer_percent" type="text" class="form-control"
                                                       name="referer_percent" value="{{ $setting->referer_percent }}"
                                                       placeholder=" ">

                                                @if ($errors->has('referer_percent'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('referer_percent') }}</strong>
                                    </span>
                                                @endif


                                            </div>


                                            <div class="form-group{{ $errors->has('ppc') ? ' has-error' : '' }}">


                                                <label for="ppc" class="control-label"> درآمد به  هر ازای کلیک :</label>
                                                <input id="ppc" type="text" class="form-control"
                                                       name="ppc" value="{{ $setting->ppc }}"
                                                       placeholder=" ">

                                                @if ($errors->has('ppc'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('ppc') }}</strong>
                                    </span>
                                                @endif


                                            </div>




                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="panel-body">


                        <div class="btn btn-success btn-block" href="#id_seo_setting" data-toggle="collapse"><i
                                    class="fa fa-plus"></i>
                            تنظیمات سئو


                        </div>

                        <div id="id_seo_setting" class="panel-collapse collapse in">

                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-8 col-md-offset-2">


                                    <div class="panel-body">

                                        <div class="p-20">


                                            <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">


                                                <label for="author" class="control-label"> نویسنده :</label>


                                                <input id="author" type="text" class="form-control"
                                                       name="author" value="{{ $setting->author }}"
                                                       placeholder=" ">

                                                @if ($errors->has('author'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                                @endif


                                            </div>


                                            <div class="form-group{{ $errors->has('key_word') ? ' has-error' : '' }}">


                                                <label for="key_word" class="control-label"> کلمات کلیدی :</label>


                                                <textarea id="key_word" type="text" class="form-control"
                                                          name="key_word"
                                                          placeholder=" ">{{ $setting->key_word }}</textarea>

                                                @if ($errors->has('key_word'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('key_word') }}</strong>
                                    </span>
                                                @endif


                                            </div>


                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                                <label for="description" class="control-label"> توضیحات :
                                                    :</label>
                                                <textarea id="description" type="text" class="form-control"
                                                          name="description"
                                                          placeholder="">{{$setting->description}}</textarea>

                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                                @endif
                                            </div>


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel-body">


                        <div class="btn btn-success btn-block" href="#socials" data-toggle="collapse"><i
                                    class="fa fa-plus"></i>
                            تنظیمات شبکه های اجتماعی


                        </div>

                        <div id="socials" class="panel-collapse collapse in">

                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-8 col-md-offset-2">

                                    <div class="panel-body">

                                        <div class="p-20">


                                            <div class="form-group{{ $errors->has('telegram_link') ? ' has-error' : '' }}">


                                                <label for="telegram_link" class="control-label"> لینک تلگرام :</label>


                                                <input id="telegram_link" type="text" class="form-control"
                                                       name="telegram_link" value="{{ $setting->telegram_link }}"
                                                       placeholder="https://t.me/xxxxx">

                                                @if ($errors->has('telegram_link'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('telegram_link') }}</strong>
                                    </span>
                                                @endif


                                            </div>


                                            <div class="form-group{{ $errors->has('instagram_link') ? ' has-error' : '' }}">


                                                <label for="instagram_link" class="control-label"> لینک اینستاگرام
                                                    :</label>


                                                <input id="instagram_link" type="text" class="form-control"
                                                       name="instagram_link" value="{{ $setting->instagram_link }}"
                                                       placeholder="http://instagram.com/xxxxx">

                                                @if ($errors->has('instagram_link'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('instagram_link') }}</strong>
                                    </span>
                                                @endif


                                            </div>


                                            <div class="form-group{{ $errors->has('video_link') ? ' has-error' : '' }}">


                                                <label for="video_link" class="control-label"> لینک ویدیوی آموزشی
                                                    :</label>


                                                <textarea id="video_link" type="text" class="form-control"
                                                          name="video_link"
                                                          placeholder="">{{ $setting->video_link }}</textarea>

                                                @if ($errors->has('video_link'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('video_link') }}</strong>
                                    </span>
                                                @endif


                                            </div>


                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn"></i> ویرایش
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@stop