
<form class="form-inline mb-3" id="searchPrice">
  
  	<div class="form-group mb-2">
   
    	<input 
			id="searchInputPrice" 
			type="text" 
			class="form-control mr-2" 
			placeholder="Поиск" 
			autocomplete="off" 
			value="<?php if (isset($_GET['search']) && $_GET['search']) echo $_GET['search']?>"
		>
  	</div>
  	<button type="submit" class="btn btn-primary mb-2">Найти запись по городу или fias-коду</button>
</form>