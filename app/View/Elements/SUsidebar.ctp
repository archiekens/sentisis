<aside class="sidebar sidebar-system-user">
    <ul class="sidebar-items">
        <li class="sidebar-item" id="system_users-dashboard" onclick="window.location.replace('<?php echo $this->webroot."system_users/dashboard"; ?>')">
            <i class="sidebar-item-icon fa fa-chart-pie"></i><span class="sidebar-item-name">Dashboard</span>
        </li>
        <li class="sidebar-item" id="SUProducts-index" onclick="window.location.replace('<?php echo $this->webroot."SUProducts/index"; ?>')">
            <i class="sidebar-item-icon fa fa-mobile"></i><span class="sidebar-item-name">Products</span>
        </li>
        <li class="sidebar-item" id="keywords-index" onclick="window.location.replace('<?php echo $this->webroot."keywords/index"; ?>')">
            <i class="sidebar-item-icon fa fa-key"></i><span class="sidebar-item-name">Keywords</span>
        </li>
        <li class="sidebar-item" id="SUCustomers-index" onclick="window.location.replace('<?php echo $this->webroot."SUCustomers/index"; ?>')">
            <i class="sidebar-item-icon fa fa-users"></i><span class="sidebar-item-name">Customers</span>
        </li>
    </ul>
</aside>

<script type="text/javascript">
    var controller = window.location.pathname.split('/')[2];
    var action = window.location.pathname.split('/')[3];
    $('#' + controller + '-' + action).toggleClass('active');
</script>