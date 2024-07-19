<?php include 'inc/header.php';?>

<h1><?php echo $cat->title;?></h1>

<div id="cargoCatUpdate">

    <form>
	    <h4>#<?php echo $cat->id;?></h4>
	    <input type="hidden" name="id" value="<?php echo $cat->id;?>">
        <div class="form-group">
            <label>Заголовок*</label>
            <input name="title" type="text" class="form-control" value="<?php echo $cat->title;?>" autocomplete="off" required>
        </div>
        <div class="form-check mb-3" style="padding-left: 0;">
            <input class="form-check-input" name="chs" type="checkbox" id="defaultCheck1"<?php if($cat->chs == 1) echo ' checked';?> autocomplete="off" style="margin: 7px 0 0 0;">
            <label class="form-check-label" for="defaultCheck1" style="margin-left: 20px;">
                В ЧС
            </label>
        </div>
	
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    <div class="sendmessage"></div>
    <div class="errormessage"></div>
</div>

