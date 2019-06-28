@extends('layouts.adminto.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">
                <div class="box-header">
                    <h3 class="box-title">لیست پیامها  </h3>
                    <div class="box-tools">

                        <form method="get" action="" class="input-group" style="width: 150px;">

                            <input type="text" name="keyword" class="form-control input-sm pull-right"
                                   placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>email</th>
                            <th>Message</th>
                            <th>ip</th>
                            <th>create_at</th>


                        </tr>
                        @foreach($contacts as $contact)
                            <tr>
                                <td> {{$contact->id}}</td>
                                <td> {{$contact->name}}</td>
                                <td> {{$contact->email}}</td>
                                <td> {{$contact->message}}</td>
                                <td> {{$contact->ip}}</td>
                                <td> {{$contact->created_at}}</td>
                            </tr>

                        @endforeach

                    </table>

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>


        {{$contacts->appends($_GET)->links()}}
    </div>
@stop