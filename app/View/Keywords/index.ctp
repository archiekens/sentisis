<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <div class="container-query">
        <h2>All Devices</h2>
        <span class="product-count"><?php echo count($keywords); ?> items</span>
        <button>Add Keyword</button>
    </div>
    <?php if (count($keywords) > 0) : ?>
    <table class="table">
        <tr class="table-row">
            <th class="table-header table-cell">ID</th>
            <th class="table-header table-cell">Word</th>
            <th class="table-header table-cell">Point</th>
            <th class="table-header table-cell"></th>
        </tr>
        <?php foreach ($keywords as $keyword) : ?>
        <tr class="table-row">
            <td class="table-cell"><?php echo $keyword['Keyword']['id']; ?></td>
            <td class="table-cell"><?php echo $keyword['Keyword']['word']; ?></td>
            <td class="table-cell"><?php echo $keyword['Keyword']['point']; ?></td>
            <td class="table-cell"><a href="<?php echo $this->webroot.'keywords/edit/'.$keyword['Keyword']['id']; ?>">Edit</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <span>No keywords yet</span>
    <?php endif; ?>
</div>
</div>