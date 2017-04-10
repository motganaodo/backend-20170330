<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<div class="col-md-4 col-md-offset-4">
    <h1 class="text-uppercase">Login</h1>
    <div>&nbsp;</div>

    <?php if (!empty($content['message'])) : ?>
            <div class="alert <?php echo 'alert-'. frontend_class($content['message']['type']); ?>">
                <?php echo $content['message']['content']; ?>
            </div>
    <?php endif; ?>

    <form action="/user/login" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="username" id="username" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <input type="submit" class="btn btn-info" value="Submit">
    </form>
</div>