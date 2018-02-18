<div class="container-main container-system-users container-form">
<?php echo $this->Form->create('Product', ['class' => 'login-form', 'enctype'=>'multipart/form-data']); ?>
        <h2 class="login-form-header"><?php echo __('Add Product'); ?></h2>
            <?php
                echo $this->Form->input('name', [
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Name',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-name"><?php echo $this->Form->error('Product.name'); ?></span>
            <?php
                echo $this->Form->input('type', [
                    'type'        => 'select',
                    'options'     => $product_types,
                    'error'       => false,
                    'required'    => false,
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <?php
                echo $this->Form->input('brand', [
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Brand',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-brand"><?php echo $this->Form->error('Product.brand'); ?></span>
            <?php
                echo $this->Form->input('description', [
                    'type'        => 'textarea',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Description',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <div class="form-image-container">
                <input type="file" id="profilePic" name="data[Product][image]" class="inputfile" onchange="previewPic(this,'product-img')" hidden/>
                <img src="<?php echo $this->webroot; ?>img/product-default.jpg" class="form-image" id="product-img">
                <label for="profilePic" class="file-button"><i class="fa fa-upload"></i>Choose File</label>
            </div>
            <span class="form-error-msg"><?php echo __($this->Form->error('Product.image')); ?></span>
         
            <input type="submit" value="Submit">
            <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."SUProducts/index"; ?>')">Back to List</a>
<?php echo $this->Form->end(); ?>

</div>
<script type="text/javascript">
    function previewPic(imgURL,imgId){
        if (imgURL.files && imgURL.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e){
                document.getElementById(imgId).src = e.target.result;
            }
            reader.readAsDataURL(imgURL.files[0]);
        }
    }
</script>
