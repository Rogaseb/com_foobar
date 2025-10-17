<?php

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('table.columns')
    ->useScript('multiselect');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo Route::_('index.php?option=com_foobar&view=foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div id="j-main-container" class="j-main-container">

        <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-info">
                <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td class="w-1 text-center">
                        <?php echo HTMLHelper::_('grid.checkall'); ?>
                    </td>
                    <th scope="col">
                        <?php echo HTMLHelper::_('searchtools.sort','JGLOBAL_TITLE','a.title',$listDirn,$listOrder); ?>
                    </th>
                    <th scope="col" class="d-none d-md-table-cell">
                        <?php echo Text::_('JFIELD_ALIAS_LABEL'); ?>
                    </th>
                    <th scope="col" class="w-5 d-none d-md-table-cell">
                        <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $item) { ?>
                    <tr>
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <th scope="row">
                            <a href="<?php echo Route::_('index.php?option=com_foobar&task=foo.edit&id='.(int)$item->id); ?>">
                                <?php echo $this->escape($item->title); ?>
                            </a>
                        </th>
                        <td>
                            <?php echo $this->escape($item->alias); ?>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <?php echo $item->id; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo $this->pagination->getListFooter(); ?>
        <?php endif; ?>

        <input type="hidden" name="task" value="">
        <input type="hidden" name="boxchecked" value="0">
        <?php echo HTMLHelper::_('form.token'); ?>
    </div>
</form>
