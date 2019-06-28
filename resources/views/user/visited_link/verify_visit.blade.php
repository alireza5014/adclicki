<div style="text-align: center;border: 1px solid #0b0b0b;background: #000000;min-height: 50px">

@if($visit_verify)

     <p  style=" color: #ffffff;">امتیاز این آگهی برای شما ثبت شد.</p>

<script>
    setInterval(function () {

        window.open('<?php echo $ads_info->ad->link;?>', '_self');
    }, 2000);

</script>
    @else
    <p style="font-family: 'Iranian Sans',serif;color: #ffffff;" >خطا ! لطفا مجدد تلاش نمایید</p>
    @endif
</div>
{{--<iframe id="iframe1" src="{{$ads_info->ad->link}}" allowtransparency="true" style="width: 99%; height:100%;"--}}
        {{--frameborder="0" scrolling="auto">--}}

{{--</iframe>--}}



