<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active"><?php __('tpl_signup'); ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="row">
        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?php __('tpl_signup'); ?></h1>
            <form class="row g-3" method="post">
                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="email" value="<?= get_field_value('email'); ?>" class="form-control"
                            id="email" placeholder="name@example.com">
                        <label class="required" for="email"><?= __('tpl_signup_email_input'); ?></label>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="password">
                        <label class="required" for="password"><?= __('tpl_signup_password_input'); ?></label>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="<?= get_field_value('name'); ?>" class="form-control" id="name" placeholder="Name">
                        <label class="required" for="name"><?= __('tpl_signup_name_input'); ?></label>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="address" value="<?= get_field_value('address'); ?>" class="form-control" id="address" placeholder="Address">
                        <label class="required" for="address"><?= __('tpl_signup_address_input'); ?></label>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-danger"><?= __('tpl_signup_btn'); ?></button>
                </div>
            </form>
            <?php
                if (isset($_SESSION['form_data'])) {
                    unset($_SESSION['form_data']);
                }
            ?>
        </div>
    </div>
</div>