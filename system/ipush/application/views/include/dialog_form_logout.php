<!-- Modal -->
<div class="js-logout-modal modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <div class="modal-pic"><img src="resource/img/icon-excMark.svg"></div>
        </div>
        <div class="modal-body"><?=$this->lang->line('logout_chk_text')?></div>
        <div class="modal-footer">
	        <button type="button" class="btn-block button btn2 btn-l" data-dismiss="modal" onclick="$('.js-logout-modal').hide()"><?=$this->lang->line('cancel')?></button>
            <button type="button" class="btn-block button btn1 btn-l" data-dismiss="modal" onclick="document.location.href=HTTP_ROOT+'/interface/main/logout'"><?=$this->lang->line('ok')?></button>
        </div>
        </div>
    </div>
</div>
