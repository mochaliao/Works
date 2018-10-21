<nav id="mobile-nav">
    <div class="m-nav-wrap">
        <div class="m-nav-out">
            <div class="m-nav-inner flyout-drop-cnt">
                <ul>
	                <li>
		                <ol>
			                <li class="self-dropdown-cnt"><a href="/page/info"><h5><?= $this->session->userdata("nickname") ?></h5></a></li>
			                <li class="i-money h6">
				                <a></a>:<span><?=number_format($this->session->userdata('balance'))?></span>
				                <div style="display: none" class="btn-gold-gra i-money-btn"><?=$this->lang->line('menu_deposit')?></div>
			                </li>
		                </ol>
	                </li>
	                <li>
		                <ol>
			                <li class="h5"><?php echo $this->lang->line('profile');?></li>
			                <li><a href="/page/info"><?= $this->session->userdata("nickname") ?>(首頁)</a></li>
			                <li><a href="/page/media"><?=$this->lang->line('menu_media')?></a></li>
			                <li><a href="/chat"><?=$this->lang->line('menu_message')?></a></li>
			                <li><a href="/page/info/friend_list"><?=$this->lang->line('menu_friend')?></a></li>
			                <li><a href="/page/info/collection_list"><?=$this->lang->line('menu_collection')?></a></li>
		                </ol>
	                </li>
	                <!--<li>-->
	                <!--<ol>-->
	                <!--<li class="h5"><a href="level_index.php">經驗值專區</a></li>-->
	                <!--<li class="h5"><a href="sign_index.php">簽到專區</a></li>-->
	                <!--<li class="h5"><a href="task_index.php">任務專區</a></li>-->
	                <!--<li class="h5"><a href="store_index.php">商城</a></li>-->
	                <!--</ol>-->
	                <!--</li>-->
	                
	                <li>
		                <ol>
			                <li><a href="/page/info/edit"><?=$this->lang->line('menu_edit_member')?></a></li>
			                <li><a class="modify-ps"><?=$this->lang->line('menu_change_password')?></a></li>
                            <li><a href="/member/showPrivacy"><?=$this->lang->line('menu_privacy')?></a></li>
			                <li><a href="/member/showService"><?=$this->lang->line('menu_service')?></a></li>
		                </ol>
	                </li>
                </ul>
                <button onclick="location.href='/member/doLogout'"><?=$this->lang->line('member_btn_logout')?></button>
            </div>
        </div>
    </div>
</nav>
