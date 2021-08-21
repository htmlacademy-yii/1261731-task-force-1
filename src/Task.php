<?php
namespace App;

use App\CencelAction;
use App\RespondAction;
use App\CompleteAction;
use App\CompleteAction;

class Task {

    const ACTION_CENCEL = new CencelAction;
    const ACTION_RESPOND = new RespondAction;
    const ACTION_REFUSE = new CompleteAction;
    const ACTION_COMPLETE = new CompleteAction;

    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_INWORK = 'inwork';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

const GET_MAP_STATUS = [
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
     self::ACTION_REFUSE => self::STATUS_FAILED
 ];


    /**
     * @var
     */
    protected $executerId;
    protected $customerId;
    protected $idCurrentUser;
    protected $statusCurrent;
    protected $actionCurrent;

    /**
     * Task constructor.
     * @param $executerId
     * @param $customerId
     */
    public function __construct(int $executerId, int $customerId, int $idCurrentUser)
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
            if (self::ACTION_CENCEL->validateAcccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = self::ACTION_CENCEL;
            }
            elseif (self::ACTION_RESPOND->validateAcccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = self::ACTION_RESPOND;
            }
        }
        elseif ($this->statusCurrent === self::STATUS_INWORK) {
            if (self::ACTION_COMPLETE->validateAcccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = self::ACTION_COMPLETE;
            }
            elseif (self::ACTION_REFUSE->validateAcccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = self::ACTION_REFUSE;
            }
        }

        return $this->actionCurrent;
    }
}
