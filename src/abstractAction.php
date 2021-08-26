<?php
namespace App;

abstract class AbstractAction {

    protected $idCurrentUser;
    protected $idCustomer;
    protected $idExecute;

    abstract public function getNameAction();
    abstract public function getInnerNameAction();
    abstract public function validateAccessUser(int $idCurrentUser, int $idCustomer, int $idExecute);
}
