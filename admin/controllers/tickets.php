<?php
defined("_JEXEC") or die();

class TestingControllerTickets extends JControllerAdmin {
    public function getModel($name = 'Ticket', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}

?>
