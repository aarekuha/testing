<?php
defined("_JEXEC") or die();

class TestingTableUser extends JTable {
    public function __construct($db)
    {
        parent::__construct('#__test_users', 'id', $db);
    }
}
?>
