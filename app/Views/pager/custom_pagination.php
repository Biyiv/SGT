<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(1);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pagination">
		<?php if ($pager->hasPrevious()) : ?>
			<li>
				<a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">Premier</a>
			</li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link): ?>
			<li class="<?= $link['active'] ? 'active' : '' ?>">
				<a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
			<li>
				<a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">Dernier</a>
			</li>
		<?php endif ?>
	</ul>
</nav>
