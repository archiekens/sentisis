<div class="product-query">
        <h2 id="product-query-type">All Devices</h2>
        <span class="product-count"><?php echo $this->Paginator->counter('{:count} items');?></span>
        <?php if (isset($brands)) : ?>
        <div class="product-query-query"><strong class="product-query-title">Brands: </strong>
            <?php foreach ($brands as $brand) : ?>
                <span class="product-query-item"><?php echo $brand; ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (isset($rating)) : ?>
        <div class="product-query-query"><strong class="product-query-title">Rating: </strong>
            <span class="product-query-item">
            <?php for ($i = 0; $i < $rating; $i++) : ?>
                <i class="fa fa-star"></i>
            <?php endfor; ?>
            <?php if ($rating == 0) : echo 'Unrated'; ?>
            <?php elseif ($rating != 5) : ?>
                <i class="fa fa-arrow-up"></i>
            <?php endif; ?>
            </span>
        </div>
        <?php endif; ?>
    </div>
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
    <div class="product-container">
        <?php foreach ($products as $product) : ?>
            <div class="product" onclick="window.location.replace('<?php echo $this->webroot."products/view/".$product["Product"]["id"]; ?>')">
                <img class="product-image" src="<?php echo $this->webroot.($product['Product']['image'] !='' ? 'images/products/'.$product['Product']['image'] : 'img/product-default.jpg'); ?>" onerror="this.src = '<?php echo $this->webroot; ?>img/product-default.jpg'">
                <span class="product-name"><?php echo $product['Product']['name']; ?></span>
                <span class="product-brand"><?php echo $product['Product']['brand']; ?></span>
                <button class="product-view">View</button>
            </div>
        <?php endforeach; ?>
    </div>
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