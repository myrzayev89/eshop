<?php $get_id = get('id'); ?>
<option value="<?= $id ?>" <?php if ($id == get_parent_id())
      echo 'selected'; ?> <?php if ($get_id == $id)
             echo 'disabled'; ?>>
    <?= $tab . $category['title'] ?>
</option>
<?php if (isset($category['children'])): ?>
    <?= $this->getMenuHtml($category['children'], '&nbsp;' . $tab . '-') ?>
<?php endif; ?>