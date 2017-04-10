<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<div class="col-md-6 col-md-offset-3">
    <h2 class="text-uppercase"><?php echo $content['title']; ?></h2>
    <div>&nbsp;</div>

    <form action="/admin/edit" method="post" accept-charset="utf-8">
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