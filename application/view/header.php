<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<header class="row">
    <div class=" col-md-4 text-uppercase text-center">
        <h2>Tien - Back End</h2>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <?php if (Authentication::is_login()): ?>
            <p>&nbsp;</p>
            <p>Welcome: <?php echo get_user_name(); ?></p>
            <p><a href="/user/profile">Profile</a>&nbsp;&nbsp;&nbsp;<a href="/user/logout">Logout</a></p>
        <?php else: ?>
            <p>&nbsp;</p>
            <a href="/user/login">Login</a>
            &nbsp;
            <a href="/user/signup">Sign up</a>
        <?php endif; ?>
    </div>
</header>