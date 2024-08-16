<?php foreach ($this->data as $item): ?>
    <div class="col-md-3 col-sm-6">
        <div class="service-item">
            <p class="text-center"><i class="<?= $item['icon']; ?>"></i></p>
            <p class="text-center"><b><?= $item['title']; ?></b></p>
        </div>
    </div>
<?php endforeach; ?>