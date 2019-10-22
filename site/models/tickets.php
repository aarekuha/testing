<?php
defined('_JEXEC') or die;

class TestingModelTickets extends JModelList {

    protected function getListQuery()
    {
        $query = parent::getListQuery();
        $query->select("a.id, a.rating, a.status");
        $query->from("#__test_users_tickets as a");

        $query->join("left", "#__test_users as c on (a.user_id = c.id)");

        $token = JFactory::getSession()->get('user_token');
        $query->where("`token` = " . $query->quote($query->escape($token)));

        return $query;
    }
}

?>