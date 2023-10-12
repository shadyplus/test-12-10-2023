function priceTax(increase) {
	if(typeof increase == 'undefined')
	{
		increase = 'plus';
	}

	priceStorage = localStorage.getItem("priceStorageValue");
	if ( priceStorage == '' || priceStorage == 'null' || priceStorage == null )
	{
		$('input[name=\'promocode\']').each(function() {
			if ( !!$(this).attr('data-promo') )
			{
				priceStorage = $(this).attr('data-promo');
				return false;
			}
		});
		localStorage.setItem("priceStorageValue", priceStorage);
	}

	$(".priceTax").each(function(){
		priceTaxValue = $(this).text();
		priceCurr = priceTaxValue.replace(/\w+/g,"");

		if ( increase == 'plus' )
		{
			priceCurrent = parseInt(priceTaxValue);

			if ( priceCurrent != priceStorage )
			{
				localStorage.setItem("priceTaxValue", priceCurrent);
			}
		}
		else
		{
			priceStorage = Number(localStorage.getItem("priceTaxValue"));
		}

		if ( isNaN(priceStorage) )
			priceStorage = priceCurrent;

		priceOut = priceStorage + priceCurr;
		$(this).text(priceOut);
	});
}
function parseGetParams() {
	var $_GET = {};
	var __GET = window.location.search.substring(1).split("&");
	for(var i=0; i<__GET.length; i++) {
		var getVar = __GET[i].split("=");
		$_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
	}
	return $_GET;
}
$(document).ready(function() {

	var urlhash = parseGetParams();

	localStorage.removeItem("priceStorageValue");
	localStorage.removeItem("priceTaxValue");

	priceTax('plus');

	$(".promocode-check").on('click', function(){
		if ( $("div").hasClass("fixed-bottom") )
		{
			$(".promo-form").show();
			$(".promo-success, .promo-error").hide();
		}
		if ( $('input[name=\'promocode\']').val() != '' )
		{
			$.ajax({
				type: 'POST',
				url: '//static.best-gooods.ru/check_promocode.php',
				data: {
					lnk: urlhash.lnk,
					promocode: $('input[name=\'promocode\']').val(),
				},
				success: function(data) {
					if ( data == 'true' )
					{
						if ( $("div").hasClass("fixed-bottom") )
						{
							$(".promo-form, .promo-error").hide();
							$(".promo-success").show();
						}
						priceTax('minus');
					}
					else
					{
						if ( $("div").hasClass("fixed-bottom") )
						{
							$(".promo-form, .promo-success").hide();
							$(".promo-error").show();
						}
						priceTax('plus');
						setTimeout(function() { $(".promocode-error").hide("fast", function() { $(".promo-form").show(); }); }, 3000);
					}
				}
			});
		}
		return false;
	});

});


