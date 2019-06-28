@extends('layouts.adminto.layout')
@section('header')
    @parent

    <title> لیست امکانات </title>
    <style>

    </style>
@endsection
@section('content')
    <div id="new_possibility" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">

                <form method="POST" class="form-horizontal" action="{{route('possibility_save')}}">

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="title"> عنوان:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="عنوان امکانات را وارد کنید">
                        </div>
                        <p id="l_mobile_error" class="text-danger"></p>

                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-3" for="password"> آیکن:</label>
                        <div class="col-sm-9">
                            <input autocomplete="false" type="text" class="form-control" id="icon"
                                   name="icon"
                                   placeholder="fa fa-icon">
                            <p id="icon_error" class="text-danger"></p>

                        </div>
                    </div>


                    <button type="submit" class="btn   btn-block btn-success  ">
                        ثبت
                    </button>


                </form>


            </div><!-- /.modal-content -->

        </div>

    </div>

    <div id="edit_possibility" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">

                <form method="POST" class="form-horizontal" action="{{route('possibility_modify')}}">
                    <input id="e_id" name="id" type="hidden">
                    @csrf

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="title"> عنوان:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="e_title" name="title"
                                   placeholder="عنوان امکانات را وارد کنید">
                        </div>
                        <p id="l_mobile_error" class="text-danger"></p>

                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-3" for="password"> آیکن:</label>
                        <div class="col-sm-9">
                            <input autocomplete="false" type="text" class="form-control" id="e_icon"
                                   name="icon"
                                   placeholder="fa fa-icon">
                            <p id="icon_error" class="text-danger"></p>

                        </div>
                    </div>


                    <button type="submit" class="btn   btn-block btn-success  ">
                        ویرایش
                    </button>


                </form>


            </div><!-- /.modal-content -->

        </div>

    </div>
    <div class="row">
        <div class="card-box col-sm-12">


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
            <div class="btn-group dropdown-btn-group pull-left">
                <a data-toggle="modal" data-target="#new_possibility" class=" btn btn-sm btn-success"><i
                            class="fa fa-plus-circle"></i> جدید </a>
            </div>
            <div class="clearfix"></div>
            <hr>
            @foreach($possibilities as $possibility)
                <div class="col-md-3">
                    <div class="card-box">

                        <ul class="list-inline">
                            <li style="width: 60%"><p>  <i class="{{$possibility->icon}} fa-half-x"></i> {{$possibility->title}} </p></li>

                            <li><a data-toggle="modal" data-target="#edit_possibility"
                                   onclick="edit_possibility('{{$possibility->id}}','{{$possibility->title}}','{{$possibility->icon}}')"
                                   class="btn btn-xs btn-info"><i class="fa fa-edit"></i> </a></li>
                            <li>
                                @if($possibility->active==1)
                                    <a href="{{route('possibility_active',['active'=>$possibility->active,'id'=>$possibility->id])}}"
                                       class="btn btn-xs btn-success"><i class="fa fa-check-circle"></i></a>

                                @else
                                    <a  href="{{route('possibility_active',['active'=>$possibility->active,'id'=>$possibility->id])}}" class="btn btn-xs btn-danger"><i class="fa fa-times-circle"></i></a>

                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach


            <div class="clearfix">

            </div>

            {{$possibilities->appends($_GET)->links()}}

        </div>

    </div>
    <script>
        function edit_possibility(id, title, icon) {
            $('#e_id').val(id);
            $('#e_title').val(title);
            $('#e_icon').val(icon);
        }
    </script>
@stop