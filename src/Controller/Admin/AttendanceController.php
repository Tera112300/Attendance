<?php

namespace Attendance\Controller\Admin;

use BaserCore\Utility\BcUtil;
use BaserCore\Model\Entity\User;
use Cake\I18n\Time;
use Cake\Chronos\Chronos;

class AttendanceController extends AttendanceAdminAppController
{


    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Attendance.Calendar');
    }

    public function index()
    {

        $currentDateTime = new \DateTime();
        $currentDateTime_format = $currentDateTime->format('Y-m-d');
       
        $data = $this->Attendance->find()->where([
            'user_id' => BcUtil::loginUser()->id,
            function ($exp, $q) use ($currentDateTime_format) {
                // return $exp->lte('start_time',$currentDateTime_format);
                return $exp->between('start_time', $currentDateTime_format . ' 00:00:00', $currentDateTime_format . ' 23:59:59');
            }
        ])->first();

        if ($this->request->is(['post', 'put'])) {
            if ($this->getRequest()->getData('attendance') == 1 && !$data) {
                $post_data = $this->Attendance->newEmptyEntity();
                $post_data->user_id = BcUtil::loginUser()->id;
                $post_data->start_time = $currentDateTime->format('Y-m-d H:i:s');
                
                if($data = $this->Attendance->save($post_data)){
                    $this->BcMessage->setInfo('出勤を押しました。');
                }
                
            } elseif ($this->getRequest()->getData('leaving') == 1 && $data && !isset($data->end_time)) {
                $data->end_time = $currentDateTime->format('Y-m-d H:i:s');
                $data->status = 1;
                if($data = $this->Attendance->save($data)){
                    $this->BcMessage->setInfo('退勤を押しました。');
                }
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact("data"));
    }

    public function list($date_str = "")
    {
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
        $this->set(["user" => BcUtil::loginUser()]);
  
    }
    public function create($date_str = "")
    {
        list($year,$month,$day) = explode("-", $date_str);
        if(!checkdate($month, $day, $year)) return $this->redirect(['action' => 'list']);
        $futureDatetime = new Chronos($date_str);
        $data = $this->Attendance->find()->where([
            'user_id' => BcUtil::loginUser()->id,
            function ($exp, $q) use ($date_str) {
                return $exp->between('start_time', $date_str . ' 00:00:00', $date_str . ' 23:59:59');
            }
        ])->first();
        if(isset($data) || $futureDatetime->isFuture()) return $this->redirect(['action' => 'list']);

        $date = new \DateTime();
        $date->setDate($year,$month,$day);

        $data = $this->Attendance->newEmptyEntity();
        if ($this->request->is(['post','put'])) {
            $data = $this->Attendance->patchEntity($data,$this->getRequest()->getData());
            $data->user_id = BcUtil::loginUser()->id;
            if (!$data->getErrors()) {
                $data->start_time = $date->format('Y-m-d')." ".$this->getRequest()->getData("start_time");
                $data->end_time = $date->format('Y-m-d')." ".$this->getRequest()->getData("end_time");
                if($data = $this->Attendance->save($data)){
                    $this->BcMessage->setInfo('新規作成しました。');
                }
                return $this->redirect(['action' => 'list']);
            }
            $this->BcMessage->setError("入力エラーです。内容を修正してください。");
        }
        $this->set(compact("date","data"));
    }
    
    public function edit(int $id = 0)
    {
        $data = $this->Attendance->find()->where([
            'id' => $id,
            'user_id' => BcUtil::loginUser()->id
        ])->first();
        
        if(!isset($data)) return $this->redirect(['action' => 'index']);
        
        if ($this->request->is(['post', 'put'])) {
            $data->remarks = $this->getRequest()->getData('remarks');
           if($data = $this->Attendance->save($data)){
            $this->BcMessage->setInfo('備考を更新しました。');
           }  
        }
        $this->set(compact("data"));
    }
}
