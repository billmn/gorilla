<?php
	$presenter = new Gorilla\Extensions\Pagination\FoundationPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="pagination">
		<?php echo $presenter->render(); ?>
	</ul>
<?php endif; ?>