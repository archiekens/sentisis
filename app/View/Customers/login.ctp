<div class="container-main container-login">
    <div class="container-sub container-half container-half-left">
        <div class="login-headers">
            <h1>Welcome to the Store</h1>
            <h3>Everything. From bitches to riches.</h3>
        </div>
        <p class="login-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="container-sub container-half container-half-right">
            <?php echo $this->Form->create('Customer', ['class' => 'login-form']) ?>
            <h2 class="login-form-header">Sign in here</h2>
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
            <a href="#" class="login-form-forgot">Forgot password?</a>
            <input type="submit" value="Login">
            <?php echo $this->Form->end(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.login-headers').addClass('animate');
        $('.login-description').addClass('animate');
    });
</script>