<?php
use core\View;

/** @var $this View */
?>
<?php $this->getPart('layouts/parts/header'); ?>
<?php if (!empty($_SESSION['success'])): ?>
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']); 
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?php if (!empty($_SESSION['errors'])): ?>
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php
                echo $_SESSION['errors'];
                unset($_SESSION['errors']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?= $this->content; ?>
<?php $this->getPart('layouts/parts/footer'); ?>
</body>

</html>