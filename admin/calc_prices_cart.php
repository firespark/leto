<?php include 'inc/header.php';?>

<h1><?php echo $title;?></h1>

<?php 
//include 'inc/calc_prices_search.php';

if (!isset($_GET['search']) && !$_GET['search']) {
	include 'inc/calc_prices_filters.php';
}

?>

<div class="calc-prices__links">
	<?php include 'inc/calc_prices_links.php'; ?>
	<?php include 'inc/calc_prices_delete_many_cart.php'; ?>
	
</div>

<?php

include 'inc/calc_prices_table.php';

include 'inc/calc_prices_pagination.php';

include 'inc/calc_prices_clear_cart.php';