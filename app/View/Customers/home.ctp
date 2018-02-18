
<?php echo $this->Form->create('Product',['type' => 'GET']); ?>
<aside class="sidebar">
    <ul class="sidebar-items">
        <li class="sidebar-item">
            <h4 class="sidebar-item-header">Device Type</h4>
            <select id="device-type" name="data[Product][type]">
                <option value="null">All Devices</option>
                <?php foreach($product_types as $key => $value) : ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </li>
        <li class="sidebar-item">
            <h4 class="sidebar-item-header">Brand</h4>
            <ul class="sidebar-item-options">
                <?php foreach ($brands as $brand): ?>
                <li class="sidebar-item-option">
                    <input type="checkbox" id="<?php echo 'check-'.$brand; ?>">
                    <label for="<?php echo 'check-'.$brand; ?>"><?php echo $brand; ?></label>
                </li>
                <?php endforeach ?>
            </ul>
        </li>
        <li class="sidebar-item">
            <h4 class="sidebar-item-header">Rating</h4>
            <ul class="sidebar-item-options">
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" id="id10">
                    <label for="id10"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" id="id11">
                    <label for="id11"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" id="id12">
                    <label for="id12"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" id="id13">
                    <label for="id13"><i class="fa fa-star"></i> <i class="fa fa-star"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" id="id14">
                    <label for="id14"><i class="fa fa-star"></i></label>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<?php echo $this->Form->end(); ?>
<div class="container-partial container-home" id="productContainer">
    <div class="product-query">
        <h2 id="product-query-type">All Devices</h2>
        <span class="product-count"><?php echo $this->Paginator->counter('{:count} items');?></span>
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
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var page_number = 1;
        var parseQueryString = function(url) {
            var urlParams = {};
            url.replace(
                new RegExp("([^?=&]+)(=([^&]*))?", "g"),
                function($0, $1, $2, $3) {
                    urlParams[$1] = $3;
                }
            );
            return urlParams;
        }

        $(document).delegate('a', 'click',function(e){
            if ($(this).data('class') == 'page_ajax') {
                let page = parseQueryString($(this).attr('href'))['page'];
                page_number = page;
                $("#ProductHomeForm").submit();
                e.preventDefault();
            }
        });

        $(document).delegate('[id=device-type]', 'keyup change ', function () {
            $("#ProductHomeForm").submit();
        });

        $("#ProductHomeForm").on('submit', function(e) {
            $.ajax({
                url: '<?php echo $this->webroot;?>customers/page_ajax?page='+page_number,
                method: 'POST',
                data: new FormData( this ),
                success: function (res) {
                    $('#productContainer').empty().append(res)
                },
                processData: false,
                contentType: false
            }).then(function() {
                let type = null;
                if ($('#device-type').val() !== null) {
                    type = parseInt($('#device-type').val()) + 1;
                }
                $("#product-query-type")[0].innerText = $('#device-type')[0][type].innerText;
            });
            e.preventDefault();
            return false;
        });

        $("#clearBtn").on('click',function() {
            $.ajax({
                url: '/customers/page_ajax?page=1',
                method: 'POST',
                success: function (res) {
                    $('#productContainer').empty().append(res)
                },
            processData: false,
            contentType: false
            });
        });

    });
</script>