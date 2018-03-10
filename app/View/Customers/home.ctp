
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
            <h4 class="sidebar-item-header">Product Name</h4>
            <input type="text" id="product_name" name="data[Product][name]" placeholder="Search product name">
        </li>
        <li class="sidebar-item">
            <h4 class="sidebar-item-header">Brand</h4>
            <ul class="sidebar-item-options">
                <?php foreach ($brands as $brand): ?>
                <li class="sidebar-item-option">
                    <input type="checkbox" class="check-brand" data-brand-name="<?php echo $brand; ?>" id="<?php echo 'check-'.$brand; ?>">
                    <label for="<?php echo 'check-'.$brand; ?>"><?php echo $brand; ?></label>
                </li>
                <?php endforeach ?>
                <input type="hidden" name="data[Product][brand_array]" id="brand_array">
            </ul>
        </li>
        <li class="sidebar-item">
            <h4 class="sidebar-item-header">Rating</h4>
            <ul class="sidebar-item-options">
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="5" id="id10">
                    <label for="id10"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="4" id="id11">
                    <label for="id11"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-arrow-up"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="3" id="id12">
                    <label for="id12"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-arrow-up"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="2" id="id13">
                    <label for="id13"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-arrow-up"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="1" id="id14">
                    <label for="id14"><i class="fa fa-star"></i><i class="fa fa-arrow-up"></i></label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="0" id="id15" checked="true">
                    <label for="id15">Unrated</label>
                </li>
                <li class="sidebar-item-option">
                    <input type="radio" name="data[Product][rating]" value="null" id="id16" checked="true">
                    <label for="id16">Any Rating</label>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<?php echo $this->Form->end(); ?>
<div class="container-partial container-home">
    <div class="product-query">
        <h2 id="product-query-type">All Devices</h2>
        <span class="product-count" id="product_count"><?php echo $this->Paginator->counter('{:count} items found');?></span>
    </div>
    <div class="product-container" id="productContainer">
        <?php foreach ($products as $product) : ?>
            <div class="product" onclick="window.location.replace('<?php echo $this->webroot."products/view/".$product["Product"]["id"]; ?>')">
                <img class="product-image" src="<?php echo $this->webroot.($product['Product']['image'] !='' ? 'images/products/'.$product['Product']['image'] : 'img/product-default.jpg'); ?>" onerror="this.src = '<?php echo $this->webroot; ?>img/product-default.jpg'">
                <span class="product-name"><?php echo $product['Product']['name']; ?></span>
                <span class="product-brand"><?php echo $product['Product']['brand']; ?></span>
                <span class="product-rating">
                    <span class="product-rating-actual">
                        <?php for ($i = 0; $i <= $product['Product']['rating']; $i++) {
                            if ($product['Product']['rating'] - $i >= 1) {
                                echo '<i class="fa fa-star"></i>';
                            } elseif ($product['Product']['rating'] - $i > 0) {
                                echo '<i class="fa fa-star-half"></i>';
                            }
                        }?>
                    </span>
                    <span class="product-rating-background"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                </span>
                <button class="product-view">View</button>
            </div>
        <?php endforeach; ?>
    </div>
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

        $('.check-brand').change(function() {
            let brands = [];
            $('.check-brand').each(function() {
                if (this.checked) {
                    brands.push(this.dataset['brandName']);
                }
            });
            $('#brand_array').val(brands);
            page_number = 1;
            $('#productContainer').empty();
            $("#ProductHomeForm").submit();
        });

        $(document).delegate('[type=radio]', 'change ', function () {
            page_number = 1;
            $('#productContainer').empty();
            $("#ProductHomeForm").submit();
        });

        $(document).delegate('[id=device-type]', 'keyup change ', function () {
            page_number = 1;
            $('#productContainer').empty();
            $("#ProductHomeForm").submit();
        });

        $(document).delegate('[id=product_name]', 'keyup change ', function () {
            page_number = 1;
            $('#productContainer').empty();
            $("#ProductHomeForm").submit();
        });

        $("#ProductHomeForm").on('submit', function(e) {
            $.ajax({
                url: '<?php echo $this->webroot;?>customers/page_ajax?page='+page_number,
                method: 'POST',
                data: new FormData( this ),
                success: function (res) {
                    $('#productContainer').append(res)
                },
                processData: false,
                contentType: false
            }).then(function() {
                let type = null;
                if ($('#device-type').val() != "null") {
                    type = parseInt($('#device-type').val()) + 1;
                    $("#product-query-type")[0].innerText = $('#device-type')[0][type].innerText;
                } else {
                    $("#product-query-type")[0].innerText = 'All Devices';
                }
                $("#product_count")[0].innerText = $('#result_count'+page_number).val() + ' items found';
            });
            e.preventDefault();
            return false;
        });

        $(window).scroll(function() {
            if($(window).scrollTop() == $(document).height() - $(window).height()) {
                page_number++;
                $("#ProductHomeForm").submit();
            }
        });

    });
</script>