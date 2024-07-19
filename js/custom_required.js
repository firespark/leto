function sendAjaxMessage(blockSelector, method) {
	const form = $(blockSelector + " form");
	$(blockSelector + ' .modalContentSuccess').hide();
	$(blockSelector + ' .errormessage').hide().text('');

	const str = form.serialize();

	$.ajax({
		type: 'POST',
		url: '/wp-content/themes/leto/scripts/' + method + '.php',
		dataType: 'json',
		data: str,
		success: function (data) {
			if (data.success == true) {

				form.hide();

				$(blockSelector + ' .modalContentSuccess').fadeIn();
			}
			else {

				$(blockSelector + ' .errormessage').fadeIn().html(data.output);
			}
		}
	});

}

function checkImportantFields() {
	$errors = 0;
	if (!$('#selectLoadCapacity').val()) {
		$('.select_form[data-id="1"]').addClass('_form-error');
		$errors++;
	}
	else {
		$('.select_form[data-id="1"]').removeClass('_form-error');
	}

	if (!$('#selectBodyType').val()) {
		$('.select_form[data-id="2"]').addClass('_form-error');
		$errors++;
	}
	else {
		$('.select_form[data-id="2"]').removeClass('_form-error');
	}

	if (!$('#form_route_begin').val()) {
		$('#form_route_begin').addClass('_form-error');
		$errors++;
	}
	else {
		$('#form_route_begin').removeClass('_form-error');
	}

	if (!$('#form_route_end').val()) {
		$('#form_route_end').addClass('_form-error');
		$errors++;
	}
	else {
		$('#form_route_end').removeClass('_form-error');
	}

	return $errors;

}

function checkOtherFields() {
	$errors = 0;
	if (!$('#calcDeliveryDate').val()) {
		$('#calcDeliveryDate').addClass('_form-error');
		$errors++;
	}
	else {
		$('#calcDeliveryDate').removeClass('_form-error');
	}

	if (!$('#calcCargoTitle').val() || !$("#calcCargoTitleHidden").val()) {
		$('#calcCargoTitle').addClass('_form-error');
		$errors++;
	}
	else {
		$('#calcCargoTitle').removeClass('_form-error');
	}

	if (!$('#cargo_weight').val() || $('#cargo_weight').val() == '0.00') {
		$('#cargo_weight').addClass('_form-error');
		$errors++;
	}
	else {
		$('#cargo_weight').removeClass('_form-error');
	}

	if (!$('#cargo_size').val() || $('#cargo_size').val() == 0) {
		$('#cargo_size').addClass('_form-error');
		$errors++;
	}
	else {
		$('#cargo_size').removeClass('_form-error');
	}

	/*if ($('#c_1').is(':checked')) {
		if (!$('#cMin').val()) {
			$('#cMin').addClass('_form-error');
			$errors++;
		}
		else {
			$('#cMin').removeClass('_form-error');
		}
		if (!$('#cMax').val()) {
			$('#cMax').addClass('_form-error');
			$errors++;
		}
		else {
			$('#cMax').removeClass('_form-error');
		}
	}*/

	return $errors;

}

