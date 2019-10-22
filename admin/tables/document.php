<?php
defined("_JEXEC") or die();

class TestingTableDocument extends JTable {
    public function __construct($db)
    {
        parent::__construct('#__test_documents', 'id', $db);
    }
}
?>
