<?php

namespace FooSpace\Component\Foobar\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseInterface;

class FooTable extends Table
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct('#__foobar_foos', 'id', $db);
    }

    public function check()
    {
        // 1) Wymagany tytuł
        if (trim((string) $this->title) === '') {
            throw new \UnexpectedValueException(Text::_('COM_FOOBAR_ERROR_TITLE_REQUIRED'));
        }

        // 2) Alias z tytułu (z obsługą ustawienia unicodeslugs) lub normalizacja podanego
        $unicodeslugs = (int) Factory::getApplication()->get('unicodeslugs');

        if (empty($this->alias)) {
            $this->alias = $unicodeslugs === 1
                ? OutputFilter::stringURLUnicodeSlug((string) $this->title)
                : OutputFilter::stringURLSafe((string) $this->title);
        } else {
            $this->alias = $unicodeslugs === 1
                ? OutputFilter::stringURLUnicodeSlug((string) $this->alias)
                : OutputFilter::stringURLSafe((string) $this->alias);
        }

        // 3) Fallback gdyby alias po filtrze był pusty
        if ($this->alias === '') {
            $this->alias = uniqid('foo-', false);
        }

        // 4) Sprawdzenie unikalności aliasu
        $table = new static($this->getDbo());

        if ($table->load(['alias' => $this->alias]) && ((int) $table->id !== (int) $this->id || (int) $this->id === 0)) {
            // Rekord istnieje pod tym aliasem i to nie jesteśmy "my"

            // Jeśli znaleziony rekord jest w koszu
            if ((int) ($table->state ?? 0) === -2) {
                throw new \UnexpectedValueException(Text::_('COM_FOOBAR_ERROR_ALIAS_CONFLICT_TRASHED'));
            }

            throw new \UnexpectedValueException(Text::_('COM_FOOBAR_ERROR_ALIAS_UNIQUE'));
        }

        //5) Pozostałe sprawdzenia z klasy bazowej
        return parent::check();
    }
}
