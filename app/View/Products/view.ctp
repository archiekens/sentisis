<div class="container-product-view-main">
    <?php echo $this->Flash->render(); ?>
    <div class="container-product-view-sub">
        <h2 class="container-product-header"><?php echo $product['Product']['name']; ?></h2>
        <div class="view-product-details">
            <img class="view-product-image" src="<?php echo $this->webroot.'images/products/'.$product['Product']['id'].'/'.$product['Product']['image']; ?>">
            <div class="view-product-info">
                <h4 class="view-product-info-header">Product Information</h4>
                <p class="view-product-description"><?php echo $product['Product']['description']; ?></p>
            </div>
            <div class="view-product-rating-container">
                <h4 class="view-product-info-header">Average Product Rating</h4>
                <span class="view-product-rating-image"></span>
                <span class="view-product-rating-score">6.9 out of 5</span>
            </div>
        </div>
    </div>
    <div class="container-comments">
        <h2 class="container-product-header">Comments about this product</h2>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <div class="comment-upper">
                    <span class="comment-customer">By <?php echo $comment['Customer']['name']; ?></span>  
                    <span class="comment-date"><?php echo $comment['Comment']['created']; ?></span>
                </div>
                <p class="comment-content"><?php echo $comment['Comment']['content']; ?></p>
            </div>
        <?php endforeach; ?>
        <div class="comment-add">
            <?php echo $this->Form->create('Comment', ['url' => '../comments/add', 'method' => 'POST']); ?>
            <input type="hidden" name="data[Comment][product_id]" value="<?php echo $product['Product']['id']; ?>">
            <input type="hidden" name="data[Comment][customer_id]" value="<?php echo isset($this->Auth->user) ? '1' : '1'; ?>">
            <textarea class="comment-add-content" name="data[Comment][content]" maxlength="255"></textarea>
            <input type="submit" class="comment-add-submit" value="Submit">
            <?php echo $this->Form->end(); ?>
        </div>
        <?php if (count($comments) == 0 ) : ?>
            <span class="comment-empty-msg">No comments for this product yet.</span>
        <?php endif; ?>
    </div>
</div>
