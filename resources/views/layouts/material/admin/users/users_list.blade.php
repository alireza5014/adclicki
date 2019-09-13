@extends('layouts.material.layout')
@section('header')
    @parent
    <link href="{{asset('template/adminto/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>

    <title> لیست کاربران </title>

@endsection
@section('content')

    <div id="send_message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                          action="{{ route('admin.send_message_to_user') }}">
                        {{ csrf_field() }}

                        <p id="name"></p>
                        <input type="hidden" id="user_id" name="user_id"/>

                        <div class="form-group">

                            <div class="col-md-12">
                                <input class="form-control" placeholder="title" name="title" id="title" required>
                            </div>
                        </div>

                        <div class="form-group">


                            <div class="col-md-12">
                                <textarea class="form-control" placeholder="description" name="description"
                                          id="description" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12">
                                <input type="file" class="form-control" name="main_image" id="main_image">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label"> ارسال به تلگرام : </label>

                            <div class="col-md-6">
                                <input
                                        checked
                                        name="telegram"
                                        id="telegram"
                                        data-size="small"
                                        type="checkbox"
                                        data-plugin="switchery"
                                        data-color="#00b19d"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label"> ارسال به ایمیل : </label>

                            <div class="col-md-6">
                                <input
                                        checked
                                        name="email"
                                        id="email"
                                        data-size="small"
                                        type="checkbox"
                                        data-plugin="switchery"
                                        data-color="#00b19d"/>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-md btn-primary btn-block" >SEND</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->

            </div>
        </div>
    </div><!-- /.modal-dialog -->

         <div class="col-sm-12">
             <div class="card">


            <div class="card-box">

<div class="col-md-4 offset-md-4 mt-4">
    <form method="GET"  >
      <div class="btn-group">
          <input class="form-control" name="search" >
          <button  type="submit" class="btn btn-success btn-xs" >جستوجو</button>

      </div>
    </form>
</div>
    <div class="table-rep-plugin">
                    <div class="table-wrapper">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table  table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>تصویر</th>

                                    <th>نام و نام خانوادگی</th>


                                    <th>ایمیل</th>
                                    <th>تعداد بازدید</th>
                                    <th>تعداد زیرمجموعه</th>

                                    <th> زمان عضویت</th>

                                    <th>مدیریت</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>

                                        <td><img src="{{url($user->image_path)}}" class="img-responsive img-circle"
                                                 width="50px" height="50px"/>
                                        </td>

                                        <td>
                                            <p>  {{$user->fname}} {{$user->lname}}</p>
                                            <code>  {{$user->ip}}</code><br/>
                                            <code>  {{$user->country}}</code><br/>
                                            {{--                                           <code>  {{ip_info($user->ip, "State")}}</code><br/>--}}
                                            <code>  {{$user->mobile}}</code><br/>
                                            <code>  {{$user->device}}</code>
                                        </td>


                                        <td>{{$user->email}}</td>
                                        <td>{{$user->visited_links_count}}</td>
                                        <td>{{$user->referers_count}}</td>

                                        <td>{{$user->created_at}}</td>


                                        <td>

                                            <a href="{{route('active_user',['id'=>$user->id,'is_active'=>$user->is_active])}}">{{active($user->is_active)}}</a>


                                            <a href="{{route('edit_user',['id'=>$user->id])}}"><span
                                                        class="btn btn-info btn-xs >"> <i class="zmdi zmdi-edit"></i></span></a>

                                            <a href="{{url('admin/users/salary').'?user_id='.$user->id}}"   class="btn btn-info" target="_blank">ریز درآمد  کاربر</a>

                                        </td>

                                        <td>
                                            <a onclick="send_message('{{$user->id}}','{{$user->fname." ".$user->lname}}')"
                                               data-toggle="modal" data-target="#send_message"
                                               class="btn btn-xs btn-primary">ارسال پیام</a></td>

                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                {{$users->appends($_GET)->links()}}
            </div>


            <script>
                function send_message(user_id, name) {
                    $('#name').text('ارسال پیام به ' + name);
                    $('#user_id').val(user_id);

                }
            </script>
            @stop

            @section('js')
                <script src="{{asset('template/adminto/assets/plugins/switchery/switchery.min.js')}}"></script>

    @parent


@endsection