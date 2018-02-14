<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <?php echo $this->Flash->render(); ?>
    <div class="container-query">
        <div class="main-query">
            <h2>All Customers</h2>
            <span class="product-count"><?php echo count($customers); ?> items</span>
        </div>
        <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."SUCustomers/add"; ?>')">Add Customer</button>
    </div>
    <?php if (count($customers) > 0) : ?>
    <table class="table">
        <tr class="table-row">
            <th class="table-header table-cell">ID</th>
            <th class="table-header table-cell">Name</th>
            <th class="table-header table-cell">Email</th>
            <th class="table-header table-cell"></th>
            <th class="table-header table-cell"></th>
        </tr>
        <?php foreach ($customers as $customer) : ?>
        <tr class="table-row">
            <td class="table-cell"><?php echo $customer['Customer']['id']; ?></td>
            <td class="table-cell"><?php echo $customer['Customer']['name']; ?></td>
            <td class="table-cell"><?php echo $customer['Customer']['email']; ?></td>
            <td class="table-cell"><a href="<?php echo $this->webroot.'SUCustomers/edit/'.$customer['Customer']['id']; ?>">Edit</a></td>
            <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $customer['Customer']['id']; ?>')">Delete</span></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <span>No customers yet</span>
    <?php endif; ?>
</div>
<script type="text/javascript">
    function deleteThis(id) {
        if (confirm('Confirm delete?')) {
            $.ajax({
                method: 'POST',
                url: "<?php echo $this->webroot.'SUCustomers/delete/';?>"+id
            }).done(function() {
                location.reload();
            });
        }
    }
</script>