<footer class="footer-wrap">
	<div class="lang-exchange-wrap">
		<a class="js-lang-switch <? if (LANG == 'zh-tw') { ?>active<? } ?>" href="main/lang/zh-tw">繁體中文</a>
		<a class="js-lang-switch <? if (LANG == 'zh-cn') { ?>active<? } ?>" href="main/lang/zh-cn">简体中文</a>
		<a class="js-lang-switch <? if (LANG == 'english') { ?>active<? } ?>" href="main/lang/english">English</a>
	</div>
	<div class="footer-txt-link">
		<img src="resource/img/icon-email.svg">
		<a href="mailto:info@phuei-century.com">info@phuei-century.com</a>
	</div>
	<div class="footer-txt-term">I-Push System <?=$this->lang->line('copyright')?></div>
	<div class="footer-txt-term">I-Push System © <?= date('Y') ?> All Rights Reserved
		<a href="main/terms" target="_blank">Terms of Use</a>
	</div>
</footer>

<script>
$(document).ready(function(){
    
    // 切換語系事件綁定
    $('.js-lang-switch').unbind('click').click(function(){
        comm.post($(this).attr('href'), {}, function(){
            document.location.reload();
        });
        return false;
    });
    
});
</script>