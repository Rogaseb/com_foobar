<?php

namespace FooSpace\Component\Foobar\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class FooModel extends AdminModel
{
	public function getForm($data = array(), $loadData = true)
	{
        $form = $this->loadForm('com_foobar.foo', 'foo', ['control' => 'jform', 'load_data' => $loadData]);

        if (empty($form)) {
            return false;
        }

        return $form;
	}

    protected function loadFormData()
    {
        /** @var \Joomla\CMS\Application\CMSApplication $app */
        $app  = Factory::getApplication();
        $data = $app->getUserState('com_foobar.edit.foo.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    protected function prepareTable($table)
    {
        $date = Factory::getDate();
        $user = $this->getCurrentUser();

        if (empty($table->id)) {
        $table->created    = $date->toSql();  
        $table->created_by = (int) ($table->created_by ?: $user->id);
        }
    }

    public function save($data)
    {
        return parent::save($data);
    }
}
