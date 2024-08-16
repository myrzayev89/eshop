<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Sevimliler</li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="row">
        <div class="col-lg-12 category-content">
            <h3 class="section-title">Sevimliler</h3>
            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php $this->getPart('layouts/parts/products_loop', compact('products')); ?>
                <?php else: ?>
                    <h3>Sevimliler yoxdur</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>