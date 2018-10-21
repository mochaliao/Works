<!-- Modal -->
<div class="js-form_error modal" tabindex="-1" role="dialog" style="display:block;">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <div class="modal-pic"><img src="resource/img/icon-excMark.svg"></div>
        </div>
        <div class="modal-body">
            <?= $form_success ?>
            <?= $form_error   ?>
        </div>
        <div class="modal-footer">
	        <button type="button" class="btn-block button btn2 btn-l" data-dismiss="modal" onclick="$('.js-form_error').hide()"><?=$this->lang->line('cancel')?></button>
            <button type="button" class="btn-block button btn1 btn-l" data-dismiss="modal" onclick="$('.js-form_error').hide();if(typeof btn_ok_callback != 'undefined') btn_ok_callback();"><?=$this->lang->line('ok')?></button>
        </div>
        </div>
    </div>
</div>

<?if(isset($btn_ok_callback)){?>
<script>
<?=$btn_ok_callback?>
</script>
<?}?>