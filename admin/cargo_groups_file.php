<?php include 'inc/header.php';?>

<h1>Группы грузов</h1>

<div class="mb-4">
	<a type="button" class="btn btn-info" href="/wp-admin/admin.php?page=cargo_group_add">Добавить группу</a>
</div>

<div class="form-group" style="width: 200px; float: left">
  	<label for="sel1">Категория:</label>
  	<?php if(!empty($cats)):?>
  	<select class="form-control" id="sel1" onchange="location = this.value;" autocomplete="off">
  		<option class="option_link" <?php if(!$cat_id) echo 'selected';?> value="/wp-admin/admin.php?page=cargo_groups_view">Все</option>
  		<?php foreach($cats as $value):?>
   
    	<option class="option_link"<?php if($cat_id && $value->id == $cat_id) echo 'selected';?> value="/wp-admin/admin.php?page=cargo_groups_view&cat=<?php echo $value->id;?>"><?php echo $value->title;?></option>
   		<?php endforeach;?>
  	</select>
  	<?php endif;?>
</div> 

<div style="clear:both;"></div>
<form class="form-inline mb-3" id="searchGroup">
  
  	<div class="form-group mb-2">
   
	    <input id="searchInput" type="text" class="form-control mr-2" placeholder="Поиск" autocomplete="off" value="<?php echo (isset($search) && $search) ? $search : NULL;?>">
	</div>
  	<button type="submit" class="btn btn-primary mb-2">Найти группу</button>
</form>

<table id="clients" class="table table-striped table-bordered table-hover">
	<tr>
		<th>#</th>
		<th>Название</th>
		<th>Категория</th>
		<th>ЧС</th>
		<th></th>
		
	</tr>
	<?php if(!empty($data)):?>
	<?php foreach ($data as $group):?>
		<tr class="tr<?php echo $group['id'];?>">
			<td><?php echo $group['id'];?></td>
			<td><a href="/wp-admin/admin.php?page=cargo_group_show&id=<?php echo $group['id'];?>"><?php echo $group['title'];?></a></td>
			<td><?php echo $group['cat_title'];?></td>
			<td><?php echo ($group['chs']) ? '+' : '';?></td>
			<td class="delete_cargo_group" data-id="<?php echo $group['id'];?>"><span style="cursor: pointer">&#10008;</span></td>
			
		</tr>
		

	<?php endforeach;?>
	<?php endif;?>
	
</table>
