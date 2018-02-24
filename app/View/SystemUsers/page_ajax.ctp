<?php echo $this->Flash->render(); ?>
<div class="container-query">
    <div class="main-query">
        <h2>All System Users</h2>
        <span class="product-count"><?php echo $this->Paginator->counter('Total {:count} items, displaying {:start} - {:end}');?></span>
    </div>
    <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."system_users/add"; ?>')">Add System User</button>
</div>
<?php if (count($system_users) > 0) : ?>
<table class="table">
    <tr class="table-row">
        <th class="table-header table-cell">ID</th>
        <th class="table-header table-cell">Username</th>
        <th class="table-header table-cell"></th>
        <th class="table-header table-cell"></th>
    </tr>
    <?php foreach ($system_users as $system_user) : ?>
    <tr class="table-row">
        <td class="table-cell"><?php echo $system_user['SystemUser']['id']; ?></td>
        <td class="table-cell"><?php echo $system_user['SystemUser']['username']; ?></td>
        <td class="table-cell"><a href="<?php echo $this->webroot.'system_users/edit/'.$system_user['SystemUser']['id']; ?>">Edit</a></td>
        <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $system_user['SystemUser']['id']; ?>')">Delete</span></td>
    </tr>
    <?php endforeach; ?>
</table>
<ul class="pagination pull-right pagination-sort__pages">
    <?php
        echo $this->Paginator->first(__('first page'), array('tag' => 'li', 'data-class' => 'page_ajax'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
        if ($this->Paginator->hasPrev()) {
            echo $this->Paginator->prev(__('prev'), array('tag' => 'li', 'data-class' => 'page_ajax'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
        }
        echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li' , 'data-class' => 'page_ajax'));
        if ($this->Paginator->hasNext()) {
            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled', 'data-class' => 'page_ajax'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
        }
        echo $this->Paginator->last(__('last'), array('tag' => 'li', 'data-class' => 'page_ajax'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    ?>
</ul>
<?php else : ?>
    <span>No system users yet</span>
<?php endif; ?>