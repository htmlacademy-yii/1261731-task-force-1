<?php
namespace App;

use App\CencelAction;
use App\RespondAction;
use App\CompleteAction;
use App\RefuseAction;

class Task {

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
     'Отменить' => self::STATUS_CANCELED,
     'Откликнуться' => self::STATUS_INWORK,
     'Выполненно' => self::STATUS_COMPLETED,
     'Отказаться' => self::STATUS_FAILED
 ];


    /**
     * @var
     */
    protected $actionCencel;
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

            $this->actionCencel = new CencelAction;
            $this->actionRespond = new RespondAction;
            $this->actinRefuse = new CompleteAction;
            $this->actionComplete = new CompleteAction;

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
            if ($this->actionCencel->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = $this->actionCencel;
            }
            elseif ($this->actionRespond->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = $this->actionRespond;
            }
        }
        elseif ($this->statusCurrent === self::STATUS_INWORK) {
            if ($this->actionComplete->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = $this->actionComplete;
            }
            elseif ($this->actinRefuse->validateAccessUser($this->idCurrentUser, $this->customerId, $this->executerId)) {
                $this->actionCurrent = $this->actinRefuse;
            }
        }

        return $this->actionCurrent;
    }
}
