<?php
namespace Attendance\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;

/**
 * Class MailConfig
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property FrozenTime $created
 * @property FrozenTime $modified
 */
class Attendance extends Entity
{

    /**
     * Accessible
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'user_id' => false,
        'id' => false
    ];

}
