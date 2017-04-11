<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<?php
    $user = $content['user'];
    list($yyyy, $mm, $dd) = explode('/', $user['birthdate']);
    $birthdate = implode('/', array($dd, $mm, $yyyy));
?>


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

    <form action="/user/profile" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="username" class="form-control" value="<?php echo $user['name']; ?>">
        </div>
        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <div class="input-group date">
                <input type="text" name="birthdate" id="birthdate" class="form-control" value="<?php echo $birthdate; ?>">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <p><em><i>*If does not change password please leave below password fields blank</i></em></p>
        </div>
        <div class="form-group">
            <label for="password">Old password</label>
            <input type="password" name="old-password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">New password</label>
            <input type="password" name="new-password" class="form-control">
        </div>
        <div class="form-group">
            <label for="re-password">Confirm new password</label>
            <input type="password" name="re-password" class="form-control">
        </div>
        <input type="submit" value="Update" class="btn btn-info">
    </form>
</div>