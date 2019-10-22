<?php
defined("_JEXEC") or die();

class TestingModelUsers extends JModelList {

    public function __construct($config = array())
    {
        $config['filter_fields'] = array('fio', 'email');
        parent::__construct($config);
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("id, fio, email, password");
        $query->from("#__test_users");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->where('fio regexp "' . (string)$search . '" or email regexp "' . (string)$search . '"');
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
