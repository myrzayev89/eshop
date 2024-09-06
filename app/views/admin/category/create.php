<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Yeni Bölmə</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= ADMIN; ?>"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= ADMIN; ?>/category">Bölmələr</a></li>
                    <li class="breadcrumb-item active">Yeni Bölmə</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="required" for="parent_id">Kateqoriya seçin</label>
                                <?php new \app\widgets\menu\Menu([
                                    'cache' => 0,
                                    'cacheKey' => 'admin_cat_select',
                                    'class' => 'form-control',
                                    'container' => 'select',
                                    'attrs' => [
                                        'name' => 'parent_id',
                                        'id' => 'parent_id',
                                        'required' => 'required',
                                    ],
                                    'prepend' => '<option value="0">Sərbəst kateqoriya</option>',
                                    'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
                                ]) ?>
                            </div>

                            <div class="card card-success card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <?php foreach (\core\App::$app->getProperty('languages') as $k => $lang): ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($lang['base'])
                                                    echo 'active' ?>" data-toggle="pill" href="#<?= $k ?>">
                                                    <img src="<?= PATH ?>/assets/img/lang/<?= $k ?>.png"
                                                        alt="Language flag">
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content">
                                        <?php foreach (\core\App::$app->getProperty('languages') as $k => $lang): ?>
                                            <div class="tab-pane fade <?php if ($lang['base'])
                                                echo 'active show' ?>" id="<?= $k ?>">

                                                <div class="form-group">
                                                    <label class="required" for="title">Bölmə adı</label>
                                                    <input type="text"
                                                        name="category_description[<?= $lang['id'] ?>][title]"
                                                        class="form-control" id="title" placeholder="Bölmə adı"
                                                        value="<?= get_field_array_value('category_description', $lang['id'], 'title') ?>"
                                                        required2>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Meta təsviri</label>
                                                    <input type="text"
                                                        name="category_description[<?= $lang['id'] ?>][description]"
                                                        class="form-control" id="description" placeholder="Meta təsviri"
                                                        value="<?= get_field_array_value('category_description', $lang['id'], 'description') ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="keywords">Meta açar sözləri</label>
                                                    <input type="text"
                                                        name="category_description[<?= $lang['id'] ?>][keywords]"
                                                        class="form-control" id="keywords" placeholder="Meta açar sözləri"
                                                        value="<?= get_field_array_value('category_description', $lang['id'], 'keywords') ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="excerpt">Ətraflı</label>
                                                    <textarea name="category_description[<?= $lang['id'] ?>][excerpt]"
                                                        class="form-control editor" id="excerpt" rows="3"
                                                        placeholder="Bölmə haqqında ətraflı yazın"><?= get_field_array_value('category_description', $lang['id'], 'excerpt') ?></textarea>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <button type="submit" class="btn btn-success">Əlavə et</button>
                        </form>

                        <?php
                        if (isset($_SESSION['form_data'])) {
                            unset($_SESSION['form_data']);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->