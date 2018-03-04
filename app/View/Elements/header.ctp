<?php if (AuthComponent::user('id') !== null) : ?>
<header class="header">
    <ul class="header-items">
        <li class="header-item header-logo"><a href="<?php echo $this->webroot; ?><?php echo $page_type == 1 ? 'system_users/dashboard' : 'customers/home';?>"><img src="<?php echo $this->webroot; ?>img/logo-small.png"></a></li>
        <?php if (AuthComponent::user('id') !== null) : ?>
        <li class="header-item header-greeting">Hello, <?php echo $page_type == 1 ? AuthComponent::user('username') : (AuthComponent::user('name') != '' ? AuthComponent::user('name') : 'Guest'); ?></li>
        <?php endif; ?>
        <li class="header-item header-right">
        	<?php if ($page_type == 2): ?>
        	<a class="header-right-link" href="<?php echo $this->webroot.'pages/about';?>">About Us<i class="fa fa-info-circle"></i></a>
	        <?php endif; ?>
	        <?php if (AuthComponent::user('id') !== null) : ?>
	        <a class="header-right-link" href="<?php echo $this->webroot;?><?php echo $page_type == 1 ? 'system_users/logout' : 'customers/logout';?>">Logout<i class="fa fa-share-square"></i></a>
	        <?php endif; ?>
	    </li>
    </ul>
</header>
<?php endif; ?>