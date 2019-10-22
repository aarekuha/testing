<?php
defined("_JEXEC") or die();

class TestingModelTickets extends JModelList {

    public function __construct($config = array())
    {
        $config['filter_fields'] = array('fio', 'rating', 'status');
        parent::__construct($config);
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("a.id, user_id, rating, status");
        $query->from("#__test_users_tickets as a");

        $query->select("fio");
        $query->join("left", "#__test_users as b on (b.id = user_id)");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->where('name regexp "' . (string)$search . '" or value regexp "' . (string)$search . '"');
        }

        $orderColumn = $query->escape($this->getState('list.ordering', 'id'));
        $orderDirection = $query->escape($this->getState('list.direction', 'desc'));
        $query->order($orderColumn." ".$orderDirection);

        return $query;
    }

    public function populateState($ordering = null, $direction = null)
    {
        parent::populateState('id', 'desc');
    }
}

?>
