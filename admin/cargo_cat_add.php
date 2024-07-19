<?php include 'inc/header.php';?>

<h1>Добавить категорию</h1>

<div id="cargoCatAdd">

    <form class="m-width-600">
        <div class="form-group">
            <label>Заголовок*</label>
            <input name="title" type="text" class="form-control" value="" autocomplete="off" required>
        </div>
        <div class="form-check mb-2" style="padding-left: 0;">
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

