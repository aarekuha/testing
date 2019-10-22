<?php

defined('_JEXEC') or die('Restricted access');

class TestingModelModalusers extends JModelList
{
    public function __construct($config = array())
    {
        $config['filter_fields'] = array('fio', 'email');
        parent::__construct($config);
    }

    public function populateState($ordering = 'fio', $direction = 'asc')
    {
        parent::populateState('fio', 'asc');
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("id, fio, email");
        $query->from("#__test_users");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->where('fio regexp "' . (string)$search . '"');
        }

        $orderColumn = $query->escape($this->state->get('list.ordering', 'fio'));
        $orderDirection = $query->escape($this->state->get('list.direction', 'desc'));
        $query->order($orderColumn." ".$orderDirection);

        return $query;
    }

}