<?php
namespace Attendance\Event;

use BaserCore\Utility\BcUtil;
use Cake\Core\Configure;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;
use Cake\Event\Event;
use Cake\View\View;


class AttendanceViewEventListener extends \BaserCore\Event\BcViewEventListener
{
    public $events = [
        'BaserCore.Users.beforeRender',
         'BaserCore.Users.beforeElement',
    ];


    public function BaserCoreUsersBeforeRender(Event $event)
    {
        $view = $event->getSubject();
        if($view->getRequest()->getParam('action') !== "index") return true;
        if (BcUtil::isAdminSystem()) {
            $view->BcHtml->script('/attendance/js/admin/user_list', ["block" => true]);
        }
    }

    public function BaserCoreUsersBeforeElement(Event $event)
    {
        $view = $event->getSubject();
      
        if($view->getRequest()->getParam('action') !== "index") return true;
        
        if($event->getData()["name"] === "footer" && BcUtil::isAdminSystem()){
            echo $view->BcAdminForm->control('js_adminurl', ['type' => 'hidden','value' => BcUtil::getPrefix()]);
        }  
    }
}
