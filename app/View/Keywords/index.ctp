<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <?php echo $this->Flash->render(); ?>
    <div class="container-query">
        <div class="main-query">
            <h2>All Keywords</h2>
            <span class="product-count"><?php echo count($keywords); ?> items</span>
        </div>
        <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/add"; ?>')">Add Keyword</button>
    </div>
    <?php if (count($keywords) > 0) : ?>
    <table class="table">
        <tr class="table-row">
            <th class="table-header table-cell">ID</th>
            <th class="table-header table-cell">Word</th>
            <th class="table-header table-cell">Type</th>
            <th class="table-header table-cell"></th>
            <th class="table-header table-cell"></th>
        </tr>
        <?php foreach ($keywords as $keyword) : ?>
        <tr class="table-row">
            <td class="table-cell"><?php echo $keyword['Keyword']['id']; ?></td>
            <td class="table-cell"><?php echo $keyword['Keyword']['word']; ?></td>
            <td class="table-cell"><?php echo $keyword['Keyword']['type'] == 0 ? 'Neutral' : ($keyword['Keyword']['type'] == 1 ? 'Good' : 'Bad'); ?></td>
            <td class="table-cell"><a href="<?php echo $this->webroot.'keywords/edit/'.$keyword['Keyword']['id']; ?>">Edit</a></td>
            <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $keyword['Keyword']['id']; ?>')">Delete</span></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <span>No keywords yet</span>
    <?php endif; ?>
</div>
<script type="text/javascript">
    function deleteThis(id) {
        if (confirm('Confirm delete?')) {
            $.ajax({
                method: 'POST',
                url: "<?php echo $this->webroot.'keywords/delete/';?>"+id
            }).done(function() {
                location.reload();
            });
        }
    }
</script>