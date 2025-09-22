<?php

namespace FooSpace\Component\Foobar\Administrator\View\Foo;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use FooSpace\Component\Foobar\Administrator\Model\FooModel;

class HtmlView extends BaseHtmlView
{
    protected $form;

    public function display($tpl = null)
    {
        /** @var FooModel $model */
        $model = $this->getModel();

        $this->form = $model->getForm();
        $this->item = $model->getItem();

        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        $isNew = ($this->item->id == 0);

        Factory::getApplication()->getInput()->set('hidemainmenu', true);

        ToolbarHelper::title($isNew ? Text::_('COM_FOOBAR_FOO_NEW') : Text::_('COM_FOOBAR_FOO_EDIT'), 'pencil');
        
        ToolbarHelper::apply('foo.apply');
        ToolbarHelper::save('foo.save');
        ToolbarHelper::cancel('foo.cancel');
    }
}
