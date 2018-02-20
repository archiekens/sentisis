<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users" id="customerContainer">
    <?php echo $this->Flash->render(); ?>
    <div class="container-query">
        <div class="main-query">
            <h2>All Customers</h2>
            <span class="product-count"><?php echo $this->Paginator->counter('Total {:count} items, displaying {:start} - {:end}');?></span>
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
                showPage();
                e.preventDefault();
            }
        });

        function showPage() {
            $.ajax({
                url: '<?php echo $this->webroot;?>SUCustomers/page_ajax?page='+page_number,
                method: 'POST',
                success: function (res) {
                    $('#customerContainer').empty().append(res)
                },
                processData: false,
                contentType: false
            });
        };

    });
</script>