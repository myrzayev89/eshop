<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_information'); ?></h4>
                    <?php new \app\widgets\page\Page([
                        'cache' => 0,
                        'class' => 'list-unstyled',
                        'prepend' => '<li><a href="'.base_url().'">'.___('tpl_home_link').'</a></li>',
                    ]); ?>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_work_hours'); ?></h4>
                    <ul class="list-unstyled">
                        <li>b.e-b: 9:00 - 18:00</li>
                        <li>fasiləsiz</li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_contacts'); ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:5551234567">555 123-45-67</a></li>
                        <li><a href="tel:5551234567">555 123-45-68</a></li>
                        <li><a href="tel:5551234567">555 123-45-69</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_we_online'); ?></h4>
                    <div class="footer-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
<button id="top">
    <i class="fas fa-angle-double-up"></i>
</button>
<?php $this->getDbLogs(); ?>
<script>
    const PATH = '<?= PATH; ?>';
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?= PATH; ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= PATH; ?>/assets/js/main.js"></script>
<script src="<?= PATH; ?>/assets/js/jquery.magnific-popup.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>