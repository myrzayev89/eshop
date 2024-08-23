<?php $this->getPart('layouts/admin/parts/header'); ?>

<?php $this->getPart('layouts/admin/parts/sidebar'); ?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>
<?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php
        echo $_SESSION['errors'];
        unset($_SESSION['errors']);
        ?>
    </div>
<?php endif; ?>

<?= $this->content; ?>

<?php $this->getPart('layouts/admin/parts/footer'); ?>