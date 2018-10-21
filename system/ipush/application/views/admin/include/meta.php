<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<base href="<?=HTTP_ROOT?>" />
<link rel="icon" href="resource/admin/img/favicon.ico" />
<title><?=SITE_NAME?></title>
<script src="resource/plugin/jquery/jquery-1.11.3.min.js"></script>
<script src="resource/plugin/jquery-ui/jquery-ui.min.js"></script>
<script src="resource/plugin/jquery-ui/ui/i18n/<?=LANG?>.js"></script>
<link type="text/css" rel="stylesheet" href="resource/plugin/jquery-ui/jquery-ui.min.css" />
<link type="text/css" rel="stylesheet" href="resource/plugin/jquery-ui/jquery-ui.theme.min.css" />
<script src="resource/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
<link type="text/css" rel="stylesheet" href="resource/plugin/bootstrap/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="resource/admin/css/style.css" />
<script src="resource/admin/js/comm.js"></script>
<script>
HTTP_ROOT    = '<?=HTTP_ROOT?>';
LANG         = '<?=LANG?>';
CSRF_NAME    = '<?=CSRF_NAME?>';
CSRF_HASH    = '<?=CSRF_HASH?>';
CURRENT_PAGE = '<?=CI_CONTROLLER?>/<?=CI_METHOD?>';
comm         = new comm(<?=json_encode($this->lang->language)?>);
</script>
