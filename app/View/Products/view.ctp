<div class="modal-edit-comment popup">
    <i class="fa fa-times modal-close-button" onclick="toggleModal(false)"></i>
    <h2 class="modal-header">Edit your comment</h2>
    <input type="hidden" id="modal-edit-id" value="">
    <textarea class="comment-add-content" id="modal-edit-content" maxlength="255"></textarea>
    <span class="form-error-msg" id="error-content" style="display: none;">Comment cannot be empty.</span>
    <input type="submit" class="comment-add-submit" value="Update" id="modal-edit-submit" onclick="updateComment()">
</div>
<div class="blocker" onclick="toggleModal(false)"></div>
<div class="container-product-view-main">
    <?php echo $this->Flash->render(); ?>
    <div class="container-product-view-sub">
        <h2 class="container-product-header"><?php echo $product['Product']['name']; ?></h2>
        <div class="view-product-details">
            <img class="view-product-image" src="<?php echo $this->webroot.'images/products/'.$product['Product']['image']; ?>" onerror="this.src = '<?php echo $this->webroot; ?>img/product-default.jpg'">
            <div class="view-product-info">
                <h4 class="view-product-info-header">Product Information</h4>
                <p class="view-product-type"><strong>Type : </strong><?php echo $product_types[$product['Product']['type']]; ?></p>
                <p class="view-product-brand"><strong>Brand : </strong><?php echo $product['Product']['brand']; ?></p>
                <p class="view-product-description"><strong>Description :</strong><?php echo $product['Product']['description']; ?></p>
            </div>
            <div class="view-product-rating-container">
                <h4 class="view-product-info-header">Average Product Rating</h4>
                <span class="view-product-rating-image"></span>
                <span class="view-product-rating-score"><?php echo round($product['Product']['rating'],2); ?> out of 5</span>
                <span class="view-product-rating-count">From <?php echo (count($comments)); ?> customer reviews.</span>
                <a href="<?php echo $this->webroot;?>/customers/home" class="back-to-list-button view-back-button"><i class="fa fa-home"></i>Back to Home</a>
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
                <div class="comment-lower">
                    <div class="comment-category">
                        <?php if ($comment['Comment']['category'] == 'pos') : ?>
                            <i class="fa fa-thumbs-up"></i>
                        <?php elseif ($comment['Comment']['category'] == 'neg') : ?>
                            <i class="fa fa-thumbs-down"></i>
                        <?php else : ?>
                            <i class="fa fa-circle"></i>
                        <?php endif; ?>
                    </div>
                    <p class="comment-content"><?php echo $comment['Comment']['content']; ?></p>
                    <?php if (AuthComponent::user('id') == $comment['Customer']['id']) : ?>
                    <div class="comment-options-container" data-id="<?php echo $comment['Comment']['id']; ?>" data-content="<?php echo $comment['Comment']['content']; ?>">
                        <i class="fa fa-edit" onclick="toggleModal(true, this)"></i>
                        <i class="fa fa-trash-alt" onclick="deleteThis('<?php echo $comment['Comment']['id']; ?>')"></i>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="comment-add">
            <?php echo $this->Form->create('Comment', ['url' => '../comments/add', 'method' => 'POST']); ?>
            <input type="hidden" name="data[Comment][product_id]" value="<?php echo $product['Product']['id']; ?>">
            <input type="hidden" name="data[Comment][customer_id]" value="<?php echo AuthComponent::user('id'); ?>">
            <textarea id="comment-add-content" class="comment-add-content" name="data[Comment][content]" maxlength="255"></textarea>
            <span class="form-error-msg" id="error-add-content" style="display: none;">Comment cannot be empty.</span>
            <input type="submit" class="comment-add-submit" value="Submit">
            <?php echo $this->Form->end(); ?>
        </div>
        <?php if (count($comments) == 0 ) : ?>
            <span class="comment-empty-msg">No comments for this product yet.</span>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var rating = <?php echo $product['Product']['rating']; ?>;
        var color_stop = (rating / 5)*100;
        $('.view-product-rating-image').css({
            "background":
                "url('<?php echo $this->webroot;?>img/rating-small.png'), " + 
                "linear-gradient(90deg, #1A4442 0%, #1A4442 "+color_stop+"%,rgba(0,0,0,0) "+color_stop+"%)",
                
            "background-size" : "cover",
            "background-repeat" : "no-repeat",
            "background-blend-mode" : "color-dodge",
        });
    });

    $("#CommentViewForm").on('submit', function(e) {
        $('#error-add-content').css('display', 'none');
        if ($('#comment-add-content').val() != '') {
            $.ajax({
                url: '<?php echo $this->webroot;?>comments/add',
                method: 'POST',
                data: new FormData( this ),
                success: function (res) {
                  location.reload();
                },
                processData: false,
                contentType: false
              });
        } else {
            $('#error-add-content').css('display', 'block');
        }
        e.preventDefault();
        return false;
  });

    var product_id = <?php echo $product['Product']['id']; ?>;

    function deleteThis(id) {
        if (confirm('Confirm delete?')) {
            $.ajax({
                method: 'POST',
                url: '<?php echo $this->webroot;?>comments/delete?id='+id,
                data: {
                    id,
                    product_id
                }
            }).done(function() {
                location.reload();
            });
        }
    }

    function toggleModal(condition, obj) {
        if (condition == true) {
            $('#modal-edit-content').val($(obj)[0].parentNode.dataset['content']);
            $('#modal-edit-id').val($(obj)[0].parentNode.dataset['id']);
        }
        $('.modal-edit-comment').toggleClass('show');
        $('.blocker').toggleClass('show');
        $('#error-content').css('display', 'none');
    }

    function updateComment() {
        $('#error-content').css('display', 'none');
        let content = $('#modal-edit-content').val();
        let id = $('#modal-edit-id').val();

        if (content != null && content != '') {
            $.ajax({
                url: '<?php echo $this->webroot;?>comments/edit?id='+$('#modal-edit-id').val(),
                method: 'POST',
                data:{
                    id,
                    product_id,
                    content
                }
            }).then(function() {
                location.reload();
            });
        } else {
            $('#error-content').css('display', 'block');
        }
    }
</script>
