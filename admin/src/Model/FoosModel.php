<?php

namespace FooSpace\Component\Foobar\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

class FoosModel extends ListModel
{
    public function __construct($config = [], ?MVCFactoryInterface $factory = null)
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = [
                'a.id','id',
                'a.title','title',
                'a.state','state',
                'published',
            ];
        }

        parent::__construct($config, $factory);
    }

    protected function getListQuery()
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select([
                $db->quoteName('a.id'),
                $db->quoteName('a.title'),
                $db->quoteName('a.alias'),
                $db->quoteName('a.state'),
                $db->quoteName('a.ordering'),
            ])
            ->from($db->quoteName('#__foobar_foos', 'a'));

        $published = (string) $this->getState('filter.published');

        if (is_numeric($published)) {
            $published = (int) $published;
            $query->where($db->quoteName('a.state') . ' = :published')
                ->bind(':published', $published, ParameterType::INTEGER);
        } elseif ($published === '') {
            $query->where($db->quoteName('a.state') . ' IN (0, 1)');
        }

        $search = (string) $this->getState('filter.search');
        if ($search !== '') {
            if (stripos($search, 'id:') === 0) {
                $id = (int) substr($search, 3);
                $query->where($db->quoteName('a.id') . ' = :id')
                    ->bind(':id', $id, ParameterType::INTEGER);
            } else {
                $token = '%' . str_replace(' ', '%', trim($search)) . '%';
                $query->where(
                    '(' . $db->quoteName('a.title') . ' LIKE :tok1'
                    . ' OR ' . $db->quoteName('a.alias') . ' LIKE :tok2)'
                );
                $query->bind([':tok1', ':tok2'], $token, ParameterType::STRING);
            }
        }

        $orderCol  = $this->state->get('list.ordering', 'a.title');
        $orderDirn = $this->state->get('list.direction', 'asc');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.published');

        return parent::getStoreId($id);
    }

    protected function populateState($ordering = 'a.title', $direction = 'ASC')
    {
        parent::populateState($ordering, $direction);
    }
}
