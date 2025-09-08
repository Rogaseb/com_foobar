<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

?>

<form action="<?php echo Route::_('index.php?option=com_foobar&view=foo&layout=edit'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">

    <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

    <div class="main-card">
    <?php echo $this->form->renderField('id'); ?>
    </div>

    <?php echo HTMLHelper::_('form.token'); ?>
</form>