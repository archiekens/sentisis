<?php echo $this->element('sidebar'); ?>
<div class="container-partial container-home">
    <div class="product-query">
        <h2>All Devices</h2>
        <span class="product-count"><?php echo count($products); ?> items</span>
    </div>
    <div class="product-container">
        <?php foreach ($products as $product) : ?>
            <div class="product" onclick="window.location.replace('<?php echo $this->webroot."products/view/".$product["Product"]["id"]; ?>')">
                <img class="product-image" src="<?php echo $this->webroot.($product['Product']['image'] !='' ? 'images/products/'.$product['Product']['image'] : 'img/product-default.jpg'); ?>" onerror="this.src = '<?php echo $this->webroot; ?>img/product-default.jpg'">
                <span class="product-name"><?php echo $product['Product']['name']; ?></span>
                <span class="product-rating"></span>
                <button class="product-view">View</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>