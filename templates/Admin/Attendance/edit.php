<?php 
$this->loadHelper('Attendance.Calendar');
$this->BcAdmin->setTitle('勤怠管理');
?>

<div class="bca-data-list__top">
	<div>
		<?php $this->BcBaser->link("勤怠管理一覧に戻る", ['controller' => 'attendance', 'action' => 'list'], ['class' => 'bca-btn', 'data-bca-btn-type' => 'back-to-list', 'data-bca-btn-size' => 'sm']); ?>
	</div>
</div>

<h2><?= $data["start_time"]->i18nFormat('Y年M月d日'); ?></h2>
<p>出勤：<?= isset($data["start_time"]) ? $data["start_time"]->i18nFormat('HH:mm') : "未"; ?><br>退勤：<?= isset($data["end_time"]) ? $data["end_time"]->i18nFormat('HH:mm') : "未"; ?></p>

<?= $this->BcAdminForm->create($data); ?>
<div class="section">
  <table id="FormTable" class="form-table bca-form-table">
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