<?php 
$this->loadHelper('Attendance.Calendar');
$this->BcAdmin->setTitle('勤怠管理');
?>

<div class="bca-data-list__top">
	<div>
		<?php $this->BcBaser->link("勤怠管理一覧に戻る", ['controller' => 'attendance', 'action' => 'list'], ['class' => 'bca-btn', 'data-bca-btn-type' => 'back-to-list', 'data-bca-btn-size' => 'sm']); ?>
	</div>
</div>

<h2><?= $date->format('Y年n月j日'); ?></h2>

<?= $this->BcAdminForm->create($data); ?>
<div class="section">
  <table id="FormTable" class="form-table bca-form-table">
    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('start_time','出勤') ?>
        &nbsp;<span class="required bca-label" data-bca-label-type="required"><?= __d('baser_core','必須') ?></span>
      </th>
      <td class="col-input bca-form-table__input">
        <?= $this->BcAdminForm->control('start_time', ['type' => 'time', 'size' => 35, 'maxlength' => 255, 'autofocus' => true]) ?>
        <?= $this->BcAdminForm->error('start_time') ?>
      </td>
    </tr>

    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('end_time','退勤') ?>
        &nbsp;<span class="required bca-label" data-bca-label-type="required"><?= __d('baser_core','必須') ?></span>
      </th>
      <td class="col-input bca-form-table__input">
        <?= $this->BcAdminForm->control('end_time', ['type' => 'time', 'size' => 35, 'maxlength' => 255, 'autofocus' => true]) ?>
        <?= $this->BcAdminForm->error('end_time') ?>
      </td>
    </tr>

    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('remarks','備考') ?>
      </th>
      <td class="col-input bca-form-table__input">
        <?= $this->BcAdminForm->control('remarks', ['type' => 'textarea', 'size' => 35, 'maxlength' => 255, 'autofocus' => true]) ?>
        <?= $this->BcAdminForm->error('remarks') ?>
      </td>
    </tr>
  </table>
</div>

<div class="submit bca-actions">
  <div class="bca-actions__main">
    <?= $this->BcAdminForm->button(__d('baser_core','保存'), [
      'div' => false,
      'class' => 'button bca-btn bca-actions__item bca-loading',
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
	]); ?>
  </div>
</div>
<?= $this->BcAdminForm->end(); ?>