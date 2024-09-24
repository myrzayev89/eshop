<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mallar</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= ADMIN; ?>"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active">Mallar</li>
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="<?= ADMIN; ?>/product/create" class="btn btn-success">
                            <i class="fas fa-plus">&nbsp;Yeni Mal</i>
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($products)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Şəkil</th>
                                            <th>Malın adı</th>
                                            <th>Qiyməti</th>
                                            <th>Status</th>
                                            <th>Malın növü</th>
                                            <td width="50"><i class="fas fa-pencil-alt"></i></td>
                                            <td width="50"><i class="far fa-trash-alt"></i></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= $product['id']; ?></td>
                                                <td>
                                                    <img src="<?= PATH ?>/<?= $product['img']; ?>" alt="" height="40">
                                                </td>
                                                <td>
                                                    <?= $product['title']; ?>
                                                </td>
                                                <td>
                                                    <?= $product['price']; ?>
                                                </td>
                                                <td>
                                                    <?= $product['status'] ? 'Aktiv' : 'Deaktiv'; ?>
                                                </td>
                                                <td>
                                                    <?= $product['is_download'] ? 'Rəqəmsal' : 'Sadə'; ?>
                                                </td>
                                                <td width="50">
                                                    <a class="btn btn-info btn-sm"
                                                        href="<?= ADMIN ?>/product/edit?id=<?= $product['id'] ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </td>
                                                <td width="50">
                                                    <a class="btn btn-danger btn-sm delete"
                                                        href="<?= ADMIN ?>/product/delete?id=<?= $product['id'] ?>">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><?= count($products); ?> Nəticədən 1 - <?= count($products); ?> Arası Nəticələr (<?= $pagination->total; ?> Nəticə İçindən)</p>
                                    <?php if ($pagination->countPages > 1): ?>
                                        <?= $pagination; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <p>Mal tapılmadı!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->