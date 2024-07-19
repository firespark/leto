<?php include 'inc/header.php';?>

<h1>Добавить группу</h1>

<div id="cargoGroupAdd">

	<form class="m-width-600">
		
  		<div class="form-group">
    		<label>Заголовок*</label>
    		<input name="title" type="text" class="form-control" value="" autocomplete="off" required>
  		</div>
  		<?php if(!empty($cats)):?>
	  	<select class="form-control mb-2" autocomplete="off" name="cat_id" required>
	  		<?php foreach($cats as $cat):?>
		  	<option value="<?php echo $cat->id;?>"><?php echo $cat->title;?></option>
		  	<?php endforeach;?>
		</select>
		<?php endif;?>
		<div class="form-check mb-3" style="padding-left: 0;">
	  		<input class="form-check-input" name="chs" type="checkbox" id="defaultCheck1" autocomplete="off" style="margin: 7px 0 0 0;">
	  		<label class="form-check-label" for="defaultCheck1" style="margin-left: 20px;">
	    		В ЧС
	  		</label>
		</div>
		
  		<button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
	<div class="sendmessage"></div>
	<div class="errormessage"></div>
</div>

