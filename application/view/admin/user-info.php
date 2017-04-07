<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<div class="col-md-6 col-md-offset-3">
    <h2 class="text-uppercase"><?php echo $content['title']; ?></h2>
    <div>&nbsp;</div>
    <form action="/admin/create" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="email">Birthday</label>
            <input type="text" name="email" class="form-control" id="birthday">
        </div>
        <div class="form-group">
            <label for="email">Role</label>
            <select name="role" class="form-control">
                <option value="0" selected="selected">User</option>
                <option value="2">Manager</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Create" class="btn btn-info">
    </form>
</div>