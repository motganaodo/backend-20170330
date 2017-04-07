<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<div class="col-md-4 col-md-offset-4">
    <h1 class="text-uppercase"><?php echo $content['title']; ?></h1>
    <div>&nbsp;</div>

    <?php if (!empty($content['message']['content'])) : ?>
            <div class="alert <?php echo 'alert-'. frontend_class($content['message']['type']); ?>">
                <?php foreach ($content['message']['content'] as $msg): ?>
                    <p><?php echo $msg; ?></p>
                <?php endforeach; ?>
            </div>
    <?php endif; ?>

    <form action="/user/signup" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <div class="input-group date">
                <input type="text" name="birthdate" id="birthdate" class="form-control">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="re-password">Re enter Password</label>
            <input type="password" name="re-password" id="re-password" class="form-control">
        </div>
        <input type="submit" value="Signup" class="btn btn-info">
    </form>
</div>