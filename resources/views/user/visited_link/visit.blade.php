<div style="text-align: center;border: 1px solid #0b0b0b;background: #000000;min-height: 50px">
    @if($visit)
        <img src="{{url('clickend.gif')}}">
    @else
        <p dir="rtl" style="font-family: 'Iranian Sans',serif;color: #ffffff;"> کاربر گرامی برای دریافت {{$ppc*10}}
            ریـال
            درآمد این تبلیغ <span id="timer" style="color: #ff5039"></span> منتظر بمانید</p>

        <iframe sandbox="allow-same-origin allow-scripts allow-forms" id="iframe1" src="{{$ads_info->ad->link}}"
                style="width: 100%; height:100%;"
                frameborder="0" scrolling="auto">

        </iframe>
        <script>

            document.getElementById('timer').innerHTML = 0 + ":" + 41;
            startTimer();

            function startTimer() {
                var presentTime = document.getElementById('timer').innerHTML;
                var timeArray = presentTime.split(/[:]+/);
                var m = timeArray[0];
                var s = checkSecond((timeArray[1] - 1));
                if (s == 59) {
                    m = m - 1
                }
                //if(m<0){alert('timer completed')}

                document.getElementById('timer').innerHTML =
                    m + ":" + s;
                setTimeout(startTimer, 1500);
            }

            function checkSecond(sec) {
                if (sec < 10 && sec >= 0) {
                    sec = "0" + sec
                }
                ; // add zero in front of numbers < 10
                if (sec < 0) {
                    sec = "59"
                }
                ;
                return sec;
            }

            setInterval(function () {
                window.open(location.href + '/verify', '_self');
            }, 60000);

        </script>

    @endif


</div>

