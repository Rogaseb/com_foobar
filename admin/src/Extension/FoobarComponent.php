<?php

namespace FooSpace\Component\Foobar\Administrator\Extension;

use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\MVCComponent;

\defined('_JEXEC') or die;

class FoobarComponent extends MVCComponent implements RouterServiceInterface
{
    use RouterServiceTrait;
}
