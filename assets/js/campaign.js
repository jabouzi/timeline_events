$(document).ready(function() {

	$.datepicker.setDefaults($.datepicker.regional[($('html').attr('lang') == 'en') ? '' : $('html').attr('lang')]);
	$('.datechooser').datepicker(
		{
		dateFormat: 'dd/mm/yy',
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
	
	//$('.vis-item-content').mouseover(function()
	//{
		//console.log($(this).attr('data-value'));
	//});

	if ($('#campaign_calendar').length)
	{
		drawVisualization2();
	}
	else if ($('#campaign_calendars').length)
	{
		drawVisualization();
	}

	$('.collapsious span').click(function() {
		console.log($(this));
		$('.timeline_'+$(this).attr('data-value')).toggle(500).parent().toggleClass('opened');
	});

	$('.wrapper-select-top').jqTransform({imgPath:'/images/'});
	
	$(document).on("mouseenter", '.vis-item-content', function ($e) {
		//console.log($(this).children().attr('id'));
		if ($(this).children().hasClass( "holidays" ))
		{
			$(this).qtip({
				overwrite: false,
				hide: 'unfocus',
				show: 'click',
				content: {text: $(this).children().attr('data-content')},
				style: {classes: 'qtip-default qtip qtip-youtube qtip-shadow qtip-rounded'}
			});
		}
    });
    
	$(document).on("mouseenter", '.vis-item-overflow', function ($e) {
		//console.log($(this).attr('id'));
		if (!$(this).children().hasClass( "holidays" ))
		{
			$(this).qtip({
				overwrite: false,
				hide: 'unfocus',
				show: 'click',
				content: {text: '<div style="font-size:15px;">'+$(this).children().children().attr('data-content')+'</div>'},
				style: {classes: 'qtip-default qtip qtip-youtube qtip-shadow qtip-rounded'}
			});
		}
    });
});


function drawVisualization() {
	
	var items = {};
	var timeline = {};
	for (var campaigns in jsonData)
	{
		items[campaigns] = new vis.DataSet(jsonData[campaigns]);
		items[campaigns].add(holidaysData);
		var container = document.getElementById(campaigns);
		var options = {orientation: {axis: 'both'}, locale: $("#site_lang").val(), start: addMonths(new Date(), -6), end: addMonths(new Date(), +6)};
		timeline[campaigns] = new vis.Timeline(container, items[campaigns], options);
		var groups = new vis.DataSet();
		for (var g = 0; g < groupData[campaigns].length; g++) {
			groups.add({id: g, content: groupData[campaigns][g]});
		}
		timeline[campaigns].setGroups(groups);
		timeline[campaigns].moveTo(new Date());
	}
	
	$('.goto').click(function()
	{
		var id = $(this).attr('data-id');
		if ($('#move_to_'+id.replace(' ', '_')).val() != '')
		{
			timeline[id].moveTo(reformateDate($('#move_to_'+id.replace(' ', '_')).val()));
		}
	});
		
}

function drawVisualization2() {

	var container = null;
	var groups = new vis.DataSet();
	for (var g = 0; g < groupData.length; g++) {
		groups.add({id: g, content: groupData[g]});
	}

	container = document.getElementById('timeline');
	var items = new vis.DataSet(jsonData);
	var options = { orientation: {axis: 'both'}, locale: $("#site_lang").val(), start: addMonths(new Date(), -2), end: addMonths(new Date(), +2) };
	var timeline = new vis.Timeline(container, items, options);
	timeline.setGroups(groups);
	timeline.moveTo(new Date());
}

function addMonths(date, months) {
  date.setMonth(date.getMonth() + months);
  return date;
}

function validate_from(form_id)
{
	var required = 0;
	$('.error-input').removeClass('error-input');
	$('.alert_error').html('');
	$("#" + form_id).find('[data-validate]').each(function() {
		required += validate_element($(this));
	});
	console.log(form_id);
	if ('campaign_add' == form_id)
	{
		validateCreateDates();
	}
	else
	{
		required += validateDates()
	}
	
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

function validateDates()
{
	var error = 0;
	
	var start = $('#campaign_date_start').val();
	var event = $('#campaign_date_evenement').val();
	if (reformateDate(start) > reformateDate(event)) 
	{
		error++;
		$("#label_campaign_date_evenement").addClass('error-input');
		$("#label_campaign_date_start").addClass('error-input');
	}
	
	for(var i = 1; i < 6; i++)
	{
		var _start = $('#campaign_step_date_start'+i).val();
		var _end = $('#campaign_step_date_end'+i).val();
		if (reformateDate(start) > reformateDate(_start))
		{
			error++;
			$("#label_creation"+i).addClass('error-input');
			$("#label_campaign_date_start").addClass('error-input');
		}
		
		if (reformateDate(_start) > reformateDate(_end))
		{
			error++;
			$("#label_creation"+i).addClass('error-input');
		}
		
		if (reformateDate(_end) > reformateDate($('#campaign_step_date_end6').val()))
		{
			error++;
			$("#label_creation"+i).addClass('error-input');
			$("#label_campaign_step_date_end6").addClass('error-input');
		}
	}
	
	var _start = $('#campaign_date_media_start').val();
	var _end = $('#campaign_date_media_end').val();
	
	if (reformateDate(_start) > reformateDate(_end)) 
	{
		error++;
		$("#label_campaign_date_media_start").addClass('error-input');
		$("#label_campaign_date_media_end").addClass('error-input');
	}
	
	if (reformateDate(_end) > reformateDate($('#campaign_step_date_end6').val()))
	{
		error++;
		$("#label_campaign_date_media_end").addClass('error-input');
		$("#label_campaign_step_date_end6").addClass('error-input');
	}

	return error;
}

function validateCreateDates()
{
	var error = 0;
	
	var start = $('#campaign_date_start').val();
	var event = $('#campaign_date_evenement').val();
	
	if ('' != start && !isValidDate(start))
	{
		error++;
		$("#label_campaign_date_start").addClass('error-input');
	}
	
	if ('' != event && !isValidDate(event))
	{
		error++;
		$("#label_campaign_date_evenement").addClass('error-input');
	}
	
	if ('' != start && '' != event)
	{
		if (reformateDate(start) > reformateDate(event)) 
		{
			error++;
			$("#label_campaign_date_evenement").addClass('error-input');
			$("#label_campaign_date_start").addClass('error-input');
		}
	}

	return error;
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

function reformateDate(date)
{
	var dates = date.split('/');
	var day = parseInt(dates[0]);
	var month = parseInt(dates[1]);
	var year = parseInt(dates[2]);
	var date = new Date(year, month-1, day);
	return date
}

function isValidDate(date)
{
	var isValid = false;
	var dates = date.split('/');
	var day = parseInt(dates[0]);
	var month = parseInt(dates[1]);
	var year = parseInt(dates[2]);
	if (day <= 0) return false;
	if (month <= 0) return false;
	if (year <= 0) return false;
	return (FeatureDateCheck(day,month,year));
}

function FeatureDateCheck(dt,mon,yr)
{
	var Joindate = new Date(yr, mon-1, dt);
	var Currentdate = new Date();
	if (isNaN(Joindate.getTime()) == true)
	{
		return false;
	}
	else if (Joindate.getTime() > Currentdate.getTime())
	{
		return false;
	}
	else
	{
		return true;
	}
}
