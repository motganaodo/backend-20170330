<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<div class="col-md-6 col-md-offset-3">
    <h2 class="text-uppercase">List users</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                    foreach ($content as $key => $user):
                        $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" class="btn btn-info">Edit</a></td>
                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>