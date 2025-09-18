<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

?>

<?php if (empty($this->items)) : ?>
    <?php echo $this->loadTemplate('emptystate'); ?>
<?php else : ?>

<form action="<?php echo Route::_('index.php?option=com_foobar&view=foos'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-main-container" class="j-main-container">

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-info">
                <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><?php echo HTMLHelper::_('grid.checkall'); ?></th>
					<th>ID</th>
					<th>Nazwa</th>
					<th>Alias</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->items as $i => $item) { ?>
					<tr>
						<td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
						<td><?php echo (int) $item->id; ?></td>
						<td>
							<a href="<?php echo Route::_('index.php?option=com_foobar&task=foo.edit&id=' . $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape($item->title); ?>">
							<?php echo $this->escape($item->title); ?></a>
						</td>
						<td>
							<?php echo $this->escape($item->alias); ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php endif; ?>

		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>
<?php endif; ?>

