<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadcrumbs; ?>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="row">
        <div class="col-lg-12 category-content">
            <h3 class="section-title"><?= $category['title']; ?></h3>
            <p><?= $category['excerpt']; ?></p>

            <?php if ($pagination->countPages > 1 || count($products) > 1): ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="input-sort"><?= __('category_view_sort'); ?>:</label>
                            <select class="form-select" id="input-sort">
                                <option selected disabled><?= __('category_view_choose_sorting'); ?></option>
                                <option value="sort=title_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_asc')
                                    echo 'selected'?>><?= __('category_view_sort_title_asc'); ?>
                                </option>
                                <option value="sort=title_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_desc')
                                    echo 'selected'?>><?= __('category_view_sort_title_desc'); ?>
                                </option>
                                <option value="sort=price_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_asc')
                                    echo 'selected'?>><?= __('category_view_sort_price_asc'); ?>
                                </option>
                                <option value="sort=price_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_desc')
                                    echo 'selected'?>><?= __('category_view_sort_price_desc'); ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="input-sort">Göstər:</label>
                            <select class="form-select" id="input-sort">
                                <option selected>15</option>
                                <option value="1">25</option>
                                <option value="2">50</option>
                                <option value="3">75</option>
                                <option value="3">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php $this->getPart('layouts/parts/products_loop', compact('products')); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <?= $pagination->total; ?>     <?php __('tpl_total_pagination'); ?>
                                <?= $pagination->currentPage; ?> - <?= $pagination->perpage; ?>
                                <?php __('tpl_page_perpage_pagination'); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <?php if ($pagination->countPages > 1): ?>
                                <?= $pagination; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <h3><?= __('category_view_no_products'); ?></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>