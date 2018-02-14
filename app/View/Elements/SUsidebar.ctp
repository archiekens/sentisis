<aside class="sidebar sidebar-system-user">
    <ul class="sidebar-items">
        <li class="sidebar-item" id="system_users-dashboard" onclick="window.location.replace('<?php echo $this->webroot."system_users/dashboard"; ?>')">
            <i class="fa fa-chart-pie"></i>Dashboard
        </li>
        <li class="sidebar-item" id="SUProducts-index" onclick="window.location.replace('<?php echo $this->webroot."SUProducts/index"; ?>')">
            <i class="fa fa-mobile"></i>Products
        </li>
        <li class="sidebar-item" id="keywords-index" onclick="window.location.replace('<?php echo $this->webroot."keywords/index"; ?>')">
            <i class="fa fa-key"></i>Keywords
        </li>
        <li class="sidebar-item" id="SUCustomers-index" onclick="window.location.replace('<?php echo $this->webroot."SUCustomers/index"; ?>')">
            <i class="fa fa-users"></i>Customers
        </li>
    </ul>
</aside>

<script type="text/javascript">
    var controller = window.location.pathname.split('/')[2];
    var action = window.location.pathname.split('/')[3];
    $('#' + controller + '-' + action).toggleClass('active');
</script>