function calcPrice(){
	$('.calc-right__error').hide().html('');
	$('#rightDeliveryCost').text('0');
	$('.calc-right__image-ibg').removeClass('imgHidden');
	$('#cargoRate').val('');

	const load_capacity = $('#selectLoadCapacity').val();
	const body_type = $('#selectBodyType').val();
	const route_begin = $('#rightStartPoint').text();
	const route_end = $('#rightEndPoint').text();
	const route_begin_fias = $('#route_begin_fias').val();
	const route_begin_fiasId = $('#route_begin_fiasId').val();
	const route_begin_fiasRegion = $('#route_begin_fiasRegion').val();
	const route_begin_lat = $('#route_begin_lat').val();
	const route_begin_long = $('#route_begin_long').val();
	const route_end_fias = $('#route_end_fias').val();
	const route_end_fiasId = $('#route_end_fiasId').val();
	const route_end_fiasRegion = $('#route_end_fiasRegion').val();
	const route_end_lat = $('#route_end_lat').val();
	const route_end_long = $('#route_end_long').val();

	$.ajax({
		type: 'POST',
		url: '/wp-content/themes/leto/scripts/calcPrice.php',
		dataType: 'json',
		data: {
			load_capacity, 
			body_type, 
			route_begin, 
			route_end, 
			route_begin_fias,
			route_begin_fiasId,
			route_begin_fiasRegion,
			route_begin_lat,
			route_begin_long,
			route_end_fias,
			route_end_fiasId,
			route_end_fiasRegion,
			route_end_lat,
			route_end_long
		},
		success: function (data) {
			if (data.success == true) {
				$('#rightDeliveryCost').text(parseInt(data.output).toLocaleString());
				$('#cargoRate').val(data.output);

			}
			else {
				$('.calc-right__error').fadeIn().html(data.output);
				$('#rightDeliveryCost').text('0');
			}
		},
		complete: function() {
			$('.calc-right__image-ibg').addClass('imgHidden');
		}
	});
}

function validateEmail(email) {
	return email.match(
		/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	);
}

function checkSecondFields() {
	$errors = 0;
	if (!$('#calcFio').val()) {
		$('#calcFio').addClass('_form-error');
		$errors++;
	}
	else {
		$('#calcFio').removeClass('_form-error');
	}

	if (!$('#calcMobile').val()) {
		$('#calcMobile').addClass('_form-error');
		$errors++;
	}
	else {
		$('#calcMobile').removeClass('_form-error');
	}

	/*if(!$('#calcCompany').val()) {
		 $('#calcCompany').addClass('_form-error');
		 $errors++;
	}
	else {
		 $('#calcCompany').removeClass('_form-error');
	}

	if(!$('#calcInn').val()) {
		 $('#calcInn').addClass('_form-error');
		 $errors++;
	}
	else {
		 $('#calcInn').removeClass('_form-error');
	}*/

	if (!$('#calcEmail').val() || !validateEmail($('#calcEmail').val())) {
		$('#calcEmail').addClass('_form-error');
		$errors++;
	}
	else {
		$('#calcEmail').removeClass('_form-error');
	}

	if ($('#c_2').is(':checked')) {
		$('#c_2_label').removeClass('_form-error');
	}
	else {
		$('#c_2_label').addClass('_form-error');
		$errors++;
	}

	return $errors;

}

function changeCargoWeightInput(input, maxWeight) {
	var amount = input.val();
	amount = amount.toString();
	amount = amount.replace(',', '.');
	amount = amount.replace(/[^\d.]/g, '');
	if (amount) {
		amount = parseFloat(amount).toFixed(2);
		if (amount > maxWeight) amount = maxWeight.toFixed(2);
	}

	input.val(amount);

	return amount;
}

function changeCargoSizeInput(input, maxSize) {
	var amount = input.val();
	amount = parseInt(amount);
	amount = Math.abs(amount);
	if (isNaN(amount)) {
		amount = '';
	}
	else {
		if (amount > maxSize) amount = maxSize;
	}
	/*amount = amount.toString();
	amount = amount.replace(/[^\d]/g, '');
	if(amount){
		 amount = parseInt(amount);
		 
		 if(amount > maxSize) amount = maxSize;
	}*/

	input.val(amount);

	return amount;
}

function changeTemperatureInput(input, minT, maxT) {
	var amount = input.val();
	amount = amount.replace(/[^\d-]/g, '');

	if (amount) {
		amount = parseInt(amount);
		if (isNaN(amount)) amount = '';
		if (amount) {
			if (amount < parseInt(minT)) amount = minT;
			if (amount > parseInt(maxT)) amount = maxT;
		}

	}

	input.val(amount);

	return amount;
}


