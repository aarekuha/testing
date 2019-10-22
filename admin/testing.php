<?php
defined("_JEXEC") or die();

$controller = JControllerLegacy::getInstance("Testing");
JLoader::register("TestingHelper", __DIR__."/helpers/testing.php");
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd("task", "display"));
$controller->redirect();

?>