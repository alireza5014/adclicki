var popuper_url;
document.popuper_popup = false;
var popuper_browser = function() {
    var n = navigator.userAgent.toLowerCase();
    var b = {
        webkit: /webkit/.test(n),
        mozilla: (/mozilla/.test(n)) && (!/(compatible|webkit)/.test(n)),
        chrome: /chrome/.test(n),
        msie: (/msie/.test(n)) && (!/opera/.test(n)),
        firefox: /firefox/.test(n),
        safari: (/safari/.test(n) && !(/chrome/.test(n))),
        opera: /opera/.test(n)
    };
    b.version = (b.safari) ? (n.match(/.+(?:ri)[\/: ]([\d.]+)/) || [])[1] : (n.match(/.+(?:ox|me|ra|ie)[\/: ]([\d.]+)/) || [])[1];
    return b;
}();

function popuper_pop2under() {
    try { popuper_popup_ww.blur(); } catch (e) {}
    try { popuper_popup_ww.opener.window.focus(); } catch (e) {}
    try { window.self.window.focus(); } catch (e) {}
    try { window.focus(); } catch (e) {}
    try {
        if (popuper_browser.firefox) openCloseWindow();
        if (popuper_browser.webkit) openCloseTab();
        if (popuper_browser.msie) {
            setTimeout(function() {
                popuper_popup_ww.blur();
                popuper_popup_ww.opener.window.focus();
                window.self.window.focus();
                window.focus();
            }, 1000);
        }
    } catch (e) {}
}

function openCloseWindow() {
    var ghost = window.open('about:blank');
    ghost.focus();
    ghost.close();
}

function openCloseTab() {
    var nothing = '';
    var ghost = document.createElement("a");
    ghost.href = "data:text/html,<scr"+nothing+"ipt>window.close();</scr"+nothing+"ipt>";
    document.getElementsByTagName("body")[0].appendChild(ghost);

    var clk = document.createEvent("MouseEvents");
    clk.initMouseEvent("click", false, true, window, 0, 0, 0, 0, 0, true, false, false, true, 0, null);
    ghost.dispatchEvent(clk);

    ghost.parentNode.removeChild(ghost);
}

popuper_wid = (typeof popuper_website_id == 'undefined') ? 'null' : popuper_website_id;
popuper_uid = (typeof popuper_user_id == 'undefined') ? 'null' : popuper_user_id;
var script = document.createElement('script');
var x = Math.floor((Math.random()*10000000)+1);
script.type = 'text/javascript';
script.src = 'https://popupaval.com/website/pp/'+popuper_wid+'/'+popuper_uid+'/'+window.location.hostname+'/?'+x;
var bd = document.getElementsByTagName('body');
var hd = document.getElementsByTagName('head')[0];
hd.appendChild(script);