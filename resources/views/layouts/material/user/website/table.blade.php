<div class="table-rep-plugin">
    <div class="table-wrapper">

        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table class="table table-hover mb-0">

                    <thead>
                    <tr>

                        <th>#</th>


                        <th>دامنه</th>
                        <th>نوع سایت</th>
                        <th>نوع تبلیغ</th>

                        <th> وضعیت</th>
                        <th> تعداد بازید</th>
                        <th> درآمد(تومان)</th>
                        <th> کد</th>
                        <th> زمان</th>


                    </tr>
                    </thead>

                    <tbody>

                    @foreach($websites as $website)
                        <tr>
                            <td>{{$website->id}}</td>

                            <td>
                                {{$website->url}}
                            </td>

                            <td>
                                @foreach($website->subjects as $subject)
                                    {{$subject->title}}<br/>

                                @endforeach


                            </td>
                            <td>
                                {{$website->type}}
                            </td>
                            <td>
                                {{website_status($website->status)}}
                            </td>


                            @if(isset($website->visited_website) && $website->visited_website!=null )

                                <td>{{$website->visited_website->visit_count}}</td>
                                <td>{{$website->visited_website->visit_sum}}</td>



                            @else
                                <td>0</td>
                                <td>0</td>
                            @endif
                            <td><a href="#"
                                   onclick="setCodeModal('{{$website->id}}');"
                                   data-toggle="modal"
                                   data-target="#code_modal"

                                   class="btn btn-outline-primary"
                                >
                                     <i class="zmdi zmdi-code"></i>
                                    دریافت کد

                                </a></td>
                            <td>{{$website->created_at}}</td>

                            <td>
                                <a href="{{route('user.website.edit',['id'=>$website->id])}}"
                                   class="btn btn-xs btn-info"><i class="zmdi zmdi-edit"></i></a>
                            </td>
                            <td>

                                <button
                                        onclick="setDeleteModal('{{$website->id}}');"
                                        data-toggle="modal"
                                        data-target="#delete_modal"
                                        class="btn btn-xs btn-danger">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>

                            </td>
                        </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{$websites->appends($_GET)->links()}}



