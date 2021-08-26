<?php
namespace App;

use App\CancelAction;
use App\RespondAction;
use App\CompleteAction;
use App\RefuseAction;

class Task {

    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_INWORK = 'inwork';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const ACTION_CENCEL = 'action_cencel';
    const ACTION_RESPOND = 'action_respond';
    const ACTION_REFUSE = 'action_refuse';
    const ACTION_COMPLETE = 'action_complete';

const STATUS_NAMES = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_INWORK => 'В работе',
        self::STATUS_COMPLETED => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
 ];

 const ACTION_TO_STATUS_MAP = [
     self::ACTION_CENCEL => self::STATUS_CANCELED,
     self::ACTION_RESPOND => self::STATUS_INWORK,
     self::ACTION_COMPLETE => self::STATUS_COMPLETED,
     self::ACTION_COMPLETE => self::STATUS_FAILED
 ];


    /**
     * @var
     */
    protected $actionCancel;
    protected $actionRespond;
    protected $actinRefuse;
    protected $actionComplete;

    protected $executerId;
    protected $customerId;
    protected $idCurrentUser;
    protected $statusCurrent;
    protected $actionCurrent;
    protected $actionCurrent1;

    /**
     * Task constructor.
     * @param $executerId
     * @param $customerId
     */
    public function __construct(int $idCurrentUser, int $customerId, int $executerId)
    {
            $this->executerId = $executerId;
            $this->customerId = $customerId;
            $this->idCurrentUser = $idCurrentUser;
            $this->statusCurrent =  self::STATUS_NEW;

    }


    // метод получает действие - возвращает статус который возможен после полученного действия
    public function getNextStatus($actionCurrent)
    {
        $this->actionCurrent = $actionCurrent;

        if (!isset($this->actionCurrent))
        {
            throw new \LogicException('Передан неверный аргумент в метод');
        }

        return self::ACTION_TO_STATUS_MAP[$this->actionCurrent];

    }

    // метод получает статус - возращает доступные действия для полученного статуса

    /**
     * @param $statusCurrent
     * @param $userId
     * @return string
     */
    public function getAvailableActions(string $statusCurrent): object
    {
        $this->statusCurrent = $statusCurrent;

        if ($this->statusCurrent === self::STATUS_NEW) {
            $action = new CancelAction;
            if ($action->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                return $action;
            }

            $action = new RespondAction;
            if ($action->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
               return $action;
            }
        }
        elseif ($this->statusCurrent === self::STATUS_INWORK) {
            $action = new CompleteAction;
            if ($action->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                return $action;
            }

            $action = new RefuseAction;
            if ($action->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
               return $action;
            }
        }
    }
}
