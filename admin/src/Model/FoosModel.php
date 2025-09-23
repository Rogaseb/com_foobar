<?php

namespace FooSpace\Component\Foobar\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class FoosModel extends ListModel
{
    protected function getListQuery()
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__foobar_foos', 'a'));

        return $query;
    }

    public function getTable($name = 'Foo', $prefix = 'Table', $options = array())
    {
        if ($table = $this->_createTable($name, $prefix, $options))
        {
            return $table;
        }
        return null;
    }
}
