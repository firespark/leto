<?php include 'inc/header.php';?>


<h1>Цены калькулятора</h1>


<div class="form-group mr-2" style="width: 200px; float: left">
  	<label for="sel1">Грузоподъемность:</label>
  	
  	<select class="form-control" id="sel1" onchange="location = this.value;" autocomplete="off">
  		<option class="option_link" <?php if(!$_GET['load_capacity']) echo 'selected';?> value="/wp-admin/admin.php?page=calc_prices_view">Все</option>
  		<?php if(!empty($load_capacities)):?>
  		<?php foreach($load_capacities as $load_capacity):?>
   
    	<option class="option_link"<?php if($_GET['load_capacity'] && $_GET['load_capacity'] == $load_capacity->load_capacity) echo 'selected';?> value="/wp-admin/admin.php?page=calc_prices_view&load_capacity=<?php echo $load_capacity->load_capacity;?>"><?php echo $load_capacity->load_capacity;?></option>
   		<?php endforeach;?>
   		<?php endif;?>
  	</select>
  	
</div> 

<div class="form-group" style="width: 200px; float: left;">
  	<label for="sel2">Тип кузова:</label>
  	
  	<select class="form-control" id="sel2" onchange="location = this.value;" autocomplete="off">
  		<option class="option_link" <?php if(!$_GET['body_type']) echo 'selected';?> value="/wp-admin/admin.php?page=calc_prices_view">Все</option>
  		<?php if(!empty($body_types)):?>
  		<?php foreach($body_types as $body_type):?>
   
    	<option class="option_link"<?php if($_GET['body_type'] && $_GET['body_type'] == $body_type->body_type) echo 'selected';?> value="/wp-admin/admin.php?page=calc_prices_view&body_type=<?php echo $body_type->body_type;?>"><?php echo $body_type->body_type;?></option>
   		<?php endforeach;?>
   		<?php endif;?>
  	</select>
  	
</div> 

<div style="clear:both;"></div>


<form class="form-inline mb-3" id="searchPrice">
  
  	<div class="form-group mb-2">
   
    	<input id="searchInputPrice" type="text" class="form-control mr-2" placeholder="Поиск" autocomplete="off" value="">
  	</div>
  	<button type="submit" class="btn btn-primary mb-2">Найти запись по городу или fias-коду</button>
</form>
<button id="deleteAllCalcPrices" class="btn btn-danger mb-3">Очистить таблицу</button>
<div class="text-right mb-2 mr-2"><a href="#" id="deleteSelectedCalcPrices">Удалить выбранные записи</a></div>
<div>
	<table id="clients" class="table table-striped table-bordered table-hover">
		<tr>
			<th>#</th>
			<th class="m-width-100">Грузо-подъем-ность</th>
			<th>Тип кузова</th>
			<th>Пункт отправления</th>
			<th>Пункт назначения</th>
			<th>Fias отправления</th>
			<th>Fias назначения</th>
			<th>Цена</th>
			<th>Дата</th>
			<th>utm_source</th>
			<th>utm_medium</th>
			<th>utm_campaign</th>
			<th>utm_term</th>
			<th>utm_content</th>
			<th>URL-referrer</th>
			<th>IP пользователя</th>
			<th></th>
			<th><input type="checkbox" class="form-check-input" autocomplete="off" id="checkAllInputs"></th>
			
		</tr>
		<?php if(!empty($calc_prices)):?>
		<?php foreach ($calc_prices as $key => $calc_price):?>
			
			<tr class="trLine tr<?php echo $calc_price->id;?>">
				<td><?php echo $key;?></td>
				<td class="m-width-100"><?php echo $calc_price->load_capacity;?></td>
				<td><?php echo $calc_price->body_type;?></td>
				<td><?php echo $calc_price->point1;?></td>
				<td><?php echo $calc_price->point2;?></td>
				<td><?php echo $calc_price->fias1;?></td>
				<td><?php echo $calc_price->fias2;?></td>
				<td><?php echo $calc_price->price;?></td>
				<td><?php echo $calc_price->create_date;?></td>
				<td><?php echo $calc_price->utm_source;?></td>
				<td><?php echo $calc_price->utm_medium;?></td>
				<td><?php echo $calc_price->utm_campaign;?></td>
				<td><?php echo $calc_price->utm_term;?></td>
				<td><?php echo $calc_price->utm_content;?></td>
				<td style="max-width: fit-content;"><?php echo $calc_price->utm_referrer;?></td>
				<td style="word-break: break-all;"><?php echo $calc_price->utm_user_ip;?></td>
				<td class="delete_calc_price" data-id="<?php echo $calc_price->id;?>"><span style="cursor: pointer">&#10008;</span></td>
				<td><input type="checkbox" class="checkCargoInput" autocomplete="off" data-id="<?php echo $calc_price->id;?>"></td>
				
			</tr>
			

		<?php endforeach;?>
		<?php endif;?>
		
	</table>
</div>
<div id="pagination"><?php echo $navi;?></div>