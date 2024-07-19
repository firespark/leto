<?php include 'inc/header.php';?>

<h1>Добавить груз</h1>
<div id="cargoAdd">

	<form class="m-width-600">
		
  		<div class="form-group">
    		<label>Заголовок*</label>
    		<input name="title" type="text" class="form-control" value="" autocomplete="off" required>
  		</div>
  		<?php if(!empty($cats)):?>
  		<select class="form-control mb-3" autocomplete="off" name="cat_id" required>
  			<?php foreach($cats as $cat):?>
	  		<option value="<?php echo $cat->id;?>"><?php echo $cat->title;?></option>
	  		<?php endforeach;?>
		</select>
		<?php endif;?>
		<?php if(!empty($groups)):?>
	  	<select class="form-control mb-4" autocomplete="off" name="group_id">
	  		<option value="0">Без группы</option>
	  		<?php foreach($groups as $group):?>
		  	<option value="<?php echo $group->id;?>"><?php echo $group->title;?></option>
		  	<?php endforeach;?>
		</select>
		<?php endif;?>
	
  		<button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
	<div class="sendmessage"></div>
	<div class="errormessage"></div>
</div>

