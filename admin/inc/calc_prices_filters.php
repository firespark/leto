<div class="filters">
	<h4 class="text-center">Фильтры</h4>

	<div class="filters-wrapper">
		<div class="filters__inner">
			<p class="text-center"><strong>Типы</strong></p>
			<div class="form-group">
				<label for="sel1">Грузоподъемность:</label>
				
				<select class="form-control" id="sel1" autocomplete="off">
					<option class="option_link" value="0">Все</option>
					<?php if(!empty($load_capacities)):?>
					<?php foreach($load_capacities as $load_capacity):?>
			
					<option 
						class="option_link" 
						value="<?php echo $load_capacity->load_capacity;?>"
						<?php if (isset($_GET['load_capacity']) && $_GET['load_capacity'] == $load_capacity->load_capacity):?>
						selected
						<?php endif;?>
					>
						<?php echo $load_capacity->load_capacity;?>
					</option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				
			</div> 

			<div class="form-group">
				<label for="sel2">Тип кузова:</label>
				
				<select class="form-control" id="sel2"autocomplete="off">
					<option class="option_link" value="0">Все</option>
					<?php if(!empty($body_types)):?>
					<?php foreach($body_types as $body_type):?>
			
					<option 
						class="option_link" 
						value="<?php echo $body_type->body_type;?>"
						<?php if (isset($_GET['body_type']) && $_GET['body_type'] == $body_type->body_type):?>
						selected
						<?php endif;?>
					>
						<?php echo $body_type->body_type;?>
					</option>
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
					<option class="option_link" value="0">Все</option>
					<?php if(!empty($utm_sources)):?>
					<?php foreach($utm_sources as $utm_source):?>
					<?php if($utm_source->utm_source):?>
					<option 
						class="option_link" 
						value="<?php echo $utm_source->utm_source;?>"
						<?php if (isset($_GET['utm_source']) && $_GET['utm_source'] == $utm_source->utm_source):?>
						selected
						<?php endif;?>
					>
						<?php echo $utm_source->utm_source;?>
					</option>
					<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				
			</div>

			<div class="form-group">
				<label>utm_medium:</label>
				
				<select class="form-control" autocomplete="off" name="utm_medium">
					<option class="option_link" value="0">Все</option>
					<?php if(!empty($utm_mediums)):?>
					<?php foreach($utm_mediums as $utm_medium):?>
					<?php if($utm_medium->utm_medium):?>
					<option 
						class="option_link" 
						value="<?php echo $utm_medium->utm_medium;?>"
						<?php if (isset($_GET['utm_medium']) && $_GET['utm_medium'] == $utm_medium->utm_medium):?>
						selected
						<?php endif;?>
					>
						<?php echo $utm_medium->utm_medium;?>
					</option>
					<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				
			</div>

			<div class="form-group">
				<label>utm_campaign:</label>
				
				<select class="form-control" autocomplete="off" name="utm_campaign">
					<option class="option_link" value="0">Все</option>
					<?php if(!empty($utm_campaigns)):?>
					<?php foreach($utm_campaigns as $utm_campaign):?>
					<?php if($utm_campaign->utm_campaign):?>
					<option 
						class="option_link" 
						value="<?php echo $utm_campaign->utm_campaign;?>"
						<?php if (isset($_GET['utm_campaign']) && $_GET['utm_campaign'] == $utm_campaign->utm_campaign):?>
						selected
						<?php endif;?>
					>
						<?php echo $utm_campaign->utm_campaign;?>
					</option>
					<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				
			</div>

			
		</div>

		<div class="filters__inner">
			<p class="text-center"><strong>Дата</strong></p>
			<div class="date-filter">
			
				<div class="form-group mb-0">
					
					<label class="radio-inline">
						<input 
							type="radio" 
							name="dateRange" 
							value="allTime" 
							id="allTimeDateRange" 
							<?php if ( (!isset($_GET['start_date']) && !$_GET['start_date']) && (!isset($_GET['end_date']) && !$_GET['end_date']) ):?>
							checked
							<?php endif;?>
						> Весь период
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
						<input 
							type="radio" 
							name="dateRange" 
							value="custom" 
							id="customDateRange"
							<?php if ( (isset($_GET['start_date']) && $_GET['start_date']) || (isset($_GET['end_date']) && $_GET['end_date']) ):?>
							checked
							<?php endif;?>
						> Свой диапазон
					</label>
				</div>
				
				<div class="custom-date-range">
					<div class="form-group mb-1">
						<label for="startDate">Диапозон дат:</label>
						<input 
							type="text" 
							class="form-control datepicker" 
							id="startDate" 
							placeholder="С"
							<?php if ( isset($_GET['start_date']) && $_GET['start_date']):?>
							value="<?php echo $_GET['start_date'];?>"
							<?php endif;?>
						>
						<input 
							type="text" 
							class="form-control datepicker" 
							id="endDate" 
							placeholder="До"
							<?php if ( isset($_GET['end_date']) && $_GET['end_date']):?>
							value="<?php echo $_GET['end_date'];?>"
							<?php endif;?>
						>
					</div>
					<button type="button" class="btn btn-secondary mr-2" id="clearBtn">Очистить</button>
					<div id="errorMessage"></div>
				</div>
			</div>
		</div>
	</div>
	<input 
		type="hidden" 
		id="startDateValue" 
		value="<?php echo (isset($_GET['start_date']) && $_GET['start_date']) ? $_GET['start_date'] : 0 ;?>"
	>
	<input 
		type="hidden" 
		id="endDateValue" 
		value="<?php echo (isset($_GET['end_date']) && $_GET['end_date']) ? $_GET['end_date'] : 0 ;?>"
	>
	<button type="button" class="btn btn-primary" id="applyBtn">Применить</button>
	<a type="button" class="btn btn-warning" href="/wp-admin/admin.php?page=calc_prices_view">Очистить фильтры</a>
</div>