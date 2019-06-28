function adclicki() {
    var url = document.referrer;
    var urll = url.split('://')[1].split('/').slice(0, 1).join('/');
    if (urll == "www.google.com" || urll == "www.bing.com" || urll == "search.yahoo.com" || urll == "www.aparat.com") {
        var input1 = document.getElementById('demo').innerHTML = " ( ثبت امتیاز تبلیغ )   ";
        document.getElementById("demo").target = "_blank";
        document.getElementById("demo").style.color = "Orange";
        document.getElementById("demo").style.marginRight = "30%";
        var href = document.getElementById("demo").getAttribute('href');
        switch (urll) {
            case "www.google.com":
                document.getElementById("demo").setAttribute('href', href + '/google');
                break;
            case "www.bing.com":
                document.getElementById("demo").setAttribute('href', href + '/bing');
                break;
            case "www.aparat.com":
                document.getElementById("demo").setAttribute('href', href + '/aparat');
                break;
            case "search.yahoo.com":
                document.getElementById("demo").setAttribute('href', href + '/yahoo');
                break;
        }

    }
}

setTimeout(adclicki, 5000);