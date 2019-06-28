@section('header')
    @parent

    <title>     گزارش بازدیدها </title>

@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">


            <div class="card-box">


                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="btn-toolbar">
                            <div class="btn-group focus-btn-group">

                            </div>
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
                        </div>
                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table  table-striped">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>تصویر</th>

                                    <th>نام و نام خانوادگی</th>
                                    <th> سیستم عامل</th>

                                    <th>مرورگر</th>
                                    <th>آی پی</th>

                                    <th> زمان بازدید</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php $x=0 ?>
                                @foreach($views as $view)
                                    <tr>
                                        <td>{{++$x}}</td>
                                        <td><img src="{{url($view->user->image_path)}}"
                                                 class="img-circle img-responsive" width="30px"/></td>
                                        <td>{{$view->user->fname .' '.$view->user->lname}}</td>
                                        <td>{{$view->os}}</td>
                                        <td>{{$view->browser}}</td>
                                        <td>{{$view->ip}}</td>
                                        <td>{{$view->created_at}}</td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                {{$views->appends($_GET)->links()}}
            </div>



@stop