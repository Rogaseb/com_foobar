<?php

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;

$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('table.columns')
    ->useScript('multiselect');
$wa->useStyle('com_foobar.admin');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = ($listOrder === 'a.ordering');

if ($saveOrder && !empty($this->items)) {
    $saveOrderingUrl = 'index.php?option=com_foobar&task=foos.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
    HTMLHelper::_('draggablelist.draggable', 'fooList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<form action="<?php echo Route::_('index.php?option=com_foobar&view=foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">

                <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-info">
                        <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <thead>
                            <tr>
                            <td class="w-1 text-center">
                                <?php echo HTMLHelper::_('grid.checkall'); ?>
                            </td>
                            <th scope="col" class="w-1 text-center d-none d-md-table-cell">
                                <?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-sort'); ?>
                            </th>
                            <th scope="col" class="w-1 text-center">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                            </th>
                            <th scope="col">
                                <?php echo HTMLHelper::_('searchtools.sort','JGLOBAL_TITLE','a.title',$listDirn,$listOrder); ?>
                            </th>
                            <th scope="col" class="d-md-table-cell">
                                <?php echo Text::_('JFIELD_ALIAS_LABEL'); ?>
                            </th>
                            <th scope="col" class="w-5 d-none d-md-table-cell">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->items as $i => $item): ?>
                            <tr class="row<?php echo $i % 2; ?>" 
                                data-draggable-group="1"    
                                data-item-id="<?php echo (int) $item->id; ?>">
                                <td>
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td class="text-center d-none d-md-table-cell">
                                    <span class="sortable-handler<?php echo $saveOrder ? '' : ' inactive'; ?>"
                                            <?php echo $saveOrder ? '' : 'title="'.Text::_('JORDERINGDISABLED').'"'; ?>>
                                        <span class="icon-ellipsis-v" aria-hidden="true"></span>
                                    </span>
                                    <?php if ($saveOrder): ?>
                                        <input type="hidden" name="order[]" value="<?php echo (int) $item->ordering; ?>">
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('jgrid.published', $item->state, $i, 'foos.', true, 'cb'); ?>
                                </td>
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
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->pagination->getListFooter(); ?>
                <?php endif; ?>

                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
