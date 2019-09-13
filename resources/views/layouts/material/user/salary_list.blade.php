@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست درآمد کاربر </title>

@endsection
@section('content')


         <div class="col-sm-12">
             <div class="card">


            <div class="card-box">


    <div class="table-rep-plugin">
                    <div class="table-wrapper">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table  table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>تصویر</th>

                                    <th>نام و نام خانوادگی</th>


                                    <th>زمان</th>
                                    <th>  درآمد</th>
                                    <th>تعداد بازدید</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($salary as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>

                                        <td><img src="{{url($item->v_user->image_path)}}" class="img-responsive img-circle"
                                                 width="50px" height="50px"/>
                                        </td>

                                        <td>
                                            <p>  {{$item->v_user->fname}} {{$item->v_user->lname}}</p>
                                            <code>  {{$item->v_user->mobile}}</code><br/>
                                            <code>  {{$item->v_user->email}}</code>
                                            <code>  {{$item->v_user->created_at}}</code>
                                        </td>

                                        <td>{{verta($item->created_at)}}</td>

                                        <td>{{$item->price}}</td>
                                        <td>{{$item->click_count}}</td>



                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                {{$salary->appends($_GET)->links()}}
            </div>



            @stop

            @section('js')

    @parent


@endsection