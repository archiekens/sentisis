<div class="container-main container-system-users">
    <form class="login-form" role="form" method="POST" action="<?php echo $this->webroot;?>keywords/upload_csv" enctype="multipart/form-data">
        <h2 class="login-form-header"><?php echo __('Upload Keyword CSV'); ?></h2>
        <input id="csv-upload" type="file" name="file-0" />
        <span id="file-0-span" class="form__errormessage"></span>
        <button type="button" class="btn btn-block button__fix-width button__submit"><?php echo __("Upload"); ?></button>
        <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/index"; ?>')">Back to List</a>
    </form>
</div>

<script>
$('.button__submit').click(function(e){
    var data = new FormData();
    jQuery.each(jQuery('#csv-upload')[0].files, function(i, file) {
        data.append('file-'+i, file);
    });
    var opts = {
        url: '<?php echo $this->webroot;?>keywords/upload_csv',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          $('#file-0-span').html('');
          if(res.status == 'error' || res.status == 'errors'){
            $('#file-0-span').html(res.message);
          } else if (res.status == 'success') {
            window.location.href = "<?php echo $this->webroot;?>keywords/index";
          }
        }
    };
    if(data.fake) {
      // Make sure no text encoding stuff is done by xhr
      opts.xhr = function() { var xhr = jQuery.ajaxSettings.xhr(); xhr.send = xhr.sendAsBinary; return xhr; }
      opts.contentType = "multipart/form-data; boundary="+data.boundary;
      opts.data = data.toString();
    }
    jQuery.ajax(opts);
});
</script>