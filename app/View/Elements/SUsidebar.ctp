<aside class="sidebar sidebar-system-user">
    <ul class="sidebar-items">
        <li class="sidebar-item" id="system_users-dashboard" onclick="window.location.replace('<?php echo $this->webroot."system_users/dashboard"; ?>')">
            Dashboard
        </li>
        <li class="sidebar-item" id="SUProducts-index" onclick="window.location.replace('<?php echo $this->webroot."SUProducts/index"; ?>')">
            Products
        </li>
        <li class="sidebar-item" id="keywords-index" onclick="window.location.replace('<?php echo $this->webroot."keywords/index"; ?>')">
            Keywords
        </li>
    </ul>
</aside>

<script type="text/javascript">
    var controller = window.location.pathname.split('/')[2];
    var action = window.location.pathname.split('/')[3];
    $('#' + controller + '-' + action).toggleClass('active');
</script>