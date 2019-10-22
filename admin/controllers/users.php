<?php
defined("_JEXEC") or die();

class TestingControllerUsers extends JControllerAdmin {
    public function getModel($name = 'User', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}

?>
