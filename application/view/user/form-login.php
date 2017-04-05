
<div class="col-md-4 col-md-offset-4">

    <?php if (!empty($message)) : ?>
            <div class="alert <?php echo 'alert-'. frontend_class($message['type']); ?>">
                <?php echo $message['content']; ?>
            </div>
    <?php endif; ?>

    <form action="/user/login" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="username" id="username" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <input type="submit" class="btn btn-default" value="Submit">
    </form>
</div>