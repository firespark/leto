<div>
	<table id="clients" class="table table-striped table-bordered table-hover">
		<tr>
			<th>Статус</th>
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
			<th class="td-wide">URL-referrer</th>
			<th>IP пользователя</th>
			<th></th>
			<th><input type="checkbox" class="form-check-input" autocomplete="off" id="checkAllInputs"></th>
			
		</tr>
		<?php if(!empty($calc_prices)):?>
		<?php foreach ($calc_prices as $key => $calc_price):?>
			
			<tr class="trLine tr<?php echo $calc_price->id;?><?php if($calc_price->active == 0) echo ' inactive';?>">
				<td><?php echo ($calc_price->active) ? 'Активный' : 'Неактивный';?></td>
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
				<td class="td-wide"><?php echo $calc_price->utm_referrer;?></td>
				<td style="word-break: break-all;"><?php echo $calc_price->utm_user_ip;?></td>
				<td class="delete_calc_price" data-id="<?php echo $calc_price->id;?>"><span style="cursor: pointer">&#10008;</span></td>
				<td><input type="checkbox" class="checkCargoInput" autocomplete="off" data-id="<?php echo $calc_price->id;?>"></td>
				
			</tr>
			

		<?php endforeach;?>
		<?php endif;?>
		
	</table>
</div>