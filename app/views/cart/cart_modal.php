<div class="table-responsive cart-table">
    <?php if (!empty($_SESSION['cart'])): ?>
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
    <?php else: ?>
        <h4 class="text-center mt-2 mb-2"><?=__('tpl_cart_empty');?></h4>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success ripple"
        data-bs-dismiss="modal"><?= __('tpl_cart_btn_continue'); ?></button>
    <?php if (!empty($_SESSION['cart'])): ?>
        <a href="order/view" class="btn btn-primary"><?= __('tpl_cart_btn_order'); ?></a>
        <button type="button" class="btn btn-danger clear-cart"><?= __('tpl_cart_btn_clear'); ?></button>
    <?php endif; ?>
</div>