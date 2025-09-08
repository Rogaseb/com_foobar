<?php

namespace FooSpace\Component\Foobar\Administrator\View\Foo;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use FooSpace\Component\Foobar\Administrator\Model\FooModel;

class HtmlView extends BaseHtmlView
{
    protected $form;

    public function display($tpl = null)
    {
        /** @var FooModel $model */
        $model = $this->getModel();

        $this->form  = $model->getForm();

        parent::display($tpl);
    }
}