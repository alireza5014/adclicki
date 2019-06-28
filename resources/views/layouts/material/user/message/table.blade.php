<div class="table-rep-plugin">
    <div class="table-wrapper">

{{--<style>--}}
    {{--.text {--}}
        {{--display: block;--}}
        {{--width: 200px;--}}
        {{--overflow: hidden;--}}
        {{--white-space: nowrap;--}}
        {{--text-overflow: ellipsis;--}}
    {{--}--}}
{{--</style>--}}
        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table id="tech-companies-1" class="table  table-hover">
                    <thead>
                    <tr>

                        <th>#</th>
                        <th>تصویر</th>

                        <th>عنوان</th>
                        <th>توضیحات</th>

                        <th> نوع</th>
                        <th> زمان</th>
                        {{--<th> نمایش</th>--}}


                    </tr>
                    </thead>

                    <tbody>


                    @foreach($messages as $message)

                        <tr>
                            <td>{{$message->id}}</td>

                            <td><img src="{{url($message->image_path)}}"
                                     class="img-responsive"
                                     width="50px" height="50px"/></td>

                            <td>  {{$message->title}}       </td>
                            <td> <span class="text"> {{$message->description}}  </span>     </td>

                            <td>  {{is_public($message->is_public)}}       </td>
                            <td>{{$message->created_at}}</td>

                            {{--<td><a onclick="show_message('{{$message->title}}','{{$message->description}}')" data-toggle="modal" data-target="#show_message"class="btn btn-xs btn-primary">مشاهده</a></td>--}}

                        </tr>


                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function show_message(title,description) {
        $('#description').text(description);
        $('#title').text(title);

    }
</script>
{{--{{$messages->appends($_GET)->links()}}--}}



