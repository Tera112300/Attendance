<?php
namespace Attendance\Controller\Admin;
use BaserCore\Utility\BcUtil;
use Cake\I18n\Time;
use Cake\Chronos\Chronos;
use  BaserCore\Model\Table\UsersTable;
use  Attendance\Model\Table\AttendanceTable;


class AttendanceListController extends AttendanceAdminAppController
{


    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Attendance.Calendar');
        $this->Users = new UsersTable();
        $this->Attendance = new AttendanceTable();
    }
    public function index(int $id = 0,$date_str = "")
    {
        $usersData = $this->Users->find()->where(['id' => $id])->first();
        if (!isset($usersData)) return $this->redirect($this->Authentication->logout());


        if($date_str === ""){
            $date = new Chronos();
            $daysOfMonth = $this->Calendar->getDaysOfMonth();
        }else{
            list($year,$month) = explode("-", $date_str);
            if(!checkdate($month, 01, $year)) return $this->redirect(['action' => 'list']);
            $date = new Chronos($date_str);
            $daysOfMonth = $this->Calendar->getDaysOfMonth($year - Time::now()->startOfMonth()->format('Y'),$month - Time::now()->startOfMonth()->format('m'));
        }
        $startDate = Time::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endDate = Time::now()->endOfMonth()->format('Y-m-d H:i:s');
 
        $data = $this->Attendance->find()->where([
            'user_id' => BcUtil::loginUser()->id,
            function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('start_time', $startDate, $endDate);
            }
        ])->all()->toArray();
        
       
        $this->set(compact("data","daysOfMonth","date"));
        $this->set(["user" => $usersData,"admin_Prefix" => BcUtil::getPrefix()]);
    }
}
