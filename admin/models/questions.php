<?php
defined("_JEXEC") or die();

class TestingModelQuestions extends JModelList {

    public function __construct($config = array())
    {
        $config['filter_fields'] = array('document_id', 'question', 'type');
        parent::__construct($config);
    }

    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("a.id, b.name as document_id, a.question, a.type");
        $query->from("#__test_questions as a");
        $query->join("LEFT", "#__test_documents as b on (a.document_id = b.id)");

        $search = $query->escape($this->getState('filter.search'));
        if (!empty($search)) {
            $query->where('b.name regexp "' . (string)$search . '"');
        }

        $search = $query->escape($this->getState('filter.question'));
        if (!empty($search)) {
            $query->where('question regexp "' . (string)$search . '"');
        }

        $search = (string)$this->getState('filter.type');
        if ($search != '') {
            $query->where('type = ' . $search);
        }

        $orderColumn = $query->escape($this->getState('list.ordering', 'id'));
        $orderDirection = $query->escape($this->getState('list.direction', 'desc'));
        $query->order($orderColumn." ".$orderDirection);

        return $query;
    }

    public function populateState($ordering = null, $direction = null)
    {
        parent::populateState('id', 'asc');
    }
}

?>
