<div class="container-query">
    <div class="main-query">
        <h2>All Customers</h2>
        <span class="product-count"><?php echo $this->Paginator->counter('Total {:count} items, displaying {:start} - {:end}');?></span>
    </div>
    <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."SUCustomers/add"; ?>')">Add Customer</button>
</div>
<?php if (count($customers) > 0) : ?>
<table class="table">
    <tr class="table-row">
        <th class="table-header table-cell">ID</th>
        <th class="table-header table-cell">Name</th>
        <th class="table-header table-cell">Email</th>
        <th class="table-header table-cell"></th>
        <th class="table-header table-cell"></th>
    </tr>
    <?php foreach ($customers as $customer) : ?>
    <tr class="table-row">
        <td class="table-cell"><?php echo $customer['Customer']['id']; ?></td>
        <td class="table-cell"><?php echo $customer['Customer']['name']; ?></td>
        <td class="table-cell"><?php echo $customer['Customer']['email']; ?></td>
        <td class="table-cell"><a href="<?php echo $this->webroot.'SUCustomers/edit/'.$customer['Customer']['id']; ?>">Edit</a></td>
        <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $customer['Customer']['id']; ?>')">Delete</span></td>
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
    <span>No customers yet</span>
<?php endif; ?>