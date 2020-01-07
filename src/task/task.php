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

    const ROLE_USER_EXECUTOR = 'executor';
    const ROLE_USER_СUSTOMER = 'customer';


    public $idExecute;
    public $idCustomer;
    public $currentStatus;
    public $currentAction;
    public $mapStatus;
    public $mapActions;

    public function __construct($idUser) {
        if ($idUser == 1) {
            $this->idExecute = $idUser;
        }
        elseif ($idUser == 2) {
            $this->idCustomer = $idUser;
        }

        $this->currentStatus =  self::STATUS_NEW;
    }

    public function getMapOfStatus() {
        $this->mapStatus = [
           self::STATUS_NEW => 'Новое',
           self::STATUS_CENCELED => 'Отменено',
           self::STATUS_INWORK => 'В работе',
           self::STATUS_COMPLETED => 'Выполнено',
           self::STATUS_FAILED => 'Провалено'
        ];

        return $this->mapStatus;
    }

    public function getMapOfActions() {
        $this->mapActions = [
          self::ACTION_CENCEL => 'Отменить',
          self::ACTION_RESPOND => 'Откликнуться',
          self::ACTION_REFUSE => 'Отказаться',
          self::ACTION_COMPLETE => 'Выполненно'
        ];

        return $this->mapActions;
    }

    // класс получает действие - возвращает статус который возможен после полученного действия
    public function getNextStatus($currentAction) {
        $this->currentAction = $currentAction;
        if ($this->currentStatus == self::STATUS_NEW) {
            if ($this->currentAction == self::ACTION_CENCEL) {
                $this->currentStatus = self::STATUS_CENCELED;
            }
            elseif ($this->currentAction == self::ACTION_RESPOND) {
                $this->currentStatus = self::STATUS_INWORK;
            }
        }
        elseif ($this->currentStatus == self::STATUS_INWORK) {
            if ($this->currentAction == self::STATUS_COMPLETED) {
                $this->currentStatus = self::STATUS_COMPLETED;
            }
            elseif ($this->currentAction == self::ACTION_REFUSE) {
                $this->currentStatus = self::STATUS_FAILED;
            }
        }

        return $this->currentStatus;

    }

    // класс получает статус - возращает доступные действия для полученного статуса
    public function getAvailableActions($currentStatus) {
        $this->currentStatus = $currentStatus;
        if ($this->currentStatus == self::STATUS_NEW) {
            if ($this->idCustomer) {
                $this->currentAction = self::ACTION_CENCEL;
            }
            elseif ($this->idExecute) {
                $this->currentAction = self::ACTION_RESPOND;
            }
        }
        elseif ($this->currentStatus == self::STATUS_INWORK) {
            if ($this->idCustomer) {
                $this->currentAction = self::ACTION_COMPLETE;
            }
            elseif ($this->idExecute) {
                $this->currentAction = self::ACTION_REFUSE;
            }
        }

        return $this->currentAction;
    }

    }

$task = new Task(1);
echo($task->getNextStatus('action_respond'));
echo($task->getNextStatus('action_refuse'));

