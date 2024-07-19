<?php include 'inc/header.php';?>

<h1>Цены калькулятора</h1>

<form class="form-inline mb-3" id="searchPrice">
  
  	<div class="form-group mb-2">
   
    	<input id="searchInputPrice" type="text" class="form-control mr-2" placeholder="Поиск" autocomplete="off" value="">
  	</div>
  	<button type="submit" class="btn btn-primary mb-2">Найти запись по городу или fias-коду</button>
</form>
<button id="deleteAllCalcPrices" class="btn btn-danger mb-3">Очистить таблицу</button>

<div class="filters">
	<h4 class="text-center">Фильтры</h4>

	<div class="filters-wrapper">
		<div class="filters__inner">
			<p class="text-center"><strong>Типы</strong></p>
			<div class="form-group">
				<label for="sel1">Грузоподъемность:</label>
				
				<select class="form-control" id="sel1" autocomplete="off">
					<option class="option_link" value="All">Все</option>
					<?php if(!empty($load_capacities)):?>
					<?php foreach($load_capacities as $load_capacity):?>
			
					<option class="option_link" value="<?php echo $load_capacity->load_capacity;?>"><?php echo $load_capacity->load_capacity;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				
			</div> 

			<div class="form-group">
				<label for="sel2">Тип кузова:</label>
				
				<select class="form-control" id="sel2"autocomplete="off">
					<option class="option_link" value="All">Все</option>
					<?php if(!empty($body_types)):?>
					<?php foreach($body_types as $body_type):?>
			
					<option class="option_link" value="<?php echo $body_type->body_type;?>"><?php echo $body_type->body_type;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				
			</div> 
		</div>

		<div class="filters__inner">
			<p class="text-center"><strong>Источники входа</strong></p>
			<div class="form-group">
				<label>utm_source:</label>
				
				<select class="form-control" autocomplete="off" name="utm_source">
					<option class="option_link" value="All">Все</option>
					<option class="option_link" value="Unisender">Unisender</option>
					<option class="option_link" value="Unisender">Yandex</option>
				</select>
				
			</div>

			<div class="form-group">
				<label>utm_medium:</label>
				
				<select class="form-control" autocomplete="off" name="utm_medium">
					<option class="option_link" value="All">Все</option>
					<option class="option_link" value="cpc">cpc</option>
					<option class="option_link" value="email">email</option>
				</select>
				
			</div>

			<div class="form-group">
				<label>utm_campaign:</label>
				
				<select class="form-control" autocomplete="off" name="utm_campaign">
					<option class="option_link" value="All">Все</option>
					<option class="option_link" value="series-3">series-3</option>
					<option class="option_link" value="111828952">111828952</option>
				</select>
				
			</div>
		</div>

		<div class="filters__inner">
			<p class="text-center"><strong>Дата</strong></p>
			<div class="date-filter">
			
				<div class="form-group mb-0">
					
					<label class="radio-inline">
						<input type="radio" name="dateRange" value="allTime" id="allTimeDateRange" checked> Весь период
					</label>
					<label class="radio-inline">
						<input type="radio" name="dateRange" value="lastMonth"> Прошлый месяц
					</label>
					<label class="radio-inline">
						<input type="radio" name="dateRange" value="lastWeek"> Прошлая неделя
					</label>
					<label class="radio-inline">
						<input type="radio" name="dateRange" value="yesterday"> Вчера
					</label>
					<label class="radio-inline">
						<input type="radio" name="dateRange" value="custom" id="customDateRange"> Свой диапазон
					</label>
				</div>
				
				<div class="custom-date-range">
					<div class="form-group mb-1">
						<label for="startDate">Диапозон дат:</label>
						<input type="text" class="form-control datepicker" id="startDate" placeholder="С">
						<input type="text" class="form-control datepicker" id="endDate" placeholder="До">
					</div>
					<button type="button" class="btn btn-secondary mr-2" id="clearBtn">Очистить</button>
					<div id="errorMessage"></div>
				</div>
			</div>
		</div>
	</div>
	<button type="button" class="btn btn-primary" id="applyBtn">Применить</button>
</div>




<div class="calc-prices__links">
	<div class="d-flex">
		<div class="text-right mb-2 mr-2"><a href="#" id="selectAllCalcPrices">Все</a></div>
		<div class="vertical-line"></div>
		<div class="text-right mb-2 mr-2"><a href="#" id="selectActiveCalcPrices">Активные</a></div>
		<div class="vertical-line"></div>
		<div class="text-right mb-2 mr-2"><a href="#" id="selectInactiveCalcPrices">Неактивные</a></div>
		<div class="vertical-line"></div>
		<div class="text-right mb-2 mr-2"><a href="#" id="selectCartCalcPrices">Корзина</a></div>
	</div>
	<div class="text-right mb-2 mr-2"><a href="#" id="deleteSelectedCalcPrices">Удалить выбранные записи</a></div>
</div>
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
				<td style="min-width: 175px; max-width: 175px; word-break: break-word;"><?php echo $calc_price->utm_referrer;?></td>
				<td style="word-break: break-all;"><?php echo $calc_price->utm_user_ip;?></td>
				<td class="delete_calc_price" data-id="<?php echo $calc_price->id;?>"><span style="cursor: pointer">&#10008;</span></td>
				<td><input type="checkbox" class="checkCargoInput" autocomplete="off" data-id="<?php echo $calc_price->id;?>"></td>
				
			</tr>
			

		<?php endforeach;?>
		<?php endif;?>
		
	</table>
</div>
<div id="pagination"><?php echo $navi;?></div>