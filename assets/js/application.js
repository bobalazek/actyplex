$(document).ready( function() {
    // Ajax loader
    $(document).on('ajaxStart', function(){
        $('#ajax-loader').fadeIn();
    }).on('ajaxStop', function(){
        $('#ajax-loader').fadeOut();
    });
    
	$.ajaxSetup({
		async: false
	});
	
	if( childId != 0 ) $('#add-new-entry-child-id-input, #edit-entry-child-id-input').val(childId);
    
    getEntriesHtml();
    getChildrenHtml();
    
    $('#add-new-entry-button').on('click', function() {
    	if( userId == 0 )
    	{
    		toastr.info(texts.youNeedToSignInFirst + '!');
    		return false;
    	}
    });
    
    // Add Datetimepicker
    $('#add-new-entry-time-from-input, #add-new-entry-time-to-input, #edit-entry-time-from-input, #edit-entry-time-to-input').datetimepicker({
		timeFormat: 'HH:mm:ss',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
	});
	
    $('.datetimepicker-input').datetimepicker({
		timeFormat: 'HH:mm:ss',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
	});
    
    // The now buttons in the modals
    $('#add-new-entry-time-from-now-button').on('click', function() {
        $('#add-new-entry-time-from-input').val( currentDateTime() );
        return false; 
    });
    
    $('#edit-entry-time-from-now-button').on('click', function() {
        $('#edit-entry-time-from-input').val( currentDateTime() );
        return false; 
    });
    
    $('#add-new-entry-time-to-now-button').on('click', function() {
        $('#add-new-entry-time-to-input').val( currentDateTime() );
        return false; 
    });
    
    $('#edit-entry-time-to-now-button').on('click', function() {
        $('#edit-entry-time-to-input').val( currentDateTime() );
        return false; 
    });
    
    $('#add-new-entry-type-select').on('change', function() {
        var type = $(this).val();
        
        $('#add-new-entry-form .type-section-fields').hide();
        $('#add-new-entry-' + type + '-section-fields').show();
    });
    
    $('#edit-entry-type-select').on('change', function() {
        var type = $(this).val();
        
        $('#edit-entry-form .type-section-fields').hide();
        $('#edit-entry-' + type + '-section-fields').show();
    });
    
    $('#add-new-entry-save-entry-button').on('click', function() {
        $('#add-new-entry-form').validate({
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parent().parent().effect('shake', {times: 3}, 800);
                element.parent().append(error);
            },
            rules: {
                time_from: {
                    required: true
                },
                type: {
                    required: true,
                    valueNotEquals: 'none'
                }
            }
        });
        
        var type = $('#add-new-entry-type-select').val();
        if( type == 'measurement' )
        {
        	if( $('#add-new-entry-measurement-height-input').val() == '' && 
        		$('#add-new-entry-measurement-weight-input').val() == '' &&
        		$('#add-new-entry-measurement-systolic-blood-pressure-input').val() == '' &&
        		$('#add-new-entry-measurement-diastolic-blood-pressure-input').val() == '' &&
        		$('#add-new-entry-measurement-pulse-input').val() == '' &&
        		$('#add-new-entry-measurement-fever-input').val() == '' )
        	{
	            $('#add-new-entry-measurement-height-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#add-new-entry-measurement-weight-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#add-new-entry-measurement-systolic-blood-pressure-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#add-new-entry-measurement-diastolic-blood-pressure-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#add-new-entry-measurement-pulse-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#add-new-entry-measurement-fever-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
			}
			else
			{
				$('#add-new-entry-measurement-height-input').removeClass('error').rules('remove');
				$('#add-new-entry-measurement-weight-input').removeClass('error').rules('remove');
				$('#add-new-entry-measurement-systolic-blood-pressure-input').removeClass('error').rules('remove');
				$('#add-new-entry-measurement-diastolic-blood-pressure-input').removeClass('error').rules('remove');
				$('#add-new-entry-measurement-pulse-input').removeClass('error').rules('remove');
				$('#add-new-entry-measurement-fever-input').removeClass('error').rules('remove');
			}
			
			if( $('#add-new-entry-measurement-height-input').val() != '' )
			{
	            $('#add-new-entry-measurement-height-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#add-new-entry-measurement-weight-input').val() != '' )
			{
	            $('#add-new-entry-measurement-weight-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#add-new-entry-measurement-systolic-blood-pressure-input').val() != '' )
			{
	            $('#add-new-entry-measurement-systolic-blood-pressure-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#add-new-entry-measurement-diastolic-blood-pressure-input').val() != '' )
			{
	            $('#add-new-entry-measurement-systolic-blood-pressure-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#add-new-entry-measurement-pulse-input').val() != '' )
			{
	            $('#add-new-entry-measurement-pulse-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#add-new-entry-measurement-fever').val() != '' )
			{
	            $('#add-new-entry-measurement-fever-input').rules('add', {
	                number: true
	            });
			}
        }
        else if( type == 'symptom' )
        {
            $('#add-new-entry-symptom-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'medication' )
        {
            $('#add-new-entry-medication-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'activity' )
        {
            $('#add-new-entry-activity-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'food' )
        {
            $('#add-new-entry-food-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'disease' )
        {
            $('#add-new-entry-disease-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'event' )
        {
            $('#add-new-entry-event-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'other' )
        {
            $('#add-new-entry-other-what-input').rules('add', {
                required: true
            });
        }
        
        var isValid = $('#add-new-entry-form').valid();
        if( isValid )
        {
            var data = $('#add-new-entry-form').serialize();
            
            $.ajax({
               url: ajaxUrl + 'addEntry',
               data: data
            }).done( function(response) {
            	console.log(response);
                getEntriesHtml();
                $('#add-new-entry-modal').foundation('reveal', 'close');
                toastr.success(texts.entryAdded + '!');
            });
        }
        
        return false;
    });
    
    $('#edit-entry-save-entry-button').on('click', function() {
        $('#edit-entry-form').validate({
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parent().parent().effect('shake', {times: 3}, 800);
                element.parent().append(error);
            },
            rules: {
                time_from: {
                    required: true
                },
                type: {
                    required: true,
                    valueNotEquals: 'none'
                }
            }
        });
        
        var type = $('#edit-entry-type-select').val();
        if( type == 'measurement' )
        {
        	if( $('#edit-entry-measurement-height-input').val() == '' && 
        		$('#edit-entry-measurement-weight-input').val() == '' &&
        		$('#edit-entry-measurement-systolic-blood-pressure-input').val() == '' &&
        		$('#edit-entry-measurement-diastolic-blood-pressure-input').val() == '' &&
        		$('#edit-entry-measurement-pulse-input').val() == '' )
        	{
	            $('#edit-entry-measurement-height-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#edit-entry-measurement-weight-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#edit-entry-measurement-systolic-blood-pressure-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#edit-entry-measurement-diastolic-blood-pressure-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
	            
	            $('#edit-entry-measurement-pulse-input').rules('add', {
	                required: true,
	                messages: {
	                	required: texts.atLeastOneOfThisFieldsIsRequired + '.'
	                }
	            });
			}
			else
			{
				$('#edit-entry-measurement-height-input').removeClass('error').rules('remove');
				$('#edit-entry-measurement-weight-input').removeClass('error').rules('remove');
				$('#edit-entry-measurement-systolic-blood-pressure-input').removeClass('error').rules('remove');
				$('#edit-entry-measurement-diastolic-blood-pressure-input').removeClass('error').rules('remove');
				$('#edit-entry-measurement-pulse-input').removeClass('error').rules('remove');
			}
			
			if( $('#edit-entry-measurement-height-input').val() != '' )
			{
	            $('#edit-entry-measurement-height-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#edit-entry-measurement-weight-input').val() != '' )
			{
	            $('#edit-entry-measurement-weight-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#edit-entry-measurement-systolic-blood-pressure-input').val() != '' )
			{
	            $('#edit-entry-measurement-systolic-blood-pressure-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#edit-entry-measurement-diastolic-blood-pressure-input').val() != '' )
			{
	            $('#edit-entry-measurement-systolic-blood-pressure-input').rules('add', {
	                number: true
	            });
			}
			
			if( $('#edit-entry-measurement-pulse-input').val() != '' )
			{
	            $('#edit-entry-measurement-pulse-input').rules('add', {
	                number: true
	            });
			}
        }
        else if( type == 'symptom' )
        {
            $('#edit-entry-symptom-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'medication' )
        {
            $('#edit-entry-medication-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'activity' )
        {
            $('#edit-entry-activity-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'food' )
        {
            $('#edit-entry-food-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'disease' )
        {
            $('#edit-entry-disease-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'event' )
        {
            $('#edit-entry-event-what-input').rules('add', {
                required: true
            });
        }
        else if( type == 'other' )
        {
            $('#edit-entry-other-what-input').rules('add', {
                required: true
            });
        }
    	
    	var isValid = $('#edit-entry-form').valid();
    	if( isValid )
    	{
	        var data = $('#edit-entry-form').serialize();
	        data = appendToQueryString(data, 'child_id', childId);
	        
	        $.ajax({
	           url: ajaxUrl + 'editEntry',
	           data: data
	        }).done( function(response) {
	        	console.log(response);
	            $('#edit-entry-modal').foundation('reveal', 'close');
	            getEntriesHtml();
	            toastr.success(texts.entrySaved + '!');
	        });
    	}
        
        return false;
    });
    
	$('#sign-up-birthday-input').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: "-115:+0",
	});
	
	$('.datepicker-input').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: "-115:+0",
	});
	
    $('#add-a-child-button').on('click', function() {
        $('#add-a-child-form').validate({
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parent().parent().effect('shake', {times: 3}, 800);
                element.parent().append(error);
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                gender: {
                    required: true
                },
                birthday: {
                    required: true
                },
            }
        });
        
        var isValid = $('#add-a-child-form').valid();
    	if( isValid )
    	{
    		var	data = $('#add-a-child-form').serialize();
    		
	        $.ajax({
	           url: ajaxUrl + 'addAChild',
	           data: data
	        }).done( function(response) {
	        	$('#add-a-child-form').slideUp();
	        		        	
	        	if( response == 'true' ) $('#add-a-child-success-alert').slideDown();
	        	else $('#add-a-child-error-alert').slideDown();
	        	
	        	getChildrenHtml();
	        });
    	}
    	
    	return false;
    });
    
    $('#edit-child-save-child-button').on('click', function() {
        $('#edit-child-form').validate({
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parent().parent().effect('shake', {times: 3}, 800);
                element.parent().append(error);
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                gender: {
                    required: true
                },
                birthday: {
                    required: true
                },
            }
        });
        
        var isValid = $('#edit-child-form').valid();
    	if( isValid )
    	{
    		var	data = $('#edit-child-form').serialize();
    		
	        $.ajax({
	           url: ajaxUrl + 'editChild',
	           data: data
	        }).done( function(response) {
	        	console.log(response);
	            $('#edit-child-modal').foundation('reveal', 'close');
	            getEntriesHtml();
	            toastr.success(texts.childSaved + '!');
	        	
	        	getChildrenHtml();
	        });
    	}
    	
    	return false;
    });
    
    $('#sign-up-button').on('click', function() {
        $('#sign-up-form').validate({
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parent().parent().effect('shake', {times: 3}, 800);
                element.parent().append(error);
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
					remote: {
						url: ajaxUrl + 'uniqueEmail'
					}
                },
                password: {
                    required: true,
                    minlength: 6
                },
                repeat_password: {
                    equalTo: '#sign-up-password-input'
                },
                gender: {
                    required: true
                },
                birthday: {
                    required: true
                },
            },
            messages: {
            	email: {
            		remote: texts.thisEmailAlreadyExistsInOurDatabase + '!'
            	}
            }
        });
        
        var isValid = $('#sign-up-form').valid();
    	if( isValid )
    	{
    		var	data = $('#sign-up-form').serialize();
    		
	        $.ajax({
	           url: ajaxUrl + 'signUp',
	           data: data
	        }).done( function(response) {
	        	$('#sign-up-form').slideUp();
	        		        	
	        	if( response == 'true' ) $('#sign-up-success-alert').slideDown();
	        	else $('#sign-up-error-alert').slideDown();
	        });
    	}
    	
    	return false;
    });
    
    $('#sign-in-button').on('click', function() {
        $('#sign-in-form').validate({
            errorElement: 'small',
            errorPlacement: function(error, element) {
                element.parent().parent().effect('shake', {times: 3}, 800);
                element.parent().append(error);
            },
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            }
        });
        
        var isValid = $('#sign-in-form').valid();
    	if( isValid )
    	{
    		var	data = $('#sign-in-form').serialize();
    		
	        $.ajax({
	           url: ajaxUrl + 'signIn',
	           data: data
	        }).done( function(response) {
	        	console.log(response);
	        	if( response == 'true' )
	        	{
	        		$('#sign-in-form').slideUp();
	        		$('#sign-in-success-alert').slideDown();
	        		
					setTimeout(function(){
						location.reload();
					}, 1500); 
	        	}
	        	else
	        	{
	        		$('#sign-in-error-alert').slideDown().effect('shake', {times: 3}, 800);;
	        	}
	        });
    	}
    	
    	return false;
    });
    
    $('#filter-by-type-select').on('change', function() {
    	var type = $('#filter-by-type-select').val();
    	
    	if( type == 'all' ) getEntriesHtml();
    	else getEntriesHtml('filter_type=' + type);
    });
    
    $('#sign-out-button').on('click', function() {
        $.ajax({
           url: ajaxUrl + 'signOut'
        }).done( function(response) {
			window.location.href=baseUrl;
        });
    });
    
    $('#children-table').on('click', '.remove-child-button', function() {
        var id = $(this).closest('tr').attr('data-id');
        
        $('#child-id-' + id).addClass('highlighted');
        
        var x = confirm(texts.areYouSureYouWantToDeleteThisChild + '?');
        if( x )
        {
        	var data = '';
        	data = appendToQueryString(data, 'id', id);
        	
	        $.ajax({
	           url: ajaxUrl + 'removeChild',
	           data: data
	        }).done( function(response) {
	        	console.log(response);
	            $('#child-id-' + id).remove();
	            
	            toastr.success(texts.childRemoved + '!');
	            
	            if( $('#children-table-body').html() == '' ) getEntriesHtml();
	        });
        }
        
        $('#child-id-' + id).removeClass('highlighted');
    });
    
    $('#entries-table').on('click', '.remove-entry-button', function() {
        var id = $(this).closest('tr').attr('data-id');
        
        $('#entry-id-' + id).addClass('highlighted');
        
        var x = confirm(texts.areYouSureYouWantToDeleteThisEntry + '?');
        if( x )
        {
        	var data = '';
        	data = appendToQueryString(data, 'child_id', childId);
        	data = appendToQueryString(data, 'id', id);
        	
	        $.ajax({
	           url: ajaxUrl + 'removeEntry',
	           data: data
	        }).done( function(response) {
	            $('#entry-id-' + id).remove();
	            
	            toastr.success(texts.entryRemoved + '!');
	            
	            if( $('#entries-table-body').html() == '' ) getEntriesHtml();
	        });
        }
        
        $('#entry-id-' + id).removeClass('highlighted');
    });
    
    $('#entries-table').on('click', '.edit-entry-button', function() {
        var id = $(this).closest('tr').attr('data-id');
        
        var data = '';
        var data = appendToQueryString(data, 'child_id', childId);
        var data = appendToQueryString(data, 'id', id);
        
        $.ajax({
           url: ajaxUrl + 'getEntry',
           data: data
        }).done( function(response) {
            var object = $.parseJSON(response);
            
            $.each( object, function( key, value ) {
                var element = $('#edit-entry-modal [name="' + key + '"]');
                
                if( element.get(0) )
                {
					var elementNode = element.get(0).nodeName;
					var inputType = '';
					
					if( elementNode == 'INPUT' ) inputType = $('#edit-entry-modal [name="' + key + '"]').attr('type');
					
                    if( elementNode == 'INPUT' || elementNode == 'TEXTAREA' ) 
                    {
                    	if( inputType == 'checkbox' )
                    	{
                    		if( value == '1' ) element.prop('checked', true).next().addClass('checked');
                    		else element.prop('checked', false).next().removeClass('checked');
                    		console.log(element.prop('checked'));
                    	}
                    	else element.val(value);
                    }
                    else if( elementNode == 'SELECT' ) 
                    {
                        element.val(value);
                        Foundation.libs.forms.refresh_custom_select(element, true); // Foundation bug!
                        element.trigger('change');
                    }
                }
            });
            
            $('#edit-entry-modal').foundation('reveal', 'open');
        });
    });
    
    $('#children-table').on('click', '.edit-child-button', function() {
        var id = $(this).closest('tr').attr('data-id');
        
        var data = '';
        var data = appendToQueryString(data, 'id', id);
        
        $.ajax({
           url: ajaxUrl + 'getChild',
           data: data
        }).done( function(response) {
            var object = $.parseJSON(response);
            
            $.each( object, function( key, value ) {
                var element = $('#edit-child-modal [name="' + key + '"]');
                
                if( element.get(0) )
                {
					var elementNode = element.get(0).nodeName;
					
                    if( elementNode == 'INPUT' || elementNode == 'TEXTAREA' ) element.val(value);
                    else if( elementNode == 'SELECT' ) 
                    {
                        element.val(value);
                        Foundation.libs.forms.refresh_custom_select(element, true); // Foundation bug!
                        element.trigger('change');
                    }
                }
            });
            
            $('#edit-child-modal').foundation('reveal', 'open');
        });
    });
});

/*********** Functions **********/
function getChildrenHtml(data)
{
	if( $('#children-table-body').length > 0 )
	{
	    $.ajax({
	       url: ajaxUrl + 'getChildrenHtml',
	       data: data
	    }).done( function(response) {
	    	var html = jQuery.parseJSON(response);
	    	
			$('#children-table-body').html(html);
	    });
	}
}

function getEntriesHtml(data)
{
	if( $('#entries-table-body').length > 0 )
	{
		data = appendToQueryString(data, 'child_id', childId);
		
	    $.ajax({
	       url: ajaxUrl + 'getEntriesHtml',
	       data: data
	    }).done( function(response) {
	    	var html = jQuery.parseJSON(response);
	    	
			$('#entries-table-body').html(html);
	    });
	}
	
	async(checkForAnomalies);
}

function checkForAnomalies()
{
	$('.measurement-bmi').each( function(index, element) {
		var el = $(element);
		var value = parseInt( el.text() );
		
		if( value <= 17.5 ) el.parent().addClass('highlighted').addClass('warning');
		if( value >= 25 ) el.parent().addClass('highlighted').addClass('warning');
		if( value >= 30 ) el.parent().addClass('highlighted').addClass('alert');
		if( value >= 35 ) el.parent().addClass('highlighted').addClass('extreme');
	});
	
	$('.measurement-systolic-blood-pressure').each( function(index, element) {
		var el = $(element);
		var value = parseInt( el.text() );
		
		if( value < 90 ) el.parent().addClass('highlighted').addClass('warning');
		if( value > 119 ) el.parent().addClass('highlighted').addClass('warning');
		if( value > 139 ) el.parent().addClass('highlighted').addClass('alert');
		if( value > 159 ) el.parent().addClass('highlighted').addClass('extreme');
	});
	
	$('.measurement-diastolic-blood-pressure').each( function(index, element) {
		var el = $(element);
		var value = parseInt( el.text() );
		
		if( value < 60 ) el.parent().addClass('highlighted').addClass('warning');
		if( value > 79 ) el.parent().addClass('highlighted').addClass('warning');
		if( value > 89 ) el.parent().addClass('highlighted').addClass('alert');
		if( value > 99 ) el.parent().addClass('highlighted').addClass('extreme');
	});
	
	$('.measurement-pulse').each( function(index, element) {
		var el = $(element);
		var value = parseInt( el.text() );
		
		if( childId  != 0 && !jQuery.isEmptyObject(childProfile) ) userProfile = childProfile;
		
		if( userProfile.age == 0 )
		{
			if( value < 80 || value > 150 ) el.parent().addClass('highlighted').addClass('warning');
		}
		
		if( userProfile.age >= 1 && userProfile.age <= 10 )
		{
			if( value < 70 || value > 130 ) el.parent().addClass('highlighted').addClass('warning');
		}
		
		if( userProfile.age > 10 )
		{
			if( value < 40 || value > 100 ) el.parent().addClass('highlighted').addClass('warning');
			if( value > 130 ) el.parent().addClass('highlighted').addClass('alert');
			if( value > 160 ) el.parent().addClass('highlighted').addClass('extreme');
		}
	});
	
	$('.measurement-fever').each( function(index, element) {
		var el = $(element);
		var value = parseInt( el.text() );
		
		if( value >= 37.5 ) el.parent().addClass('highlighted').addClass('warning');
		if( value >= 38 ) el.parent().addClass('highlighted').addClass('alert');
		if( value >= 39 ) el.parent().addClass('highlighted').addClass('extreme');
	});
}

function appendToQueryString(url, param, value)
{
	if( typeof url === 'undefined' ) url = param + '=' + value;
	else url = url + '&' + param + '=' + value;
	
	return url;
}

function formatTwoDiggits(n) 
{
    return n < 10 ? '0' + n : n;
}

function currentDateTime()
{
    var date = new Date();
    var currentDateTime = date.getFullYear() + "-" + 
        formatTwoDiggits( date.getMonth() ) + "-" + 
        formatTwoDiggits( date.getDate() ) + " " +  
        formatTwoDiggits( date.getHours() ) + ":" + 
        formatTwoDiggits( date.getMinutes() ) + ":" + 
        formatTwoDiggits( date.getSeconds() );
        
    return currentDateTime;
}

function async(your_function, callback) {
    setTimeout(function() {
        your_function();
        if (callback) {callback();}
    }, 0);
}

/********** jQuery Validate Methods **********/
jQuery.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg != value;
}, texts.youMustSelectAOption + '.');