$(document).ready(function () {

	$(".phone_mask").mask("+7(999)999-99-99");

	$('.show-more-button').click(function (e) {
		e.preventDefault();
		var total_posts = parseInt($(this).data('total'));
		var results_per_page = parseInt($(this).data('perpage'));
		var counter = parseInt($(this).data('counter'));

		$.ajax({
			type: "POST",
			url: "/wp-content/themes/leto/scripts/loadResults.php",
			data: { results_per_page: results_per_page, counter: counter },
			success: function (data) {
				$('.casesBody').append(data);
				$('.show-more-button').data('counter', counter + 1);
				if (Math.ceil(total_posts / results_per_page) <= counter + 1) {
					$('.show-more-button').hide();
				}

			}
		});
	});

	$('body').on('keyup', '#calcCargoTitle', function () {

		$('#calcCargoTitleHidden').val('');

		$(".calcCargoSearch.select__options").attr('hidden', 'hidden');
		$(".calcCargoSearch.select__options").html("");
		$('.calcCargoWrapper').removeClass('_error');
		$('#calcCargoTitle').removeClass('_form-error');
		$('.calcCargoWrapper .calc__errorblock').hide();

		const phrase = $(this).val();

		if (phrase.length > 2) {
			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/scripts/searchCargo.php",
				data: "phrase=" + phrase,
				success: function (data) {
					if (data) {
						$(".calcCargoSearch.select__options").removeAttr('hidden');
						$(".calcCargoSearch.select__options").html(data);

						$(".calcCargoSearch .select__option").click(function () {
							const value = $(this).data('value');
							const chs = $(this).data('chs');
							$('#calcCargoTitleHidden').val(value);
							$('#calcCargoTitle').val(value);
							$('.calcCargoWrapper').removeClass('_error');
							$('#calcCargoTitle').removeClass('_form-error');
							$('.calcCargoWrapper .calc__errorblock').hide();

							if (chs == 1) {
								$('.calcCargoWrapper').addClass('_error');
								$('#calcCargoTitle').addClass('_form-error');
								$('.calcCargoWrapper .calc__errorblock').show();

							}
							$(".calcCargoSearch.select__options").attr('hidden', 'hidden');
							$(".calcCargoSearch.select__options").html("");
						});

						$('html').click(function () {
							$(".calcCargoSearch.select__options").attr('hidden', 'hidden');
							$(".calcCargoSearch.select__options").html("");
						});
						$('.calcCargoSearch.select__options').click(function (event) {
							event.stopPropagation();
						});
					}

				}
			});
		}



	});

	$('body').on('change', '#calcCargoTitle', function () {
		if ($('#calcCargoTitleHidden').val() == '') {
			$('#calcCargoTitle').val('');
			$('.calcCargoWrapper').addClass('_error');
			$('#calcCargoTitle').addClass('_form-error');
			$('.calcCargoWrapper .calc__errorblock').show();
		}
	});

	$('body').on('change', '#form_route_begin', function () {
		const value = $('#rightStartPoint').text();
		if (!value) {
			$(this).val('');
			$(this).addClass('_form-error');

		}
	});

	$('body').on('change', '#form_route_end', function () {
		const value = $('#rightEndPoint').text();
		if (!value) {
			$(this).val('');
			$(this).addClass('_form-error');
		}
	});

	$('body').on('keyup', '#form_route_begin', function () {


		$(".calcAddressStartSearch.select__options").attr('hidden', 'hidden');
		$(".calcAddressStartSearch.select__options").html("");
		$('.calcAddressWrapper').removeClass('_error');
		$('.calcAddressWrapper .calc__errorblock').hide();
		$('#rightStartPoint').text('');
		$('#route_begin_fias').val('');

		$('#route_begin_fiasId').val('');
		$('#route_begin_fiasRegion').val('');
		$('#route_begin_lat').val('');
		$('#route_begin_long').val('');

		const phrase = $(this).val();

		if (phrase.length > 2) {
			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/scripts/searchAddress.php",
				data: "phrase=" + phrase,
				success: function (data) {
					if (data) {
						$(".calcAddressStartSearch.select__options").removeAttr('hidden');
						$(".calcAddressStartSearch.select__options").html(data);

						$(".calcAddressStartSearch .select__option").click(function () {
							const value = $(this).data('value');
							const city = $(this).data('city');
							const fias = $(this).data('fias');

							const fiasId = $(this).data('fiasid');
							const fiasRegion = $(this).data('fiasregion');
							const lat = $(this).data('lat');
							const long = $(this).data('long');

							$('#form_route_begin').val(value);
							$('#rightStartPoint').text(city);
							$('#route_begin_fias').val(fias);

							$('#route_begin_fiasId').val(fiasId);
							$('#route_begin_fiasRegion').val(fiasRegion);
							$('#route_begin_lat').val(lat);
							$('#route_begin_long').val(long);

							$(".calcAddressStartSearch.select__options").attr('hidden', 'hidden');
							$(".calcAddressStartSearch.select__options").html("");
							if(checkImportantFields() == 0){
								calcPrice();
							}
						});

						$('html').click(function () {
							$(".calcAddressStartSearch.select__options").attr('hidden', 'hidden');
							$(".calcAddressStartSearch.select__options").html("");
						});
						$('.calcAddressStartSearch.select__options').click(function (event) {
							event.stopPropagation();
						});
					}

				}
			});
		}

	});

	$('body').on('keyup', '#form_route_end', function () {


		$(".calcAddressEndSearch.select__options").attr('hidden', 'hidden');
		$(".calcAddressEndSearch.select__options").html("");
		$('.calcAddressWrapper').removeClass('_error');
		$('.calcAddressWrapper .calc__errorblock').hide();
		$('#rightEndPoint').text('');
		$('#route_end_fias').val('');

		$('#route_end_fiasId').val('');
		$('#route_end_fiasRegion').val('');
		$('#route_end_lat').val('');
		$('#route_end_long').val('');

		const phrase = $(this).val();

		if (phrase.length > 2) {
			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/scripts/searchAddress.php",
				data: "phrase=" + phrase,
				success: function (data) {
					if (data) {
						$(".calcAddressEndSearch.select__options").removeAttr('hidden');
						$(".calcAddressEndSearch.select__options").html(data);

						$(".calcAddressEndSearch .select__option").click(function () {
							const value = $(this).data('value');
							const city = $(this).data('city');
							const fias = $(this).data('fias');

							const fiasId = $(this).data('fiasid');
							const fiasRegion = $(this).data('fiasregion');
							const lat = $(this).data('lat');
							const long = $(this).data('long');

							$('#form_route_end').val(value);
							$('#rightEndPoint').text(city);
							$('#route_end_fias').val(fias);

							$('#route_end_fiasId').val(fiasId);
							$('#route_end_fiasRegion').val(fiasRegion);
							$('#route_end_lat').val(lat);
							$('#route_end_long').val(long);

							$(".calcAddressEndSearch.select__options").attr('hidden', 'hidden');
							$(".calcAddressEndSearch.select__options").html("");
							if(checkImportantFields() == 0){
								calcPrice();
							}
						});

						$('html').click(function () {
							$(".calcAddressEndSearch.select__options").attr('hidden', 'hidden');
							$(".calcAddressEndSearch.select__options").html("");
						});
						$('.calcAddressEndSearch.select__options').click(function (event) {
							event.stopPropagation();
						});
					}

				}
			});
		}

	});



	$('body').on('click', '.select_form[data-id="1"] .select__option', function () {
		const value = $(this).data('value');
		$('#rightLoadCapacity').text(value);
		$('#selectLoadCapacity').val(value);
		if(checkImportantFields() == 0){
			calcPrice();
		}

	});

	$('body').on('click', '.select_form[data-id="2"] .select__option', function () {
		const value = $(this).data('value');
		$('#rightBodyType').text(value);
		$('#selectBodyType').val(value);
		if(checkImportantFields() == 0){
			calcPrice();
		}
	});

	$('.calc__button-1').click(function () {
		$errors = checkImportantFields();
		$errors2 = checkOtherFields();

		if ($errors + $errors2 == 0) {
			//document.querySelector(".calc__left-1").setAttribute("hidden", "");
			document.querySelector(".calc__button-1").classList.add("_hidden");
			document.querySelector(".calc__left-2").removeAttribute("hidden");
			document.querySelector(".calc__button-2").classList.remove("_hidden");
		}
	});

	$(".tempBlock").hide();
	$("#c_1").click(function () {
		if ($(this).is(":checked")) {
			$(".tempBlock").show(300);
		} else {
			$(".tempBlock").hide(200);
		}
	});

	$('body').on('keyup', '#calcInn', function () {


		$('#calcInnHidden').val('');

		$(".calcInnSearch.select__options").attr('hidden', 'hidden');
		$(".calcInnSearch.select__options").html("");

		let phrase = $(this).val();

		phrase = phrase.replace(/[^\d-]/g, '');

		$('#calcInn').val(phrase);


		if (phrase.length > 2) {
			$.ajax({
				type: "POST",
				url: "/wp-content/themes/leto/scripts/searchInn.php",
				data: "phrase=" + phrase,
				success: function (data) {
					if (data) {
						$(".calcInnSearch.select__options").removeAttr('hidden');
						$(".calcInnSearch.select__options").html(data);

						$(".calcInnSearch .select__option").click(function () {
							const value = $(this).data('value');
							const company = $(this).data('company');
							$('#calcInn').val(value);
							$('#calcCompany').val(company);

							$(".calcInnSearch.select__options").attr('hidden', 'hidden');
							$(".calcInnearch.select__options").html("");
						});

						$('html').click(function () {
							$(".calcInnSearch.select__options").attr('hidden', 'hidden');
							$(".calcInnSearch.select__options").html("");
						});
						$('.calcInnSearch.select__options').click(function (event) {
							event.stopPropagation();
						});
					}

				}
			});
		}

	});


	$('#calcForm').submit(function (e) {

		e.preventDefault();
		$('.modalContentSuccess').hide().html('');
		$('.errormessage').hide().html('');

		let errors = 0;
		errors += checkImportantFields();
		errors += checkOtherFields();
		errors += checkSecondFields();

		if (!errors) {

			const form = $('#calcForm');
			
			const route_begin = $('#rightStartPoint').text();
			const route_end = $('#rightEndPoint').text();

			const str = form.serialize()+ "&route_begin=" + route_begin + "&route_end=" + route_end;

			$.ajax({
				type: 'POST',
				url: '/wp-content/themes/leto/scripts/sendCalculator.php',
				dataType: 'json',
				data: str,
				success: function (data) {
					if (data.success == true) {

						//form.hide();

						document.documentElement.classList.add("lock");
						document.documentElement.classList.add("popup-show");
						document.querySelector("#popup").classList.add("popup_show");
						document.querySelector("#popup").setAttribute("aria-hidden", "false");

					}
					else {

						$('.errormessage').fadeIn().html(data.output);
					}
				}
			});
		}
	});

	$('#cargo_weight').change(function () {
		const maxWeight = $(this).data('max');
		changeCargoWeightInput($(this), maxWeight);
	});
	$('#cargo_size').change(function () {
		const maxSize = $(this).data('max');
		changeCargoSizeInput($(this), maxSize);
	});
	$('#cMin, #cMax').change(function () {
		const minT = $(this).data('min');
		const maxT = $(this).data('max');
		changeTemperatureInput($(this), minT, maxT);
	});
	$('#cargo_places').change(function () {
		const maxSize = $(this).data('max');
		changeCargoSizeInput($(this), maxSize);
	});
});

document.addEventListener("click", function (e) {
	if (!e.target.closest(".popup__content") && document.querySelector("#popup").classList.contains("popup_show")) {
		document.documentElement.classList.remove("lock");
		document.documentElement.classList.remove("popup-show");
		document.querySelector("#popup").classList.remove("popup_show");
		document.querySelector("#popup").setAttribute("aria-hidden", "true");
		location.reload();
	}
});


