<div class="container-main container-system-users">
<img src="<?php echo $this->webroot; ?>img/logo-small.png">
<?php echo $this->Form->create('Customer', ['class' => 'login-form']); ?>
        <h2 class="login-form-header"><?php echo __('Join us!'); ?></h2>
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
            <span class="form-error-msg" id="error-name"><?php echo $this->Form->error('Customer.name'); ?></span>
            <?php
                echo $this->Form->input('email', [
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Email',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-email"><?php echo $this->Form->error('Customer.email'); ?></span>
            <?php
                echo $this->Form->input('password', [
                    'type'        => 'password',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Password',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-password"><?php echo $this->Form->error('Customer.password'); ?></span>
            <?php
                echo $this->Form->input('confirm_password', [
                    'type'        => 'password',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Confirm password',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-confirm_password"><?php echo $this->Form->error('Customer.confirm_password'); ?></span>
            <input type="submit" value="Submit">
            <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."customers/"; ?>')">Back to login</a>
<?php echo $this->Form->end(); ?>

</div>
