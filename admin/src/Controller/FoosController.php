<?php

namespace FooSpace\Component\Foobar\Administrator\Controller;

use Joomla\CMS\MVC\Controller\AdminController;

\defined('_JEXEC') or die;

class FoosController extends AdminController
{
	public function getModel($name = 'Foo', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
}
