<div class="table-rep-plugin">
    <div class="table-wrapper">

        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table class="table table-hover mb-0">

                    <thead>
                    <tr>

                        <th>نام و نام خانوادگی</th>


                        <th>اطلاعات تماس</th>

                        <th> سهم شما از درآمد زیر مجموعه</th>

                        <th> تاریخ خرید زیر مجموعه</th>
                        <th> تاریخ انقضا</th>
                        <th>   مدیریت</th>


                    </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0?>
                    @foreach($subcategories as $subcategory)
                        <tr>

                            <td>{{$subcategory->user->fname}}</td>

                            <td>
                                {{str_replace(substr($subcategory->user->email,1,10),'****',$subcategory->user->email)}}

                            </td>
                            <td>{{$referer_price[$i]}} تومان</td>


                            {{--<td>{{$subcategory->price}}</td>--}}
                            <td>{{verta($subcategory->created_at)}}</td>
                            <td>{{verta($subcategory->expire_date)}}</td>
                            <td><a href="{{route('admin.subcategory.refresh',['id'=>$subcategory->id])}}" class="btn btn-warning"><i class="zmdi zmdi-refresh-sync" ></i></a> </td>

                        </tr>

                        <?php $i++ ?>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{$subcategories->appends($_GET)->links()}}



