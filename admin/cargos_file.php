<?php include 'inc/header.php';?>


<h1>Грузы</h1>

<div class="mb-4">
	<a type="button" class="btn btn-info" href="/wp-admin/admin.php?page=cargo_add">Добавить груз</a>
</div>

<div class="form-group mr-2" style="width: 200px; float: left">
  	<label for="sel1">Категория:</label>
  	
  	<select class="form-control" id="sel1" onchange="location = this.value;" autocomplete="off">
  		<option class="option_link" <?php if(!$cat_selected) echo 'selected';?> value="/wp-admin/admin.php?page=cargos_view">Все</option>
  		<?php if(!empty($cats)):?>
  		<?php foreach($cats as $value):?>
   
    	<option class="option_link"<?php if($cat_selected && $value->id == $cat_selected) echo 'selected';?> value="/wp-admin/admin.php?page=cargos_view&cat=<?php echo $value->id;?>"><?php echo $value->title;?></option>
   		<?php endforeach;?>
   		<?php endif;?>
  	</select>
  	
</div> 

<div class="form-group" style="width: 200px; float: left;">
  	<label for="sel2">Группа:</label>
  	
  	<select class="form-control" id="sel2" onchange="location = this.value;" autocomplete="off">
  		<option class="option_link"<?php if(!$group_id) echo ' selected';?> value="/wp-admin/admin.php?page=cargos_view<?php if($cat_selected) echo '&cat=' . $cat_selected;?>">Все</option>
  		<?php if(!empty($groups)):?>
  		<?php foreach($groups as $value):?>   
    	<option class="option_link"<?php if($group_id && $value->id == $group_id) echo ' selected';?> value="/wp-admin/admin.php?page=cargos_view&group=<?php echo $value->id;?>"><?php echo $value->title;?></option>
   		<?php endforeach;?>
   		<?php endif;?>
  	</select>
  	
</div> 

<div style="clear:both;"></div>


<form class="form-inline" id="search">
  
  	<div class="form-group mb-2">
   
    	<input id="searchInput" type="text" class="form-control mr-2" placeholder="Поиск" autocomplete="off" value="<?php echo (isset($search) && $search) ? $search : NULL;?>">
  	</div>
  	<button type="submit" class="btn btn-primary mb-2">Найти груз</button>
</form>

<div class="text-right mb-2 mr-2"><a href="#" id="deleteSelectedCargos">Удалить выбранные грузы</a></div>

<table id="clients" class="table table-striped table-bordered table-hover">
	<tr>
		<th>#</th>
		<th>Название</th>
		<th>Категория</th>
		<th>Группа</th>
		<th></th>
		<th><input type="checkbox" class="form-check-input" autocomplete="off" id="checkAllInputs"></th>
		
	</tr>
	<?php if(!empty($data)):?>
	<?php foreach ($data as $cargo):?>
		<tr class="tr<?php echo $cargo['id'];?>">
			<td><?php echo $cargo['id'];?></td>
			<td><a href="/wp-admin/admin.php?page=cargo_show&id=<?php echo $cargo['id'];?>"><?php echo $cargo['title'];?></a></td>
			<td><?php echo $cargo['cat_title'];?></td>
			<td><?php echo $cargo['group_title'];?></td>
			<td class="delete_cargo" data-id="<?php echo $cargo['id'];?>"><span style="cursor: pointer">&#10008;</span></td>
			<td><input type="checkbox" class="checkCargoInput" autocomplete="off" data-id="<?php echo $cargo['id'];?>"></td>
			
		</tr>
		

	<?php endforeach;?>
	<?php endif;?>
	
</table>
<div id="pagination"><?php echo $navi;?></div>