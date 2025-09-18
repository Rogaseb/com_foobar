<?php

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

/** @var \Joomla\Component\Foobar\Administrator\View\Foos\HtmlView $this */

$displayData = [
    'textPrefix' => 'COM_FOOBAR',
    'helpURL'    => 'https://docs.joomla.org/J3.x:Managing_Foobars',
    'icon'       => 'icon-foobar foobar',
    'createURL'  => 'index.php?option=com_foobar&task=foo.add',
];

echo LayoutHelper::render('joomla.content.emptystate', $displayData);
