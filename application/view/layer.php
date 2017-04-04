<?php defined('DIR_BASE') OR exit('No direct script access allowed'); ?>

<?php include(DIR_VIEW . '/header.php'); ?>

<div class="container-fluid">
    <header class="row">
        <div class=" col-md-4 text-uppercase text-center">
            <h2>Tien - Back End</h2>
        </div>
    </header>
    <div class="row main-content">
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