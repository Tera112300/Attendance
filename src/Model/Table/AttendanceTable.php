<?php
namespace Attendance\Model\Table;
use BaserCore\Model\Table\AppTable;
use Cake\Validation\Validator;

class AttendanceTable extends AppTable
{
    public function validationDefault(Validator $validator): Validator
    {
        $validator
        ->time('start_time','有効な時間を入力してください')
        ->requirePresence('start_time',true,'このフィールドに入力してください')
        ->notEmpty('start_time','このフィールドに入力してください')
        ->time('end_time','有効な時間を入力してください')
        ->requirePresence('end_time',true,'このフィールドに入力してください')
        ->notEmpty('end_time','このフィールドに入力してください');
        return $validator;
    }
}
