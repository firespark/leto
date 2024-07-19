<?php include 'inc/header.php';?>


<h1>Категории грузов</h1>
<div class="mb-4">
<a type="button" class="btn btn-info" href="/wp-admin/admin.php?page=cargo_cat_add">Добавить категорию</a>
</div>
<form class="form-inline mb-2" id="searchCat">
  
  	<div class="form-group mb-2">
   
    	<input id="searchInput" type="text" class="form-control mr-2" placeholder="Поиск" autocomplete="off" value="<?php echo (isset($search) && $search) ? $search : NULL;?>">
  	</div>
  	<button type="submit" class="btn btn-primary mb-2">Найти категорию</button>
</form>

<table id="clients" class="table table-striped table-bordered table-hover">
	<tr>
		<th>#</th>
		<th>Название</th>
		<th>ЧС</th>
		<th></th>
		
	</tr>
	<?php if(!empty($cats)):?>
	<?php foreach ($cats as $cat):?>
		<tr class="tr<?php echo $cat->id;?>">
			<td><?php echo $cat->id;?></td>
			<td><a href="/wp-admin/admin.php?page=cargo_cat_show&id=<?php echo $cat->id;?>"><?php echo $cat->title;?></a></td>
			<td><?php echo ($cat->chs) ? '+' : '';?></td>
			<td class="delete_cargo_cat" data-id="<?php echo $cat->id;?>"><span style="cursor: pointer">&#10008;</span></td>
			
		</tr>
		

	<?php endforeach;?>
	<?php endif;?>
	
</table>

