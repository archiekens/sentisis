<link rel="stylesheet" type="text/css" href="style.css">
<div class="container-home">
	<div class="product-container">
		<?php for ($i=0; $i < 15; $i++) : ?>
			<div class="product-item">
				<div class="product-item-image"></div>
				<div class="product-item-name">Sample Product</div>
				<div class="product-item-rating"></div>
				<button class="product-item-view-btn">View</button>
			</div>
		<?php endfor; ?>
	</div>
</div>