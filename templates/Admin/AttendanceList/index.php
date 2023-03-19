<?php 
$this->loadHelper('Attendance.Calendar');
$this->BcBaser->css([
'/attendance/css/admin/attendance_admin'
]);

$this->BcAdmin->setTitle('勤怠管理 '.$date->format('Y年n月'));
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#ListTable tbody tr[data-href]').click( function() {
		if($(this).attr('data-href') !== ""){
			window.location = $(this).attr('data-href');
		}
    });
});
</script>
<div class="bca-data-list__top">
	<div>
		<?php $this->BcBaser->link("ユーザー一覧に戻る", $admin_Prefix.'/baser-core/users/index', ['class' => 'bca-btn', 'data-bca-btn-type' => 'back-to-list', 'data-bca-btn-size' => 'sm']); ?>
	</div>
</div>


<div class="bca-data-list__top">
	<div>
		<?php $this->BcBaser->link("", ['controller' => 'attendancelist', 'action' => 'index',$user->id,$date->subMonth()->format("Y-m")], ['class' => 'bca-btn', 'data-bca-btn-type' => 'back-to-list', 'data-bca-btn-size' => 'sm']); ?>
		<?php $this->BcBaser->link("今月", ['controller' => 'attendancelist', 'action' => 'index'], ['class' => 'bca-btn', 'data-bca-btn-size' => 'sm']); ?>
		<?php $this->BcBaser->link("", ['controller' => 'attendancelist', 'action' => 'index',$user->id,$date->addMonth()->format("Y-m")], ['class' => 'bca-btn bca-btn-next', 'data-bca-btn-type' => 'back-to-list', 'data-bca-btn-size' => 'sm']); ?>
	</div>
</div>

<div class="bca-data-list__top">
	<div>
		<?php $this->BcBaser->link("このページを印刷する","javascript:;", ['class' => 'bca-btn','data-bca-btn-size' => 'sm','onclick' => 'window.print();']); ?>
	</div>
</div>

<h3 style="margin-top:0;"><?= h($user->real_name_1) . " " . h($user->real_name_2); ?>さんのタイムカード</h3>

<table class="list-table bca-table-listup" id="ListTable">
	<thead class="bca-table-listup__thead">
		<tr>
			<th class="bca-table-listup__thead-th">日付</th>
			<th class="bca-table-listup__thead-th">出勤</th>
			<th class="bca-table-listup__thead-th">退勤</th>
			<th class="bca-table-listup__thead-th">備考</th>
		</tr>
	</thead>
	<tbody class="bca-table-listup__tbody">
		<?php if(isset($daysOfMonth)): foreach($daysOfMonth as $day): ?>
		<?php
		$day_array = $this->Calendar->getDaySearch($day->format('Y-m-d'),$data,"start_time");
		?>
		<tr class="no_link">
		<td class="bca-table-listup__tbody-td">
			<?= $day->format('j日'); ?>
		</td>
		<?php if(is_int($day_array)): ?>
		<td class="bca-table-listup__tbody-td">
		<?php if(isset($data[$day_array]["start_time"])){ echo $data[$day_array]["start_time"]->format("H:i"); } ?>
		</td>
		<td class="bca-table-listup__tbody-td"><?php if(isset($data[$day_array]["end_time"])){ echo $data[$day_array]["end_time"]->format("H:i"); } ?></td>
		<td class="bca-table-listup__tbody-td"><?= h($data[$day_array]["remarks"]); ?></td>
		<?php else: ?>
		<td class="bca-table-listup__tbody-td"></td>
		<td class="bca-table-listup__tbody-td"></td>
		<td class="bca-table-listup__tbody-td"></td>
		<?php endif; ?>
		</tr>
		<?php endforeach; else: ?>
		<tr>
			<td colspan="4" class="bca-table-listup__tbody-td">
				<p class="no-data">データが見つかりませんでした。</p>
			</td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>