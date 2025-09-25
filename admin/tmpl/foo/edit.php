<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

?>

<form action="<?php echo Route::_('index.php?option=com_foobar&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" aria-label="<?php echo Text::_('COM_FOOS_FORM_TITLE_' . ((int) $this->item->id === 0 ? 'NEW' : 'EDIT'), true); ?>" class="form-validate">

    <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

    <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details', 'recall' => true, 'breakpoint' => 768]); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('COM_FOOBAR_FIELDSET_DETAILS')); ?>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php echo $this->form->renderFieldset('details'); ?>
                </div>
            </div>

        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
        
            <div class="row">
                <div class="col-12 col-lg-6">
                    <fieldset id="fieldset-publishingdata" class="options-form">
                        <legend><?php echo Text::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></legend>
                        <div>
                            <?php echo $this->form->renderFieldset('publishing'); ?>
                        </div>
                    </fieldset>
                </div>
            </div>

        <?php echo HTMLHelper::_('uitab.endTab'); ?>

    <?php echo HTMLHelper::_('uitab.endTabSet'); ?>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
