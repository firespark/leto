function sendAjaxMessage(blockSelector, method){
    const form = $(blockSelector + " form");
    $(blockSelector +' .sendmessage').hide();
    $(blockSelector +' .errormessage').hide().text('');

    const str = form.serialize();

    $.ajax({
        type: 'POST',
        url: '/wp-content/themes/leto/admin/scripts/' + method + '.php',
        dataType: 'json',
        data: str,
        success: function(data) {
            if(data.success == true) {
            	
                $(blockSelector +' .sendmessage').fadeIn().html(data.output);
            }
            else {
                  
                $(blockSelector +' .errormessage').fadeIn().html(data.output);                        
            }
        }
    });
  
}

$(document).ready(function () {
  $('.delete_cargo').click(function(){
		if (confirm("Удалить груз?")) {
			var cargo_id = $(this).data('id');
			$.ajax({
					type: "POST",
					url: "/wp-content/themes/leto/admin/scripts/remove_ajax.php",
					data: {cargo_id: cargo_id},
					success: function(data) {
						if(data == 1){
							$(".tr" + cargo_id).fadeOut();
						}
						else alert(data);
						
						
						
					}
				});
		} else {
		return false;
		}

	});

	$('#cargoUpdate form').submit(function(e) {
      e.preventDefault();
      sendAjaxMessage('#cargoUpdate', 'cargoUpdate');
      
  });

	$('#cargoAdd form').submit(function(e) {
      e.preventDefault();
      sendAjaxMessage('#cargoAdd', 'cargoAdd');
      
  	});

	$('.delete_cargo_cat').click(function(){
		if (confirm("Удалить категорию?")) {
			var cat_id = $(this).data('id');
			$.ajax({
					type: "POST",
					url: "/wp-content/themes/leto/admin/scripts/remove_cat_ajax.php",
					data: {cat_id: cat_id},
					success: function(data) {
						if(data == 1){
							$(".tr" + cat_id).fadeOut();
						}
						else alert(data);
						
						
						
					}
				});
		} else {
		return false;
		}

	});

	$('#cargoCatUpdate form').submit(function(e) {
      e.preventDefault();
      sendAjaxMessage('#cargoCatUpdate', 'cargoCatUpdate');
      
  });
	$('#cargoCatAdd form').submit(function(e) {
      e.preventDefault();
      sendAjaxMessage('#cargoCatAdd', 'cargoCatAdd');
      
  	});

  	$('.delete_cargo_group').click(function(){
		if (confirm("Удалить группу?")) {
			var group_id = $(this).data('id');
			$.ajax({
					type: "POST",
					url: "/wp-content/themes/leto/admin/scripts/remove_group_ajax.php",
					data: {group_id: group_id},
					success: function(data) {
						if(data == 1){
							$(".tr" + group_id).fadeOut();
						}
						else alert(data);
						
						
						
					}
				});
		} else {
		return false;
		}

	});

	$('#cargoGroupUpdate form').submit(function(e) {
      e.preventDefault();
      sendAjaxMessage('#cargoGroupUpdate', 'cargoGroupUpdate');
      
  	});

  	$('#cargoGroupAdd form').submit(function(e) {
      e.preventDefault();
      sendAjaxMessage('#cargoGroupAdd', 'cargoGroupAdd');
      
  	});

  	$('#cargoImport form').submit(function(e) {
      	e.preventDefault();
      	const form = $("#cargoImport form");
	    $('#cargoImport .sendmessage').hide().text('');
	    $('#cargoImport .errormessage').hide().text('');
	    $('.showLoad').text('Загрузка');

	    const formData = new FormData(form[0]);

	    $.ajax({
	        type: 'POST',
	        url: '/wp-content/themes/leto/admin/scripts/cargoImport.php',
	        dataType: 'json',
	        data: formData,
	        contentType: false,
			cache: false,
			processData:false,
	        success: function(data) {
	        	$('.showLoad').text('');
	            if(data.success == true) {
	              
	              form.hide();
	              
	              $('#cargoImport .sendmessage').fadeIn().html(data.output);

	            }
	            else {
	                  
	                $('#cargoImport .errormessage').fadeIn().html(data.output);                        
	            }
	        }
	    });
      
  	});

  	$('#search').submit(function(e){
  		e.preventDefault();
  		const search = $('#searchInput').val();
  		if(search) {
  			window.location.href="/wp-admin/admin.php?page=cargos_view&search=" + search;
  		}
  	});

  	$('#searchCat').submit(function(e){
  		e.preventDefault();
  		const search = $('#searchInput').val();
  		if(search) {
  			window.location.href="/wp-admin/admin.php?page=cargo_cats_view&search=" + search;
  		}
  	});

  	$('#searchGroup').submit(function(e){
  		e.preventDefault();
  		const search = $('#searchInput').val();
  		if(search) {
  			window.location.href="/wp-admin/admin.php?page=cargo_groups_view&search=" + search;
  		}
  	});
  	$('#searchPrice').submit(function(e){
  		e.preventDefault();
  		const search = $('#searchInputPrice').val();
  		if(search) {
  			window.location.href="/wp-admin/admin.php?page=calc_prices_view&search=" + search;
  		}
  	});
  	$('#searchSubscription').submit(function(e){
  		e.preventDefault();
  		const search = $('#searchInputSubscription').val();
  		if(search) {
  			window.location.href="/wp-admin/admin.php?page=subscriptions_view&search=" + search;
  		}
  	});

  	$('#checkAllInputs').change(function() {
        if(this.checked) {
            $( '.checkCargoInput' ).prop( 'checked', true );
        }
        else {
        	$( '.checkCargoInput' ).prop('checked', false);
        }
             
    });

    $('#deleteSelectedCargos').click(function(e){
    	e.preventDefault();
		if (confirm("Удалить выбранные грузы?")) {
			const ids = [];
			$( ".checkCargoInput" ).each(function() {
				if(this.checked) {
					ids.push($( this ).data('id'));
			  	}
			});


			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/admin/scripts/remove_many_cargos_ajax.php",
				data: {ids: ids},
				success: function(data) {
					console.log(data);
					if(data == 1){
						window.location.reload();
					}
					else alert(data);
				}
			});
		} else {
		return false;
		}

	});

	$('.delete_calc_price').click(function(){
		if (confirm("Удалить запись?")) {
			var calc_price_id = $(this).data('id');
			$.ajax({
					type: "POST",
					url: "/wp-content/themes/leto/admin/scripts/remove_calc_price_ajax.php",
					data: {calc_price_id: calc_price_id},
					success: function(data) {
						if(data == 1){
							$(".tr" + calc_price_id).fadeOut();
						}
						else alert(data);
						
						
						
					}
				});
		} else {
		return false;
		}

	});

	$('#deleteAllCalcPrices').click(function(){
		if (confirm("Вы действительно хотите удалить все записи в таблице?")) {
			
			$.ajax({
					type: "GET",
					url: "/wp-content/themes/leto/admin/scripts/remove_all_calc_prices_ajax.php",
					success: function(data) {
						if(data == 1){
							$(".trLine").fadeOut();
						}
						else alert(data);
						
						
						
					}
				});
		} else {
		return false;
		}

	});

	$('#deleteSelectedCalcPrices').click(function(e){
    	e.preventDefault();
		if (confirm("Удалить выбранные записи?")) {
			const ids = [];
			$( ".checkCargoInput" ).each(function() {
				if(this.checked) {
					ids.push($( this ).data('id'));
			  	}
			});


			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/admin/scripts/remove_many_calc_prices_ajax.php",
				data: {ids: ids},
				success: function(data) {
					console.log(data);
					if(data == 1){
						window.location.reload();
					}
					else alert(data);
				}
			});
		} else {
		return false;
		}

	});

	$('.delete_subscription').click(function(){
		if (confirm("Удалить запись?")) {
			var subscription_id = $(this).data('id');
			$.ajax({
					type: "POST",
					url: "/wp-content/themes/leto/admin/scripts/remove_subscription_ajax.php",
					data: {subscription_id: subscription_id},
					success: function(data) {
						if(data == 1){
							$(".tr" + subscription_id).fadeOut();
						}
						else alert(data);
						
						
						
					}
				});
		} else {
		return false;
		}

	});

	$('#deleteSelectedSubscriptions').click(function(e){
    	e.preventDefault();
		if (confirm("Удалить выбранные записи?")) {
			const ids = [];
			$( ".checkCargoInput" ).each(function() {
				if(this.checked) {
					ids.push($( this ).data('id'));
			  	}
			});


			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/admin/scripts/remove_many_subscriptions_ajax.php",
				data: {ids: ids},
				success: function(data) {
					console.log(data);
					if(data == 1){
						window.location.reload();
					}
					else alert(data);
				}
			});
		} else {
		return false;
		}

	});

		
});