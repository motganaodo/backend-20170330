<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<?php include(DIR_VIEW . '/head.php'); ?>

<div class="container-fluid">

    <?php include(DIR_VIEW . '/header.php'); ?>

    <div class="row main-content">
        <?php if (Authentication::is_login()): ?>
            <?php
                $back_url = '/home';
                if (Authentication::is_admin()) {
                    $back_url = '/admin';
                }
            ?>
            <div class="col-md-8 col-md-offset-2">
                <ol class="breadcrumb">
                    <li class="active"><a href="<?php echo $back_url; ?>">Home</a></li>
                </ol>
            </div>
        <?php endif; ?>

        <?php
        // $dir_file from class View
        if (!empty($dir_file)) {
            include(DIR_VIEW . $dir_file);
        }else{
            include(DIR_VIEW . '/content.php');
        }
        ?>
    </div>
</div><!-- .container-fluid -->

<?php include(DIR_VIEW . '/footer.php'); ?>