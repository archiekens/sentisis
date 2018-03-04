<div class="container-query">
    <div class="main-query">
        <h2>All Products</h2>
        <span class="product-count"><?php echo $this->Paginator->counter('Total {:count} items, displaying {:start} - {:end}');?></span>
    </div>
    <div class="search-query">
        <input type="text" id="product_name" placeholder="Search product name" value="<?php echo isset($product_name) ? $product_name : ''; ?>">
        <button id="search-submit" class="search-button"><i class="fa fa-search"></i></button>
    </div>
    <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."SUProducts/add"; ?>')">Add Product</button>
</div>
<?php if (count($products) > 0) : ?>
<table class="table">
    <tr class="table-row">
        <th class="table-header table-cell">ID</th>
        <th class="table-header table-cell">Name</th>
        <th class="table-header table-cell">Brand</th>
        <th class="table-header table-cell">Type</th>
        <th class="table-header table-cell">Description</th>
        <th class="table-header table-cell"></th>
        <th class="table-header table-cell"></th>
    </tr>
    <?php foreach ($products as $product) : ?>
    <tr class="table-row">
        <td class="table-cell"><?php echo $product['Product']['id']; ?></td>
        <td class="table-cell"><?php echo $product['Product']['name']; ?></td>
        <td class="table-cell"><?php echo $product_types[$product['Product']['type']]; ?></td>
        <td class="table-cell"><?php echo $product['Product']['brand']; ?></td>
        <td class="table-cell"><?php echo $product['Product']['description']; ?></td>
        <td class="table-cell"><a href="<?php echo $this->webroot.'SUProducts/edit/'.$product['Product']['id']; ?>">Edit</a></td>
        <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $product['Product']['id']; ?>')">Delete</span></td>        </tr>
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
    <span>No products yet</span>
<?php endif; ?>