<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <?php echo $this->Flash->render() ?>
    <div class="container-query">
        <div class="main-query">
            <h2>All Products</h2>
            <span class="product-count"><?php echo count($products); ?> items</span>
        </div>
        <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."SUProducts/add"; ?>')">Add Product</button>
    </div>
    <?php if (count($products) > 0) : ?>
    <table class="table">
        <tr class="table-row">
            <th class="table-header table-cell">ID</th>
            <th class="table-header table-cell">Name</th>
            <th class="table-header table-cell">Description</th>
            <th class="table-header table-cell"></th>
            <th class="table-header table-cell"></th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr class="table-row">
            <td class="table-cell"><?php echo $product['Product']['id']; ?></td>
            <td class="table-cell"><?php echo $product['Product']['name']; ?></td>
            <td class="table-cell"><?php echo $product['Product']['description']; ?></td>
            <td class="table-cell"><a href="<?php echo $this->webroot.'SUProducts/edit/'.$product['Product']['id']; ?>">Edit</a></td>
            <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $product['Product']['id']; ?>')">Delete</span></td>        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <span>No products yet</span>
    <?php endif; ?>
</div>
<script type="text/javascript">
    function deleteThis(id) {
        if (confirm('Confirm delete?')) {
            $.ajax({
                method: 'POST',
                url: "<?php echo $this->webroot.'SUProducts/delete/';?>"+id
            }).done(function() {
                location.reload();
            });
        }
    }
</script>