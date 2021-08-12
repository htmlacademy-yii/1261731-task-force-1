<?php
namespace App;

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

const GET_MAP_STATUS = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_INWORK => 'В работе',
        self::STATUS_COMPLETED => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
 ];

 const GET_MAP_ACTIONS = [
       self::ACTION_CENCEL => 'Отменить',
       self::ACTION_RESPOND => 'Откликнуться',
       self::ACTION_REFUSE => 'Отказаться',
       self::ACTION_COMPLETE => 'Выполненно'
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
    protected $statusCurrent;
    protected $actionCurrent;

    /**
     * Task constructor.
     * @param $executerId
     * @param $customerId
     */
    public function __construct(int $executerId, int $customerId)
    {
            $this->executerId = $executerId;
            $this->customerId = $customerId;
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
    public function getAvailableActions(string $statusCurrent, int $userId): string
    {
        $this->statusCurrent = $statusCurrent;

        if ($this->statusCurrent === self::STATUS_NEW) {
            if ($userId === $this->customerId) {
                $this->actionCurrent = self::ACTION_CENCEL;
            }
            elseif ($userId === $this->executerId) {
                $this->actionCurrent = self::ACTION_RESPOND;
            }
        }
        elseif ($this->statusCurrent === self::STATUS_INWORK) {
            if ($userId === $this->customerId) {
                $this->actionCurrent = self::ACTION_COMPLETE;
            }
            elseif ($userId === $this->executerId) {
                $this->actionCurrent = self::ACTION_REFUSE;
            }
        }

        return $this->actionCurrent;
    }
}
