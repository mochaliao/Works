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
            url : HTTP_ROOT + '/admin/interface/' + url,
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
    
    // Member Modal 選單
    this.show_member = function(target, pid, member_id_input, member_name_input, exclude_leader){
        
        var pid = pid ? pid : 0;
        var exclude_leader = exclude_leader ? exclude_leader : false;
        var member_id_input   = member_id_input   ? member_id_input   : $('input[name=m_id]');
        var member_name_input = member_name_input ? member_name_input : $('input[name=m_name]');
        
        var obj = $('<ul class="list-group">');
        this.post('member/get_member_by_pid', { pid : pid }, function(rs){
            for(k in rs) obj.append('<li class="list-group-item" data-id="' + rs[k].id + '" is_leader="' + rs[k].is_leader + '">' + rs[k].name + ( rs[k].is_leader == '1' ? ' [ Team Leader ] ' : '' ) + '</li>');
            obj.find('li').unbind('click').click(function(){
                
                target.find('.modal-footer button[data-role=submit]').removeClass('disabled');
                var is_leader = $(this).attr('is_leader') == '1' ? true : false;
                if(exclude_leader && is_leader){
                    target.find('.modal-footer button[data-role=submit]').addClass('disabled');
                }
                
                target.find('.modal-footer button[data-role=expand]').remove();
                obj.find('li').removeClass('active');
                $(this).addClass('active');
                
                var choice = $(this).attr('data-id');
                comm.post('member/get_member_by_pid', { pid : choice }, function(rs){
                    if(Object.keys(rs).length > 0){
                        var expand = $('<button type="button" class="btn btn-success" data-role="expand">' + comm.lang.expand + '</button>');
                        target.find('.modal-footer').append(expand);
                        expand.unbind('click').click(function(){
                            expand.remove();
                            comm.show_member(target, obj.find('li.active').attr('data-id'), member_id_input, member_name_input, exclude_leader);
                        });
                    }
                }, 'json');
                
            });
            target.find('.modal-body').html(obj);
        }, 'json');
        target.unbind('hidden.bs.modal').on('hidden.bs.modal', function(e){
            comm.show_member(target, 0, member_id_input, member_name_input, exclude_leader);
        });
        target.find('.modal-footer button[data-role=submit]').unbind('click').click(function(){
            if($(this).hasClass('disabled')) return false;
            if(obj.find('li.active').size() > 0){
                var team_id   = obj.find('li.active:eq(0)').attr('data-id');
                var team_name = obj.find('li.active:eq(0)').text();
                member_id_input.val(team_id);
                member_name_input.val(team_name);
                target.modal('hide');
            }
        });
    };
    
    // Team Modal 選單
    this.show_team = function(target, pid, team_id_input, team_name_input, exclude_self){
        
        var pid = pid ? pid : 0;
        var exclude_self = exclude_self ? exclude_self : false;
        var team_id_input   = team_id_input   ? team_id_input   : $('input[name=team_id]');
        var team_name_input = team_name_input ? team_name_input : $('input[name=team_name]');
        
        var obj = $('<ul class="list-group">');
        this.post('team/get_team_by_pid', { pid : pid }, function(rs){
            if(exclude_self) obj.append('<li class="list-group-item" data-id="0">' + comm.lang.team_tool_text + '</li>');
            for(k in rs) obj.append('<li class="list-group-item" data-id="' + rs[k].id + '">' + rs[k].name + '</li>');
            if(exclude_self) obj.find('li[data-id='+exclude_self+']').remove();
            obj.find('li').unbind('click').click(function(){
                target.find('.modal-footer button[data-role=expand]').remove();
                obj.find('li').removeClass('active');
                $(this).addClass('active');
                var choice = $(this).attr('data-id');
                comm.post('team/get_team_by_pid', { pid : choice }, function(rs){
                    if(Object.keys(rs).length > 0){
                        var expand = $('<button type="button" class="btn btn-success" data-role="expand">' + comm.lang.expand + '</button>');
                        target.find('.modal-footer').append(expand);
                        expand.unbind('click').click(function(){
                            expand.remove();
                            comm.show_team(target, obj.find('li.active').attr('data-id'), team_id_input, team_name_input, exclude_self);
                        });
                    }
                }, 'json');
            });
            target.find('.modal-body').html(obj);
        }, 'json');
        target.unbind('hidden.bs.modal').on('hidden.bs.modal', function(e){
            comm.show_team(target, 0, team_id_input, team_name_input, exclude_self);
        });
        target.find('.modal-footer button[data-role=submit]').unbind('click').click(function(){
            if(obj.find('li.active').size() > 0){
                var team_id   = obj.find('li.active:eq(0)').attr('data-id');
                var team_name = team_id == 0 ? comm.lang.team_top_team : obj.find('li.active:eq(0)').text();
                team_id_input.val(team_id);
                team_name_input.val(team_name);
                target.modal('hide');
            }
        });
    };
    
};