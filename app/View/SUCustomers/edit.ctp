<div class="container-main container-system-users">
<?php echo $this->Form->create('Customer', ['class' => 'login-form']); ?>
        <h2 class="login-form-header"><?php echo __('Edit Customer'); ?></h2>
            <?php echo $this->Form->input('id'); ?>
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
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Password',
                    'label'       => false,
                    'div'         => false,
                    'value'       => ''
                ]
            ); ?>
            <span class="form-error-msg" id="error-password"><?php echo $this->Form->error('Customer.password'); ?></span>
            <input type="submit" value="Submit">
            <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."SUCustomers/index"; ?>')">Back to List</a>
<?php echo $this->Form->end(); ?>

</div>
