<header class="header">
    <ul class="header-items">
        <li class="header-item header-logo"><a href="<?php echo $this->webroot; ?>customers/home"><img src="<?php echo $this->webroot; ?>/img/logo-small.png"></a></li>
        <?php if (isset($auth)) : ?>
        <li class="header-item header-greeting">Hello, user</li>
        <?php endif; ?>
        <?php if (isset($auth)) : ?>
        <li class="header-item header-logout">Logout</li>
        <?php endif; ?>
    </ul>
</header>