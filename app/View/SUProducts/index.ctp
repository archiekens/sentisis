<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <table class="table">
        <tr class="table-row">
            <th class="table-header table-cell">ID</th>
            <th class="table-header table-cell">Name</th>
            <th class="table-header table-cell">Description</th>
            <th class="table-header table-cell"></th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr class="table-row">
            <td class="table-cell"><?php echo $product['Product']['id']; ?></td>
            <td class="table-cell"><?php echo $product['Product']['name']; ?></td>
            <td class="table-cell"><?php echo $product['Product']['description']; ?></td>
            <td class="table-cell"><a href="<?php echo $this->webroot.'SUProducts/edit/'.$product['Product']['id']; ?>">Edit</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>