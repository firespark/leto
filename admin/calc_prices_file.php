<?php include 'inc/header.php';?>

<h1><?php echo $title;?></h1>

<?php 
include 'inc/calc_prices_search.php';

if (!isset($_GET['search']) && !$_GET['search']) {
	include 'inc/calc_prices_filters.php';
}

include 'inc/calc_prices_links.php';

include 'inc/calc_prices_table.php';

include 'inc/calc_prices_pagination.php';

include 'inc/calc_prices_clear_table.php';