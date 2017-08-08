<?php if ($nbr_elements > $elements_limit_by_page): ?>
	<nav>
		<ul class="pagination justify-content-center">
			<?php for ($i = 1; $i <= ceil($nbr_elements / $elements_limit_by_page); $i++): ?>
				<?php if ((!isset($current_route->vars()['page']) && $i == 1) || (isset($current_route->vars()['page']) && $i == $current_route->vars()['page'])): ?>
					<li class="page-item active"><span class="page-link"><?= $i ?></span><span class="sr-only">(active)</span></li>
				<?php else: ?>
					<li class="page-item"><a class="page-link" href="<?= $current_route->name() == 'root' ? $path('episodes', [$i]) : $path($current_route->name(), [$i]) ?>"><?= $i ?></a></li>
				<?php endif; ?>
			<?php endfor; ?>
		</ul>
	</nav>
<?php endif; ?>
