<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table id="tech-companies-1" class="table  table-striped">
                    <thead>
                    <tr>

                        <th>ID</th>
                        <th>تصویر</th>

                        <th>مشخصات کاربر</th>
                        <th>عنوان</th>
                        <th>لینک</th>
                        <th> محدودیت روزانه</th>


                        <th> تعداد کلیک های درخواست شده</th>
                        <th> تعداد کلیک های انجام شده</th>
                        <th>مانده تعداد کلیک</th>

                        <th> وضعیت تایید</th>
                        <th> وضعیت انشار</th>
                        <th> زمان</th>


                    </tr>
                    </thead>

                    <tbody>

                    @foreach($ads as $ad)
                        <tr>
                            <td>{{$ad->id}}</td>

                            <td><img src="{{url($ad->image_path)}}"
                                     class="img-responsive"
                                     width="280px" height="50px"/>
                            </td>
                            <td>
                                {{$ad->user->fname." ".$ad->user->lname}}
                                <br>
                                {{$ad->user->email}}
                            </td>

                            <td>
                                <p>  {{$ad->title}}  </p>
                            </td>

                            <td>
                                <p>  {{$ad->link}}  </p>
                            </td>


                            <td>{{$ad->daily_click}}</td>
                            <td>
                                @if(isset($ad->view_request))
                                    <?php $v_r = $ad->view_request->count;?>
                                    {{$ad->view_request->count}}
                                @else
                                    <?php $v_r = 0;?>

                                @endif
                            </td>
                            <td>{{$ad->visited_links_count}}</td>
                            <td>{{$v_r-$ad->visited_links_count}}</td>

                            <td>
                                <a id="confirm_{{$ad->id}}"
                                   class="btn btn-xs btn-default"
                                   onclick="confirm({{$ad->id}})">

                                    <i class="fa fa-check @if($ad->status==1) text-success @else  text-danger @endif">

                                    </i>
                                    <p>@if($ad->status==1) تایید شده @else     منتظر تایید کارشناس @endif</p>
                                    <i style="display: none" id="loader{{$ad->id}}"
                                       class="fa fa-spinner fa-spin "></i>


                                </a>

                                {{--@if($ad->status==1) تایید شده @else   منتظر تایید کارشناس @endif--}}


                            </td>

                            <td>
                                @if(isset($ad->view_request))
                                    <a id="active_{{$ad->view_request->id}}"
                                       class="btn btn-xs btn-default"
                                       onclick="active({{$ad->view_request->id}})">

                                        <i class="fa fa-check @if($ad->view_request->status==1) text-success @else  text-danger @endif">

                                        </i>
                                        <p>@if($ad->view_request->status==1) منتشر شده @else  منتشر نشده @endif</p>
                                        <i style="display: none" id="loader{{$ad->view_request->id}}"
                                           class="fa fa-spinner fa-spin "></i>


                                    </a>
                                @endif
                            </td>
                            <td>{{$ad->created_at}}</td>
                            <td><a href="{{route('user.ads.delete',['id'=>$ad->id])}}" class="btn btn-xs btn-danger">DELETE</a>
                            </td>

                        </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{$ads->appends($_GET)->links()}}



