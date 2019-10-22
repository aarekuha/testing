<?php
defined("_JEXEC") or die();

class TestingControllerUsertickets extends JControllerAdmin {
    public function getModel($name = 'Usertickets', $prefix = 'TestingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}

?>
