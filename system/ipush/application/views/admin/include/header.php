<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?=HTTP_ROOT?>/admin">Back System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
        <ul id="js-menu" class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admin/main/index"><?=$this->lang->line('index')?> <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('menu_account')?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="admin/member/upd_pwd"><?=$this->lang->line('member_upd_pwd')?></a>
                </div>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('menu_team_list')?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="admin/team/index"><?=$this->lang->line('team_list')?></a>
                    <a class="dropdown-item" href="admin/team/team_add"><?=$this->lang->line('menu_team_add')?></a>
                    <a class="dropdown-item" href="admin/team/team_upd"><?=$this->lang->line('menu_team_upd')?></a>
                </div>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('member_mng')?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="admin/member/index"><?=$this->lang->line('menu_member_list')?></a>
                    <a class="dropdown-item" href="admin/member/member_add"><?=$this->lang->line('menu_member_add')?></a>
                    <a class="dropdown-item" href="admin/member/member_cert"><?=$this->lang->line('menu_member_cert')?></a>
                </div>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('menu_business')?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="admin/order/index"><?=$this->lang->line('order_mng')?></a>
                    <a class="dropdown-item" href="admin/order/order_add"><?=$this->lang->line('menu_order_add')?></a>
                </div>
            </li>
            
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <div class="dropdown mr-sm-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('language_switch')?></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="js-lang-switch dropdown-item <?if(LANG == 'zh-tw'){?>active<?}?>" href="main/lang/zh-tw">繁體中文</a>
                    <a class="js-lang-switch dropdown-item <?if(LANG == 'zh-cn'){?>active<?}?>" href="main/lang/zh-cn">简体中文</a>
                    <a class="js-lang-switch dropdown-item <?if(LANG == 'english'){?>active<?}?>" href="main/lang/english">English</a>
                </div>
            </div>
            <button class="btn btn-outline-success my-2 my-sm-0 btn-logout" type="submit" onclick="document.location.href=HTTP_ROOT+'/admin/interface/main/logout'"><?=$this->lang->line('logout')?></button>
        </div>
    </div>
</nav>

<script>
$(document).ready(function(){
    
    var ADMIN_CURRENT_PAGE = 'admin/' + CURRENT_PAGE;
    
    // 切換頁面功能事件綁定
    $('#js-menu li').each(function(){
        var li = $(this).removeClass('active');
        li.find('a').each(function(){
            $(this).removeClass('active');
            if($(this).attr('href').substr(0, ADMIN_CURRENT_PAGE.length) == ADMIN_CURRENT_PAGE){
                li.addClass('active');
                $(this).addClass('active');
            }
        });
    });
    
    // 切換語系事件綁定
    $('.js-lang-switch').unbind('click').click(function(){
        comm.post($(this).attr('href'), {}, function(){
            document.location.reload();
        });
        return false;
    });
    
});
</script>
