<?php

class Task {

    const STATUS_NEW = 'new';
    const STATUS_CENCEL = 'cencel';
    const STATUS_INWORK = 'inwork';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const ACTION_PUBLISH = 'publish';
    const ACTION_RESPOND = 'respond';
    const ACTION_REFUSE = 'refuse';
    const ACTION_COMPLETE = 'complete';

    public $idPerfomer = '';
    public $idCustomer = '';

    public function __construct($idPerfomer, $idCustomer) {
        $this->idPerfomer = $idPerfomer;
        $this->idCustomer = $idCustomer;

    }


}