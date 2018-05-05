(function () {
    var params = {};
    //Document对象数据
    if(document) {
        params.href = document.location.href || '';
        params.referrer = document.referrer || '';
        params.title = document.title || '';
    }
    // 用户屏幕数据数据
    if(window && window.screen) {
        params.height = window.screen.height || 0;
        params.width = window.screen.width || 0;
        params.colorDepth = window.screen.colorDepth || 0;
    }
    //navigator对象数据
    if(navigator) {
        params.lang = navigator.language || '';
    }
    //解析_maq配置
    if(_maq) {
        for(var i in _maq) {
            if (_maq[i]) {
                params[_maq[i][0]] = _maq[i][1]
            }
        }
    }
    //拼接参数串
    var args = '';
    for(var i in params) {
        if(args != '') {
            args += '&';
        }
        args += i + '=' + encodeURIComponent(params[i]);
    }

    //通过Image对象请求后端脚本
    var img = new Image(1, 1);
    img.src = 'http://analyse.iian.xyz/collect?' + args;
})();
