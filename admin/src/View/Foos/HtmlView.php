<?php

namespace FooSpace\Component\Foobar\Administrator\View\Foos;

use Joomla\CMS\MVC\View\ListView;

\defined('_JEXEC') or die;

class HtmlView extends ListView
{
    protected $option = 'com_foobar';

    protected function initializeView()
    {
        parent::initializeView();

        $wa = $this->getDocument()->getWebAssetManager();
        $wa->useStyle('com_foobar.admin');

        $this->canDo = new class {
            public function get($action)
            {
                return true;
            }
        };
    }
}
