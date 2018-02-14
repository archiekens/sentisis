<div class="keywords view">
<h2><?php echo __('Keyword'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Word'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['word']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Point'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['point']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modififed'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['modififed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['deleted_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Keyword'), array('action' => 'edit', $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Keyword'), array('action' => 'delete', $keyword['Keyword']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $keyword['Keyword']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Keywords'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Keyword'), array('action' => 'add')); ?> </li>
	</ul>
</div>
