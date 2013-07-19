<?php
	$presenter = new Gorilla\Extensions\Pagination\FoundationPresenter($paginator);
	$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="pagination">
		<?php
			echo $presenter->getPrevious($trans->trans('pagination.previous'));
			echo $presenter->getNext($trans->trans('pagination.next'));
		?>
	</ul>
<?php endif; ?>
