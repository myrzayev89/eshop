<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active"><?php __('tpl_cart_title'); ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive cart-table">
                <div class="modal-body">
                    <table class="table text-start">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('tpl_cart_photo'); ?></th>
                                <th scope="col"><?= __('tpl_cart_product'); ?></th>
                                <th scope="col"><?= __('tpl_cart_qty'); ?></th>
                                <th scope="col"><?= __('tpl_cart_price'); ?></th>
                                <th scope="col"><?= __('tpl_cart_delete'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                                <tr>
                                    <td>
                                        <a href="product/<?= $item['slug']; ?>">
                                            <img src="<?= PATH . $item['img']; ?>" alt="Product image">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="product/<?= $item['slug']; ?>"><?= $item['title']; ?></a>
                                    </td>
                                    <td><?= $item['qty']; ?></td>
                                    <td>$<?= $item['price']; ?></td>
                                    <td>
                                        <a href="cart/delete?id=<?= $id; ?>" class="del-item" data-id="<?= $id; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" class="text-end"><?= __('tpl_cart_total_qty'); ?></td>
                                <td class="cart-qty"><b><?= $_SESSION['cart.qty']; ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end"><?= __('tpl_cart_sum'); ?></td>
                                <td class="cart-sum"><b><?= number_format($_SESSION['cart.sum'], 2) ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 category-content">
            <form action="order/checkout" class="row g-3" method="post">
                <?php if (!isset($_SESSION['user'])): ?>
                    <div class="col-md-6 offset-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="email" value="<?= get_field_value('email'); ?>" class="form-control"
                                id="email" placeholder="name@example.com">
                            <label class="required" for="email"><?= __('order_index_email_input'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="password">
                            <label class="required" for="password"><?= __('order_index_password_input'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" value="<?= get_field_value('name'); ?>" class="form-control"
                                id="name" placeholder="Name">
                            <label class="required" for="name"><?= __('order_index_name_input'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="address" value="<?= get_field_value('address'); ?>"
                                class="form-control" id="address" placeholder="Address">
                            <label class="required" for="address"><?= __('order_index_address_input'); ?></label>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <textarea name="note" class="form-control" placeholder="Leave a comment here" id="note"
                            style="height: 100px"><?= get_field_value('note') ?></textarea>
                        <label for="note"><?php __('order_index_note_input'); ?></label>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-danger"><?= __('order_index_order_btn'); ?></button>
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