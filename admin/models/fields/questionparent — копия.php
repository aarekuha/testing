<?php
defined("_JEXEC") or die();

JFormHelper::loadFieldClass("list");

class JFormFieldQuestionparent extends JFormFieldList {
    protected function getOptions()
    {
//        $options = array();
        $db  = JFactory::getDbo();
        $query = $db->getQuery(TRUE);
        $query->select('id as "value", name as "text"')
              ->from('#__test_documents');

        $db->setQuery($query);
        try {
            $row = $db->loadObjectList();
        } catch(RuntimeException $e) {
            JError::raiseWarning(500, $e->getMessage());
        }

//        $parent = new stdClass;
//        $parent->text = JText::_('JGLOBAL_ROOT_PARENT');
//        $parent->value = 0;

//        if ($row) {
//            for ($i = 0; $i < count($row); $i++) {
////                $tmpArray = new stdClass;
////                $tmpArray->text = $row[$i]->name;
////                $tmpArray->value = $row[$i]->id;
//
////                array_push($options, $tmpArray);
//                print_r($row);
//                array_push($options, $row);
//            }
//        }
//
//        return $options;
//        return parent::getOptions(); // TODO: Change the autogenerated stub
        return $row;
    }
}

?>