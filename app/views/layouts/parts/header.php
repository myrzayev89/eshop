<!doctype html>
<html lang="<?= \core\App::$app->getProperty('language')['code'] ?>">

<head>
    <base href="<?= base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->getMeta(); ?>
    <link rel="shortcut icon" href="<?= PATH; ?>/assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= PATH; ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link rel="stylesheet" href="<?= PATH; ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= PATH; ?>/assets/css/magnific-popup.css">
</head>

<body>
    <header>
        <div class="header-top py-3">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col">
                        <a href="tel:5551234567">
                            <span class="icon-phone">&#9743;</span> 555 XXX-XX-XX
                        </a>
                    </div>
                    <div class="col text-end icons">
                        <form action="search">
                            <div class="input-group" id="search">
                                <input type="text" class="form-control" placeholder="<?php __('tpl_search'); ?>" name="q">
                                <button class="btn close-search" type="button"><i class="fas fa-times"></i></i></button>
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        <a href="#" class="open-search"><i class="fas fa-search"></i></a>

                        <a href="#" id="get-cart" class="relative" data-bs-toggle="modal" data-bs-target="#cart-modal">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger rounded-pill count-items">
                                <?= $_SESSION['cart.qty'] ?? 0; ?>
                            </span>
                        </a>
                        <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= __('tpl_cart_title') ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-cart-content"></div>
                                </div>
                            </div>
                        </div>
                        <a href="wishlist"><i class="far fa-heart"></i></a>
                        <div class="dropdown d-inline-block">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="far fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (empty($_SESSION['user'])): ?>
                                    <li><a class="dropdown-item" href="user/login"><?php __('tpl_login'); ?></a></li>
                                    <li><a class="dropdown-item" href="user/signup"><?php __('tpl_signup'); ?></a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="user/cabinet"><?php __('tpl_cabinet'); ?></a></li>
                                    <li><a class="dropdown-item" href="user/logout"><?php __('tpl_logout'); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php new \app\widgets\language\LanguageWidget(); ?>
                    </div>
                </div>
            </div>
        </div><!-- header-top -->
        <div class="header-bottom py-2">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid p-0">
                        <a class="navbar-brand"
                            href="<?= base_url(); ?>"><?= \core\App::$app->getProperty('site_name'); ?></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <?php new \app\widgets\menu\Menu([
                                'class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
                                'cache' => 10,
                            ]); ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div><!-- header-bottom -->
    </header>