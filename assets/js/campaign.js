$(document).ready(function() {
	
	$('.campaign').hide(10).parent().removeClass('opened');
	$('.timeline_'+$('#openedid').val()).show(10).parent().addClass('opened');
	
	$.datepicker.setDefaults($.datepicker.regional[($('html').attr('lang') == 'en') ? '' : $('html').attr('lang')]);
	$('.datechooser').datepicker(
		{
	    changeMonth: true,
	    changeYear: true,
	    showAnim: 'slideDown',
			onChangeMonthYear:function(y, m, i){                                
        var d = i.selectedDay;
        $(this).datepicker('setDate', new Date(y, m-1, d));
    	}
		}
	);
	
	$('.submit').click(function()
	{
		clear_messages();
		validate_from($(this).attr('data-value'));
	});

	if ($('#campaign_calendar').length)
	{
		drawVisualization2();
	}
	else if ($('#campaign_calendars').length)
	{
		drawVisualization();
	}

	$('.campaign').hide();
	$('.timeline_0').show();

	$('.collapsious span').click(function() {
		$('.campaign').hide(500).parent().removeClass('opened');
		$('.timeline_'+$(this).attr('data-value')).show(500).parent().addClass('opened');
	});

	$('.wrapper-select-top').jqTransform({imgPath:'/images/'});
});


function drawVisualization() {

	var timeline = [];
	var data;

	var options = {
		'width':  '100%',
		"axisOnTop": true,
		"timeChangeable": false,
		'style': 'box'
	};

	function onselect() {

		for (var campaigns in jsonData)
		{
			if (timeline[campaigns].getSelection() != undefined)
			{
				var sel = timeline[campaigns].getSelection();
			}

			for(var i = 0; i < jsonData[campaigns].length; i++)
			{
				 if (sel[i] != undefined && sel[i].row != undefined)
				 {
					var url = window.location.href;
					var redirect = 'detail/' + timeline[campaigns].getItem(sel[i].row).id;
					if (url.substr(url.length - 1) != '/') redirect = '/'+redirect;
					window.location.href = url + redirect;
				}
			}
		}
	}

	for (var campaigns in jsonData)
	{
		timeline[campaigns] = new links.Timeline(document.getElementById(campaigns), options);
		links.events.addListener(timeline[campaigns], 'select', onselect);
		timeline[campaigns].draw(jsonData[campaigns]);
	}
}

function drawVisualization2() {

	var timeline = [];
	var data;

	var options = {
		'width':  '100%',
		"axisOnTop": true,
		"timeChangeable": false,
		'style': 'box'
	};

	// Instantiate our timeline object.
	timeline = new links.Timeline(document.getElementById('timeline'), options);

	timeline.draw(jsonData);
}

function validate_from(form_id)
{
	var required = 0;
	$('.alert_error').html('');
	$("#" + form_id).find('[data-validate]').each(function() {
		required += validate_element($(this));
	});
	
	if (required)
	{
		$('.alert_error').html($('#error_message').val());
		$('.alert_error').show();  
		blinkit('alert_error');
	}
	else
	{
		if ($('#user_email').length > 0)
		{
			if ($('#user_id').length == 0) var user_id = 0;
			else var user_id = $('#user_id').val();
			$.post( $('#email_exists_url').val()+'/'+encodeURIComponent($('#user_email').val())+'/'+user_id, function( response ) {
				if (response == '0') $("#" + form_id).submit();
				else
				{
					$('.alert_warning').html(response);
					$('.alert_warning').show();  
					blinkit('alert_warning');
				}
			});
		}
		else
		{
			$("#" + form_id).submit();
		}
		
	}
}

