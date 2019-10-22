<?php
defined('_JEXEC') or die;

if (empty(JFactory::getSession()->get('user_token'))) {
    die;
}

$controller = JControllerLegacy::getInstance('Testing');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task', 'display'));

$controller->redirect();
?>