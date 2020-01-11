<?php

class Task {

    const STATUS_NEW = 'new';
    const STATUS_CENCELED = 'cenceled';
    const STATUS_INWORK = 'inwork';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const ACTION_CENCEL = 'action_cencel';
    const ACTION_RESPOND = 'action_respond';
    const ACTION_REFUSE = 'action_refuse';
    const ACTION_COMPLETE = 'action_complete';

    /**
     * @var
     */
    protected $idExecute;
    protected $idCustomer;
    protected $currentStatus;
    protected $currentAction;

    /**
     * Task constructor.
     * @param $idExecute
     * @param $idCustomer
     */
    public function __construct(int $idExecute, int $idCustomer)
    {
            $this->idExecute = $idExecute;
            $this->idCustomer = $idCustomer;
            $this->currentStatus =  self::STATUS_NEW;
    }


    const GET_MAP_STATUS = [
           self::STATUS_NEW => 'Новое',
           self::STATUS_CENCELED => 'Отменено',
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
        self::ACTION_CENCEL => [self::STATUS_CENCELED],
        self::ACTION_RESPOND => [self::STATUS_INWORK],
        self::ACTION_COMPLETE => [self::STATUS_COMPLETED],
        self::ACTION_REFUSE => [self::STATUS_FAILED]

    ];

    // класс получает действие - возвращает статус который возможен после полученного действия
    public function getNextStatus($currentAction): array
    {
        $this->currentAction = $currentAction;

        if (!isset($this->currentAction))
        {
            throw new \LogicException('Передан неверный аргумент в метод');
        }

        return self::ACTION_TO_STATUS_MAP[$this->currentAction];

    }

    // класс получает статус - возращает доступные действия для полученного статуса

    /**
     * @param $currentStatus
     * @param $idUser
     * @return string
     */
    protected function getAvailableActions(string $currentStatus, int $idUser): string
    {
        $this->currentStatus = $currentStatus;
        if ($this->currentStatus === self::STATUS_NEW) {
            if ($idUser === $this->idCustomer) {
                $this->currentAction = self::ACTION_CENCEL;
            }
            elseif ($idUser === $this->idExecute) {
                $this->currentAction = self::ACTION_RESPOND;
            }
        }
        elseif ($this->currentStatus === self::STATUS_INWORK) {
            if ($idUser === $this->idCustomer) {
                $this->currentAction = self::ACTION_COMPLETE;
            }
            elseif ($idUser === $this->idExecute) {
                $this->currentAction = self::ACTION_REFUSE;
            }
        }

        return $this->currentAction;
    }

    }

