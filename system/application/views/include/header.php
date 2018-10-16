<div class="nav-bar-wrap fixed-top">
	<nav class="navbar nav-bar">
		<a class="nav-logo" href="<?= HTTP_ROOT ?>">
			<picture>
				<source media="(max-width: 414px)" srcset="resource/img/logo-414.svg">
				<img src="resource/img/logo.svg" alt="logo">
			</picture>
		</a>
		<div>
			<span class="nav-member-name"><?=str_replace('__NAME__', $_SESSION['name'], $this->lang->line('hello'))?></span>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu"
			aria-expanded="false" aria-label="Toggle navigation"
			>
				<span class="navbar-toggler-icon"><img src="resource/img/icon-hamburger.svg"></span>
			</button>
		</div>
	
	</nav>
</div>
<div class="collapse nav-cnt-wrap" id="menu">
	<div class="nav-cnt">
		<div class="nav-cnt-top">
			<span class="nav-member-name"><?=str_replace('__NAME__', $_SESSION['name'], $this->lang->line('hello'))?></span>
			<button class="navbar-toggler nav-bar-btn-wrap" type="button" data-toggle="collapse" data-target="#menu"
			aria-controls="menu"
			aria-expanded="false" aria-label="Toggle navigation"
			>
				
				<span class="nav-bar-btn-close"><img src="resource/img/icon-close.svg"><span><?=$this->lang->line('close')?></span></span>
			</button>
		</div>
		
		<ul id="js-menu" class="navbar-nav mr-auto">
			<!--			<li class="nav-item">-->
			<!--				<a class="nav-link" href="main/index">--><? //= $this->lang->line('index') ?>
			<!--					<span class="sr-only">(current)</span></a>-->
			<!--			</li>-->
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false"
				>
					<span class="nav-link-icon"><img src="resource/img/icon-list1.svg"></span>
					<span class="nav-link-txt"><?=$this->lang->line('menu_profile_mng')?></span>
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="member/assets"><?=$this->lang->line('menu_profile_assets')?></a>
					<a class="dropdown-item" href="member/upd_info"><?=$this->lang->line('menu_profile_upd_info')?></a>
					<a class="dropdown-item" href="member/upd_pwd"><?=$this->lang->line('member_upd_pwd')?></a>
					<!--<a class="dropdown-item" href="member/upd_txn_pwd"><?=$this->lang->line('menu_profile_upd_txn_pwd')?></a>-->
					<a class="dropdown-item" href="member/wdrl_bag"><?=$this->lang->line('menu_profile_wdrl_bag')?></a>
					<a class="dropdown-item" href="member/set_paypal"><?=$this->lang->line('menu_profile_set_paypal')?></a>
				</div>
			</li>
			
            <!--
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
					<span class="nav-link-icon"><img src="resource/img/icon-list2.svg"></span>
					<span class="nav-link-txt"><?=$this->lang->line('menu_profile_team_mng')?></span></a>
				<div class="dropdown-menu" aria-labelledby="dropdown02">
					<a class="dropdown-item" href="#"><?=$this->lang->line('menu_profile_team_tree')?></a>
				</div>
			</li>
            -->
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
					<span class="nav-link-icon"><img src="resource/img/icon-list3.svg"></span>
					<span class="nav-link-txt"><?=$this->lang->line('menu_profile_order_mng')?></span>
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdown02">
					<a class="dropdown-item"  href="order/order_add"><?=$this->lang->line('menu_profile_order_add')?></a>
				</div>
			</li>
			
			<li class="nav-item">
				<a class="nav-link" href="order/record_bag">
					<span class="nav-link-icon"><img src="resource/img/icon-list4.svg"></span>
					<span class="nav-link-txt"><?=$this->lang->line('menu_profile_transaction')?></span></a>
			</li>
			
			<li class="nav-item">
				<button id="js-logout" class="nav-link" type="submit">
					<span class="nav-link-icon"><img src="resource/img/icon-list5.svg"></span>
					<span class="nav-link-txt"><?=$this->lang->line('logout')?></span>
				</button>
			</li>
		
		</ul>
	</div>

</div>

<? $this->load->view('include/dialog_form_logout') ?>

<script>
$(document).ready(function(){
    
    // 登出事件綁定
    $('#js-logout').unbind('click').click(function(){
        $('button[data-target=#menu]:eq(0)').trigger('click');
        $('.js-logout-modal').modal('show');
        return false;
    });
    
    // 切換頁面功能事件綁定
    $('button[data-target=#menu]:eq(0)').one('click', function(){
        $('#js-menu li').each(function(){
            var li = $(this);
            li.find('a').each(function(){
                if($(this).attr('href').substr(0, CURRENT_PAGE.length) == CURRENT_PAGE){
                    $(this).addClass('active');
                    var itv = setInterval(function(){
                        obj = li.find('a[data-toggle=dropdown]:eq(0)');
                        if(obj.size() > 0){
                            clearInterval(itv);
                            obj.trigger('click');
                        }
                    }, 200);
                }
            });
        });
    });
        
});
</script>
