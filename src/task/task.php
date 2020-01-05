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
   
    
    // public $idExecuter;
    // public $idCustomer;
    // public static $currentStatus = STATUS_NEW;  

    // public function __construct(int $idExecuter, int $idCustomer) {
    //     $this->idPerfomer = $idPerfomer;
    //     $this->idCustomer = $idCustomer;        
    // }

    public function getMapOfStatus() {
        $this->$mapStatus = [
           self::STATUS_NEW => 'Новое',
           self::STATUS_CENCELED => 'Отменено',
           self::STATUS_INWORK => 'В работе',
           self::STATUS_COMPLETED => 'Выполнено',
           self::STATUS_FAILED => 'Провалено'
        ];

        return $mapStatus;
    }

    public function getMapOfActions() {
        $this->$mapActions = [
          self::ACTION_CENCEL => 'Отменить',
          self::ACTION_RESPOND => 'Откликнуться',
          self::ACTION_REFUSE => 'Отказаться',
          self::ACTION_COMPLETE => 'Выполненно'
        ];

        return $mapActions;
    }

    public function getNextStatus() {
        Task::getMapOfStatus();

        return $nextStatus;
        
    }

    public function getAvailableActions() {
        Task::getMapOfActions();

        return $availableActions;
    }

    }

    $test = new Task;
    $test->getMapOfActions();
    print_r($test);