<?php

namespace FooSpace\Component\Foobar\Administrator\View\Foos;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

\defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        $wa = $this->getDocument()->getWebAssetManager();
        $wa->registerAndUseStyle('com_foobar.admin', 'media/com_foobar/css/admin.css');

        /** @var FoosModel $model */
        $model = $this->getModel();

        $this->items = $model->getItems();

        HTMLHelper::_('behavior.multiselect');
        
        if (!\count($this->items) && $model->getIsEmptyState()) {
            $this->setLayout('emptystate');
        }

        parent::display($tpl); 
    }
}