function validate_element(element)
{
	var required = 0;
	if (element.attr('data-type') == 'email')
	{
		if (!isValidEmailAddress(element)) {  $("#label_" + element.attr('id')).addClass('error-input'); required++; }
		else if ($("#" + element.attr('id') + '_confirmation').length > 0 && $("#" + element.attr('id') + '_confirmation').val() != element.val()) 
		{ $("#label_" + element.attr('id')).addClass('error-input'); required++;  }
	}		
	else if (element.attr('data-type') == 'date')
	{
		if (!isValideDate(element)) {  $("#label_" + element.attr('id')).addClass('error-input'); required++;  }
	}
	else if (element.attr('data-type') == 'postalcode')
	{
		if (!isValidPostalCode(element)) {  $("#label_" + element.attr('id')).addClass('error-input'); required++;  }
	}
	else if (element.attr('data-type') == 'checkbox')
	{
		if (!element.is(':checked')) {  $("#label_" + element.attr('id')).addClass('error-input'); required++;  }
	}
	else if (element.attr('data-type') == 'option')
	{
		if (element.val() == '0' || element.val() == '0') {  $("#label_" + element.attr('id')).addClass('error-input'); required++;  }
	}
	else if (element.attr('data-type') == 'phone')
	{
		if (!isValidPhone(element)) {  $("#label_" + element.attr('id')).addClass('error-input'); required++;  }
	}
	else if (element.attr('data-validate') == 'required') 
	{
		if (element.val() == '')
		{
			if (element.is(":visible"))
			{
				$("#label_" + element.attr('id')).addClass('error-input'); required++;
			}
		}
	}
	
	return required;
}

function isValidEmailAddress(element) 
{
	var isValid = false;
	var emailAddress = element.val();
	if (element.attr('data-validate') == 'validate' && emailAddress == '') isValid = true;
	else { var regex = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		isValid = regex.test(emailAddress.toLowerCase()) ? true : false; }
	return isValid;
}

function isValidPhone(element)
{
	var isValid = false;
	var phoneNumber = element.val();
	if (element.attr('data-validate') == 'validate' && phoneNumber  == '') isValid = true;
	else { var regex = new RegExp(/^\+?1?( |-)?\(?(\d{3})\)?( |-)?(\d{3})( |-)?(\d{4})$/i);
		isValid = regex.test(phoneNumber.toLowerCase()) ? true : false;}
	return isValid;
}

function isValidPostalCode(element)
{
	var isValid = false;
	var postalCode = element.val();
	if (element.attr('data-validate') == 'validate' && postalCode == '') isValid = true;
	else {var regex = new RegExp(/^[abceghjklmnprstvxy]{1}\d{1}[a-z]{1}\d{1}[a-z]{1}\d{1}$/i);
		isValid = regex.test(postalCode.toLowerCase()) ? true : false;}
	return isValid;
}

function isValidCardNumber(element)
{
	var creditNumber = $(element).val();
	var regex =  new RegExp(/^(5[1-5]\d{14})|(4[0-9]{12}(?:[0-9]{3})?)$/);
	var isValid = regex.test(creditNumber) ? true : false;
	return isValid;
}

function isValidExpirationDate(element)
{
	var isValid = false;
	var expMonth = element.val().substring(0,2);
	var expYear = element.val().substring(2,4);
	if (expMonth == '' || expYear == '' ) { isValid = false; }
	else { var expDate = new Date('20' + expYear, expMonth); var date = new Date(); isValid = (expDate > date) ? true : false; }
	return isValid;
}

function isValidNumber(element)
{
	var number = element.val();
	return !isNaN(parseFloat(number)) && isFinite(number);
}

function blinkit(classname)
{
	var speed = 200;
	effectFadeIn(classname, speed);
	effectFadeOut(classname, speed);
}

function effectFadeIn(classname, speed) {
	$("." + classname).fadeOut(speed);
}

function effectFadeOut(classname, speed) {
	$("." + classname).fadeIn(speed);
}

function clear_messages()
{
	$('.alert_warning').html('');
	$('.alert_error').html('');
	$('.alert_success').html('');
	$('.alert_info').html('');
	$('.alert_warning').hide();
	$('.alert_error').hide();
	$('.alert_success').hide();
	$('.alert_info').hide();
}

function edit(campaign_id)
{
	console.log('edit '+campaign_id);
}

function pop(campaign_id)
{
	console.log('pop '+campaign_id);
}
