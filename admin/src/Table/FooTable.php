<?php

namespace FooSpace\Component\Foobar\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseInterface;

class FooTable extends Table
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct('#__foobar_foos', 'id', $db);
    }
}
