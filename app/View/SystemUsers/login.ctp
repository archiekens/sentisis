<div class="container-main container-system-users container-system-user-login">
    <?php echo $this->Form->create('SystemUser', ['class' => 'login-form']) ?>
            <h2 class="login-form-header">Admin Login</h2>
            <?php
                echo $this->Form->input('username', [
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Username',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-username"><?php echo $this->Form->error('Customer.username'); ?></span>
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
            <input type="submit" value="Login">
            <?php $this->Form->end(); ?>

</div>