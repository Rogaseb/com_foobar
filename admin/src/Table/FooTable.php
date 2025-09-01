<?php

namespace FooSpace\Component\Foobar\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class FooTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__foobar_foos', 'id', $db);
    }
}
