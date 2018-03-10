<?php foreach ($products as $product) : ?>
    <div class="product" onclick="window.location.replace('<?php echo $this->webroot."products/view/".$product["Product"]["id"]; ?>')">
        <img class="product-image" src="<?php echo $this->webroot.($product['Product']['image'] !='' ? 'images/products/'.$product['Product']['image'] : 'img/product-default.jpg'); ?>" onerror="this.src = '<?php echo $this->webroot; ?>img/product-default.jpg'">
        <span class="product-name"><?php echo $product['Product']['name']; ?></span>
        <span class="product-brand"><?php echo $product['Product']['brand']; ?></span>
        <button class="product-view">View</button>
    </div>
<?php endforeach; ?>
<input type="hidden" id="result_count<?php echo $page; ?>" value="<?php echo $count; ?>">