<?php if (empty($this->items)) : ?>
    <?php echo $this->loadTemplate('emptystate'); ?>
<?php else : ?>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nazwa</th>
			<th>Alias</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->items as $i => $item) { ?>
			<tr>
				<td><?php echo (int) $item->id; ?></td>
				<td><?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?></td>
				<td><?php echo htmlspecialchars($item->alias, ENT_QUOTES, 'UTF-8'); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php endif; ?>
