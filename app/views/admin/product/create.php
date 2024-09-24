<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Yeni Mal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= ADMIN; ?>"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= ADMIN; ?>/product">Mallar</a></li>
                    <li class="breadcrumb-item active">Yeni Mal</li>
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
                                <label for="parent_id">Kateqoriya seçin</label>
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
                                    'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
                                ]) ?>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required" for="price">Qiymət</label>
                                        <input type="text" name="price" class="form-control" id="price" placeholder="Qiymət" value="<?= get_field_value('price') ?: 0 ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="old_price">Köhnə qiymət</label>
                                        <input type="text" name="old_price" class="form-control" id="old_price" placeholder="Köhnə qiymət" value="<?= get_field_value('old_price') ?: 0 ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="status" name="status" checked>
                                    <label for="status" class="custom-control-label">Saytda göstər</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="hit" name="hit">
                                    <label for="hit" class="custom-control-label">Hit</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="is_download">Rəqəmsal mal üşün fayl əlavə edin</label>
                                        <select name="is_download" class="form-control select2 is-download" id="is_download" style="width: 100%;"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Əsas şəkil</h3>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-success" id="add-base-img" onclick="modalBaseImage(); return false;">Yüklə</button>
                                            <div id="base-img-output" class="upload-images base-image"></div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Əlavə şəkillər</h3>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-success" id="add-gallery-img" onclick="modalGalleryImage(); return false;">Yüklə</button>
                                            <div id="gallery-img-output" class="upload-images gallery-image"></div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
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
                                                    <label class="required" for="title">Malın adı</label>
                                                    <input type="text"
                                                        name="product_description[<?= $lang['id'] ?>][title]"
                                                        class="form-control" id="title" placeholder="Malın adı"
                                                        value="<?= get_field_array_value('product_description', $lang['id'], 'title') ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Meta təsviri</label>
                                                    <input type="text"
                                                        name="product_description[<?= $lang['id'] ?>][description]"
                                                        class="form-control" id="description" placeholder="Meta təsviri"
                                                        value="<?= get_field_array_value('product_description', $lang['id'], 'description') ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="keywords">Meta açar sözləri</label>
                                                    <input type="text"
                                                        name="product_description[<?= $lang['id'] ?>][keywords]"
                                                        class="form-control" id="keywords" placeholder="Meta açar sözləri"
                                                        value="<?= get_field_array_value('product_description', $lang['id'], 'keywords') ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label class="required" for="excerpt">Qısa açıqlama</label>
                                                    <input type="text"
                                                        name="product_description[<?= $lang['id'] ?>][excerpt]"
                                                        class="form-control" id="excerpt" placeholder="Qısa açıqlama"
                                                        value="<?= get_field_array_value('product_description', $lang['id'], 'excerpt') ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="excerpt">Ətraflı</label>
                                                    <textarea name="product_description[<?= $lang['id'] ?>][content]"
                                                        class="form-control editor" id="excerpt" rows="3"
                                                        placeholder="Mal haqqında ətraflı yazın"><?= get_field_array_value('product_description', $lang['id'], 'excerpt') ?></textarea>
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
<script>
    function modalBaseImage() {
        CKFinder.modal({
            chooseFiles: true,
            language: 'az',
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    const baseImgOutput = document.getElementById('base-img-output');
                    baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="img" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                });
                finder.on('file:choose:resizedImage', function(evt) {
                    const baseImgOutput = document.getElementById('base-img-output');
                    baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + evt.data.resizedUrl + '"><input type="hidden" name="img" value="' + evt.data.resizedUrl + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                });
            }
        });
    }

    function modalGalleryImage() {
        CKFinder.modal({
            chooseFiles: true,
            language: 'az',
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    const galleryImgOutput = document.getElementById('gallery-img-output');

                    if (galleryImgOutput.innerHTML) {
                        galleryImgOutput.innerHTML += '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    } else {
                        galleryImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    }

                });
                finder.on('file:choose:resizedImage', function(evt) {
                    const baseImgOutput = document.getElementById('base-img-output');

                    if (galleryImgOutput.innerHTML) {
                        galleryImgOutput.innerHTML += '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    } else {
                        galleryImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    }

                });
            }
        });
    }

    window.editors = {};
    document.querySelectorAll('.editor').forEach((node, index) => {
        ClassicEditor
            .create(node, {
                ckfinder: {
                    uploadUrl: '<?= PATH; ?>/adminlte/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                toolbar: ['ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'link', 'bulletedList', 'numberedList', 'insertTable', 'blockQuote'],
                image: {
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
                    styles: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight'
                    ]
                },
                language: 'az',
            })
            .then(newEditor => {
                window.editors[index] = newEditor
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>