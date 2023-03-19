<?php $this->BcAdmin->setTitle('勤怠管理'); ?>
<div class="bca-data-list__top">
	<div>
	<?php $this->BcBaser->link("勤怠一覧", ['controller' => 'attendance', 'action' => 'list'],['class' => 'bca-btn','data-bca-btn-type' => 'menuitem','data-bca-btn-size' => 'sm']); ?>
	</div>
</div>
<?= $this->BcAdminForm->create($data); ?>
  <div class="bca-actions__main">
    <?= $this->BcAdminForm->button('出勤', [
      'div' => false,
      'class' => 'button bca-btn',
      'name' => 'attendance',
      'value' => 1,
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
      'disabled' => isset($data["start_time"]) ? "disabled" : false
    ]); ?>
     <?= $this->BcAdminForm->button('退勤', [
      'div' => false,
      'class' => 'button bca-btn',
      'name' => 'leaving',
      'value' => 1,
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
      'disabled' => isset($data["end_time"]) ? "disabled" : false
     ]); ?>
</div>

<p><?php if(isset($data["start_time"])){echo "出勤：". $data["start_time"]->i18nFormat('HH:mm'); }; ?><br><?php if(isset($data["end_time"])){echo "退勤：". $data["end_time"]->i18nFormat('HH:mm'); }; ?></p>
<?= $this->BcAdminForm->end(); ?>
<style>
  .bca-btn[disabled]{
    color: #fff;
    pointer-events: none;
    opacity: 0.7;
  }
</style>