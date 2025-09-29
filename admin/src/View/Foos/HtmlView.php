<?php

namespace FooSpace\Component\Foobar\Administrator\View\Foos;

use Joomla\CMS\MVC\View\ListView;

\defined('_JEXEC') or die;

class HtmlView extends ListView
{
    protected $option = 'COM_FOOBAR';

    protected function initializeView()
    {
        parent::initializeView();

        $this->canDo = new class {
            public function get($action)
            {
                return true;
            }
        };
    }
}
