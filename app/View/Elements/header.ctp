<header class="header">
    <ul class="header-items">
        <li class="header-item header-logo"><a href="<?php echo $this->webroot; ?>customers/home"><img src="<?php echo $this->webroot; ?>/img/logo-small.png"></a></li>
        <?php if (AuthComponent::user('id') !== null) : ?>
        <li class="header-item header-greeting">Hello, <?php echo AuthComponent::user('name'); ?></li>
        <?php endif; ?>
        <?php if (AuthComponent::user('id') !== null) : ?>
        <li class="header-item header-logout"><a href="<?php echo $this->webroot;?>customers/logout">Logout</a></li>
        <?php endif; ?>
    </ul>
</header>