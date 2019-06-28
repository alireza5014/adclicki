<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table class="table table-hover mb-0">

                <thead>
                    <tr>

                        <th>#</th>


                        <th>مبلغ (تومان)</th>
                        <th>توضیحات</th>

                        <th> وضعیت پرداخت</th>
                        <th> زمان</th>
                        <th> رسید پرداختی</th>


                    </tr>
                    </thead>

                    <tbody>

                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td>{{$withdrawal->id}}</td>

                            <td>
                                {{number_format($withdrawal->price)}}
                            </td>


                            <td>
                                {{$withdrawal->description}}
                            </td>



                            <td>{{$withdrawal->created_at}}</td>

                            @if($withdrawal->is_pay==1)
                                <td>پرداخت شده</td>
                                <td><a href="{{url($withdrawal->image_path)}}" target="_blank"><img src="{{url(str_replace('main','main',$withdrawal->image_path))}}" width="100px"> </a> </td>

                            @else
                            <td>     منتظر پرداخت   </td>
                            <td>    ||  </td>

                            @endif



                        </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{$withdrawals->appends($_GET)->links()}}



