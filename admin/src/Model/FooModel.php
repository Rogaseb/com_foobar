<?php

namespace FooSpace\Component\Foobar\Administrator\Model;

\defined('_JEXEC') or die;

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
}