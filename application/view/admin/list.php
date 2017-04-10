<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<div class="col-md-6 col-md-offset-3">
    <h2 class="text-uppercase">List users</h2>
    <?php if (!empty($content['message']['content'])) : ?>
        <div class="alert <?php echo 'alert-'. frontend_class($content['message']['type']); ?>">
            <?php foreach ($content['message']['content'] as $msg): ?>
                <p><?php echo $msg; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div>&nbsp;</div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Username</th>
                    <th class="col-md-3">Email</th>
                    <th class="col-md-3">Birthdate</th>
                    <th class="col-md-1">&nbsp;</th>
                    <th class="col-md-1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($content['users'] as $key => $user):
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['birthdate']; ?></td>
                        <td><a href="#" class="btn btn-info">Edit</a></td>
                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>