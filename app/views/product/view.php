<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadcrumbs; ?>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="row">
        <div class="col-md-4 order-md-2">
            <h1><?= $product['title']; ?></h1>
            <ul class="list-unstyled">
                <?php if ($product['qty']): ?>
                    <li><i class="fas fa-check text-success"></i> Stokda var</li>
                <?php else: ?>
                    <li><i class="fas fa-shipping-fast text-muted"></i> Gözlənilir</li>
                <?php endif; ?>
                <li><i class="fas fa-hand-holding-usd"></i>
                    <span class="product-price">
                        <?php if ($product['old_price']): ?>
                            <small>$<?= $product['old_price']; ?></small>
                        <?php endif; ?>
                        $<?= $product['price']; ?>
                    </span>
                </li>
            </ul>
            <div id="product">
                <div class="input-group mb-3">
                    <input id="input-quantity" type="text" class="form-control" name="quantity" value="1">
                    <button class="btn btn-danger add-to-cart" type="button"
                        data-id="<?= $product['id']; ?>">Al</button>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <ul class="thumbnails list-unstyled clearfix">
                <li class="thumb-main text-center"><a class="thumbnail" href="<?= PATH . $product['img']; ?>"
                        data-effect="mfp-zoom-in"><img src="<?= PATH . $product['img']; ?>" alt=""></a></li>

                <?php foreach ($galleries as $gallery): ?>
                    <li class="thumb-additional"><a class="thumbnail" href="<?= PATH . $gallery['img']; ?>"
                            data-effect="mfp-zoom-in"><img src="<?= PATH . $gallery['img']; ?>" alt=""></a></li>
                <?php endforeach; ?>
            </ul>
            <p><?= $product['content']; ?></p>
        </div>
    </div>
</div>