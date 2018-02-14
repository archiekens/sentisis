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
            <select name="data[Keyword][type]">
                <option value="0">Neutral</option>
                <option value="1">Good</option>
                <option value="2">Bad</option>
            </select>
            <input type="submit" value="Submit">
            <a class="back-to-list-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/index"; ?>')">Back to List</a>
<?php echo $this->Form->end(); ?>

</div>
