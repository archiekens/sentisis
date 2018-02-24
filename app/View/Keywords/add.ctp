<div class="container-main container-system-users">
<?php echo $this->Form->create('Keyword', ['class' => 'login-form']); ?>
        <h2 class="login-form-header"><?php echo __('Add Keyword'); ?></h2>
            <?php
                echo $this->Form->input('word', [
                    'type'        => 'text',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Keyword',
                    'label'       => false,
                    'div'         => false,
                ]
            ); ?>
            <span class="form-error-msg" id="error-word"><?php echo $this->Form->error('Keyword.word'); ?></span>
            <?php
                echo $this->Form->input('point', [
                    'type'        => 'number',
                    'error'       => false,
                    'required'    => false,
                    'placeholder' => 'Point (0 ~ 5)',
                    'label'       => false,
                    'div'         => false,
                    'min'    => 0,
                    'max'    => 5
                ]
            ); ?>
            <span class="form-error-msg" id="error-point"><?php echo $this->Form->error('Keyword.point'); ?></span>
            <span class="form-notes">Default value for point is 2.5</span>
            <span class="form-notes">Bad: 0 to <?php echo Configure::read('NEG_MAX'); ?></span>
            <span class="form-notes">Neutral: <?php echo Configure::read('NEG_MAX')+0.01; ?> to <?php echo Configure::read('POS_MIN')-0.01; ?> </span>
            <span class="form-notes">Good: <?php echo Configure::read('POS_MIN'); ?> to 5</span>
            <input type="submit" value="Submit">
            <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/index"; ?>')">Back to List</a>
<?php echo $this->Form->end(); ?>

</div>
