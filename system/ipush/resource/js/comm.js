var comm = function(lang){
    
    // 建構子
    // 取得語系文字
    this.lang = lang;
    
    // [ POST 方法 ] -- 使用非同步排程 ( 叫用 )
    this.post = function(url, arr, call_back, data_type){
        var data_type = data_type ? data_type : 'text';
        var arr = arr ? arr : {};
        arr[CSRF_NAME] = CSRF_HASH;
        var call_back = ( call_back && typeof call_back == 'function' ) ? call_back : function(res){};
        $.when(this.do_post(url, arr, call_back, data_type)).then(call_back);
    };
    // [ POST 方法 ] -- 使用非同步排程 ( 被叫用 )
    this.do_post = function(url, arr, call_back, data_type){
        var dfd = new $.Deferred();
        $.ajax({
            type : 'post',
            url : HTTP_ROOT + '/interface/' + url,
            dataType : data_type,
            data : arr,
            cache : false,
            error : function(jqXHR,textStatus,errorThrown){
                var message = "There was an error with the AJAX request.\n";
                message += "\n Ajax Failed -- " + url;
                message += "\n" + jqXHR + "\n" + textStatus + "\n" + errorThrown;
                alert(message);
            },
            success : function(rs){
                dfd.resolve(rs);
            }
        });
        return dfd.promise();
    };
    
    // 製作 Captcha 功能
    this.captcha = function(target){
        this.post('captcha/index', {}, function(res){
            var obj = res.image + '<input type="hidden" name="captcha" value="' + res.word + '" />';
            target.html(obj);
            target.find('img:eq(0)').css('cursor', 'pointer');
            target.find('img:eq(0)').unbind('click').click(function(){
                comm.captcha(target);
            });
        }, 'json');
    };
    
    // 發送會員信箱驗證碼
    this.chkcode = function(email, callback){
        this.post('member/send_chkcode', { email : email }, callback, 'json');
    };
    
    // 檢查日期是否有效
    this.chkdate = function(dateStr){
        var dateObj = dateStr.split('-');
        var limitInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var theYear = parseInt(dateObj[0]);
        var theMonth = parseInt(dateObj[1]);
        var theDay = parseInt(dateObj[2]);
        var isLeap = new Date(theYear, 1, 29).getDate() === 29;
        if(isLeap) {
            limitInMonth[1] = 29;
        }
        return theDay <= limitInMonth[theMonth - 1];
    };
    
};