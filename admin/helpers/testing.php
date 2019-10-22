<?php
defined("_JEXEC") or die();

abstract class TestingHelper {
    public static function addSubMenu($viewName)
    {
        JHtmlSidebar::addEntry(JText::_("COM_TESTING_MENU_USERS"),
            'index.php?option=com_testing&view=users',
            $viewName == 'users');

        JHtmlSidebar::addEntry(JText::_("COM_TESTING_MENU_DOCUMENTS"),
            'index.php?option=com_testing&view=documents',
            $viewName == 'documents');

        JHtmlSidebar::addEntry(JText::_("COM_TESTING_MENU_TICKETS"),
            'index.php?option=com_testing&view=tickets',
            $viewName == 'tickets');

        return JHtmlSidebar::render();
    }
}

?>
