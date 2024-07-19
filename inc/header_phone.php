<?php
$options_phone = $optionsArr['main_phone'];

if (is_page_utm_double_custom()) {
	$options_phone = $optionsArr['main_phone_double'];
}
?>

<a href="tel:+<?php echo get_numbers_from_str($options_phone);?>" class="header__tel"><?php echo $options_phone;?></a>