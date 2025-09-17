<?php

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

/** @var \Joomla\Component\Tags\Administrator\View\Tags\HtmlView $this */

$displayData = [
    'textPrefix' => 'COM_FOOBAR',
    'formURL'    => 'index.php?option=com_foobar&task=foo.add',
    'helpURL'    => 'https://docs.joomla.org/J3.x:Managing_Foobars',
    'icon'       => 'icon-foobar foobar',
];

if ($this->getCurrentUser()->authorise('core.create', 'com_foobar')) {
    $displayData['createURL'] = 'index.php?option=com_foobar&task=foo.add';
}

echo LayoutHelper::render('joomla.content.emptystate', $displayData);
