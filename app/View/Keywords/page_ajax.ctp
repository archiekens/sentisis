    <?php echo $this->Flash->render(); ?>
    <div class="container-query">
        <div class="main-query">
            <h2>All Keywords</h2>
            <span class="product-count"><?php echo count($keywords); ?> items</span>
        </div>
        <div>
            <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/add"; ?>')">Add Keyword</button>
            <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/download_csv"; ?>')">Download CSV</button>
            <button class="list-add-button" onclick="window.location.replace('<?php echo $this->webroot."keywords/upload_csv"; ?>')">Upload CSV</button>
        </div>
    </div>
    <?php if (count($keywords) > 0) : ?>
    <table class="table">
        <tr class="table-row">
            <th class="table-header table-cell">Word</th>
            <th class="table-header table-cell">Point</th>
            <th class="table-header table-cell"></th>
            <th class="table-header table-cell"></th>
        </tr>
        <?php foreach ($keywords as $keyword) : ?>
        <tr class="table-row">
            <td class="table-cell"><?php echo $keyword['Keyword']['word']; ?></td>
            <td class="table-cell"><?php echo $keyword['Keyword']['point']; ?></td>
            <td class="table-cell"><a href="<?php echo $this->webroot.'keywords/edit/'.$keyword['Keyword']['id']; ?>">Edit</a></td>
            <td class="table-cell"><span class="delete-link" onclick="deleteThis('<?php echo $keyword['Keyword']['id']; ?>')">Delete</span></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <span>No keywords yet</span>
    <?php endif; ?>