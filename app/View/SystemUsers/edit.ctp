<div class="container-main container-system-users">
<?php echo $this->Form->create('SystemUser', ['class' => 'login-form']); ?>
        <h2 class="login-form-header"><?php echo __('Edit System User'); ?></h2>
            <?php echo $this->Form->input('id'); ?>
            <?php
                echo $this->Form->input('username', [
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Name',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-username"><?php echo $this->Form->error('SystemUser.username'); ?></span>
            <?php
                echo $this->Form->input('password', [
                    'type'        => 'password',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Password',
                    'label'       => false,
                    'div'         => false,
                    'value'       => ''
                ]
            ); ?>
            <span class="form-error-msg" id="error-password"><?php echo $this->Form->error('SystemUser.password'); ?></span>
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
            <span class="form-error-msg" id="error-confirm_password"><?php echo $this->Form->error('SystemUser.confirm_password'); ?></span>
            <input type="submit" value="Submit">
            <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."system_users/index"; ?>')">Back to List</a>
<?php echo $this->Form->end(); ?>

</div>
