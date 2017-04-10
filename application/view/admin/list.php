<?php
defined('DIR_BASE') OR exit('No direct script access allowed');

$paged = $content['paged']*1;
$limit = $content['limit'];
$total = $content['total'];

?>



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
                $count = ($paged - 1) * $limit;
                foreach ($content['users'] as $key => $user):
                    $count++;
                ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['birthdate']; ?></td>
                        <td><a href="<?php echo '/admin/edit/'. $user['id']; ?>" class="btn btn-info">Edit</a></td>
                        <td><a href="<?php echo '/admin/delete/'. $user['id']; ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($limit < $total): ?>
        <nav aria-label="Page navigation" class="text-center">
            <ul class="pagination">
                <?php if ($count > $limit): ?>
                    <li>
                        <a href="<?php echo '/admin/index/'. ($paged - 1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if (ceil($total / $limit) >= 3): ?>
                    <?php for ($i = 1; $i <= ceil($total / $limit); $i++) { ?>
                        <li><a href="<?php echo '/admin/index/'. $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                <?php endif; ?>
                
                <?php if ($count < $total): ?>
                    <li>
                        <a href="<?php echo '/admin/index/'. ($paged + 1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>