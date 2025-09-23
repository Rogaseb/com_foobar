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
        
        $this->addToolbar();

        if (!\count($this->items) && $model->getIsEmptyState()) {
            $this->setLayout('emptystate');
        }

        parent::display($tpl); 
    }

    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('COM_FOOBAR_MANAGER_FOOS'), 'pencil');

        ToolbarHelper::addNew('foo.add');
        ToolbarHelper::editList('foo.edit');
        
        ToolbarHelper::publish('foos.publish', 'JTOOLBAR_PUBLISH', true);
        ToolbarHelper::unpublish('foos.unpublish', 'JTOOLBAR_UNPUBLISH', true);
        ToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'foos.delete');
    }
}
