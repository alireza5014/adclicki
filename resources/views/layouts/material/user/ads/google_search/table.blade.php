<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table id="tech-companies-1" class="table  table-striped">
                    <thead>
                    <tr>

                        <th>#</th>


                        <th>عنوان</th>
                        <th style="width: 30%">لینک</th>
                        <th> محدودیت روزانه</th>


                        <th> جستجو های درخواست شده</th>
                        <th> جستجو های انجام شده</th>
                        <th>مانده تعداد جستجو</th>

                        <th> وضعیت تایید</th>
                        <th> وضعیت انتشار</th>
                        <th> زمان</th>

                        <th>مدیریت</th>

                    </tr>
                    </thead>

                    <tbody>

                    @foreach($ads as $ad)
                        <tr>
                            <td>{{$ad->id}}</td>


                            <td>
                                <p>  {{$ad->title}}  </p>
                            </td>

                            <td>
                                {{$ad->link}} <br/>
                                {{engine_type($ad->type)}} <br/>

                                @if(isset($ad->google_search))

                                    کلمه کلیدی : {{$ad->google_search->keyword}}  <br/>
                                    شماره صفحه : {{$ad->google_search->page_number}}  <br/>


                                    <a> رنک الکسا (ایران) :<span
                                                class="text-danger">{{getAlexaRank($ad->link)['iran']}}</span> ‌</a>
                                    <br/>
                                    <a> رنک الکسا (جهان) :<span
                                                class="text-black-50">{{getAlexaRank($ad->link)['global']}}</span> ‌</a>
                                    <br/>
                                    <a target="_blank" class="btn btn-sm btn-primary"
                                       href="https://www.alexa.com/siteinfo/{{$ad->link}}"> مشاهده رنک در سایت الگسا</a>
                                @endif

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
                                {{confirm($ad->status)}}


                                {{--@if($ad->status==1) تایید شده @else   منتظر تایید   @endif</td>--}}
                            </td>
                            <td>
                                @if(isset($ad->view_request))
                                    <a id="active_{{$ad->view_request->id}}"
                                       class="btn btn-xs btn-default"
                                       onclick="active({{$ad->view_request->id}})">

                                        <i class="zmdi zmdi-check @if($ad->view_request->status==1) text-success @else  text-danger @endif">

                                        </i>
                                        <p>@if($ad->view_request->status==1) منتشر شده @else  منتشر نشده @endif</p>
                                        <i style="display: none" id="loader{{$ad->view_request->id}}"
                                           class="zmdi zmdi-spinner fa-spin "></i>


                                    </a>
                                @else
                                    <p class="p_wink">با تخصیص جستجو آگهی شما منتشر خواهد شد</p>
                                @endif
                            </td>
                            <td>{{$ad->created_at}}</td>

                            <td>

                                <a onclick="setModal({{$ad->id}},'{{$ad->title}}');" data-toggle="modal"
                                   data-target="#view_request_modal" class="btn btn-xs btn-info">تخصیص جستجو </a>
                                <a href="{{route('user.ads.google_search.edit',['id'=>$ad->id])}}"
                                   class="btn btn-xs btn-primary">
                                    ویرایش </a>
                                {{--<a href="{{route('admin.comments.delete',['id'=>$ad->id])}}"--}}
                                {{--class="btn btn-xs btn-danger"><i class="zmdi zmdi-times-circle"></i></a>--}}

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



