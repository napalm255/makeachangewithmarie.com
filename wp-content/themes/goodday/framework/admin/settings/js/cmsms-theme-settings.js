/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version 	1.0.0
 * 
 * Admin Panel Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	$(document).ready(function () { 
		/* Color Field Type Script */
		$('.cmsms-color-field').wpColorPicker( { 
			palettes : [ 
				'#000000', 
				'#ffffff', 
				'#4ecdc4', 
				'#ff6b6b', 
				'#556270', 
				'#aed957', 
				'#707070', 
				'#3d3d3d' 
			] 
		} );
		
		
		/* Number Field Type Script */
		$('.cmsms-spinner-field').spinner( { 
			change : function (event, ui) { 
				if ($(this).attr('aria-valuenow') !== undefined) {
					if ($(this).attr('min') !== undefined && Number($(this).val()) < Number($(this).attr('min'))) {
						$(this).val($(this).attr('min'));
					}
					
					
					if ($(this).attr('max') !== undefined && Number($(this).val()) > Number($(this).attr('max'))) {
						$(this).val($(this).attr('max'));
					}
					
					
					if ($(this).attr('step') !== undefined && (Number($(this).val()) % Number($(this).attr('step'))) !== 0) {
						$(this).val(Number($(this).attr('step')) * parseInt(Number($(this).val()) / Number($(this).attr('step'))));
					}
				} else {
					if ($(this).attr('min') !== undefined) {
						$(this).val($(this).attr('min'));
					} else {
						$(this).val(0);
					}
				}
			} 
		} );
		
		
		/* Uploaded Image Remove */
		$('table.form-table .cmsms_upload .cmsms_upload_cancel').bind('click', function () { 
			$(this).parent().fadeOut(500, function () {
				$(this).removeAttr('style').find('.cmsms_preview_image').attr('src', '');
				
				
				$(this).next().val('');
			} );
			
			
			return false;
		} );
		
		
		/* Sidebars Field Type Script */
		$('.sidebar_management').on('click', '.sidebar_del', function () { 
			var del_sidebar_number = Number($('#custom_sidebars_number').val()) - 1, 
				li_input = undefined, 
				li_input_val = '';
			
			
			if (confirm(cmsms_setting.remove_sidebar)) {
				$('#custom_sidebars_number').val(del_sidebar_number);
				
				
				$(this).parent().remove();
				
				
				for (var n = 1; n <= del_sidebar_number; n += 1) {
					li_input = $('.sidebar_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
					
					
					li_input_val = li_input.attr('name').split('_-_');
					
					
					$('.sidebar_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { name :  li_input_val[0] + '_-_' + n + ']'} );
				}
			}
			
			
			return false;
		} );
		
		
		$('#add_sidebar').click(function () {
			if ($('#new_sidebar_name').val() !== '') {
				var sidebar_number = Number($('#custom_sidebars_number').val()) + 1, 
					sidebar_name = $('#custom_sidebars_number').attr('name').split('_number]');
				
				
				$('#custom_sidebars_number').val(sidebar_number);
				
				
				$('.sidebar_management ul').append('<li>' + 
					'<a href="#" class="sidebar_del admin-icon-remove" title="' + cmsms_setting.remove + '"></a> ' + 
					$('#new_sidebar_name').val() + 
					'<input type="hidden" name="' + sidebar_name[0] + '_-_' + sidebar_number + ']" value="' + $('#new_sidebar_name').val() + '" />' + 
				'</li>');
				
				
				$('#new_sidebar_name').val('');
			}
			
			
			return false;
		} );


		/* Social Field Type Script */
		$('.icon_choose_button').bind('click', function () { 
			if ($('.icon_choose_container').is(':hidden')) {
				var icons = cmsms_composer_icons(), 
					hidden = $(this).prev().prev().val(), 
					fieldContent = '<div class="icons_list_parent">' + 
					'<div class="cmsms_icon_search">' + 
						'<label>' + cmsms_setting.find + ':</label>' + 
						'<input type="text" name="cmsms_icon_search" />' + 
					'</div>' + 
					'<div class="cl" />';
				
				
				for (var font in icons) {
					fieldContent += '<h3>' + font.slice(0, 1).toUpperCase() + font.slice(1) + '</h3>' + 
					'<ul>';
					
					
					for (var k in icons[font]) {
						fieldContent += '<li><a class="' + icons[font][k] + '" data-code="' + k + '" title="' + k + '" /></li>';
					}
					
					
					fieldContent += '</ul>';
				}
				
				
				fieldContent += '</div>';
				
				
				$('.icon_choose_container').append(fieldContent).show();
				
				
				if (hidden !== '') {
					$('.icon_choose_container .icons_list_parent ul li a.' + hidden).parent().addClass('active');
				}
			} else {
				$('.icon_choose_container').empty().hide();
			}
		} );
		
		
		
		$('.icon_choose_container').on('input', '.cmsms_icon_search > input[type="text"]', function () { 
			var val = $(this).val();
			
			
			if (val !== '') {
				$(this).parents('.icons_list_parent').find('> ul > li > a').each(function () { 
					var code = $(this).data('code');
					
					
					if (code.replace(val, '') !== code) {
						$(this).parent().removeAttr('style');
					} else {
						$(this).parent().css('display', 'none');
					}
				} );
			} else {
				$(this).parents('.icons_list_parent').find('> ul > li').removeAttr('style');
			}
		} );
		
		
		
		$('.icon_choose_container').on('click', '.icons_list_parent > ul > li > a', function () { 
			var parentLi = $(this).parent(), 
				li = $(this).parents('.icons_list_parent').find('> ul > li'), 
				hidden = $(this).parents('.icon_choose_container').prev().find('#new_icon_name'), 
				icon = $(this).parents('.icon_choose_container').prev().find('#new_icon_icon'), 
				link = $(this).parents('.icon_choose_container').next().next();
			
			
			if (parentLi.hasClass('active')) {
				parentLi.removeClass('active');
				
				
				if ($('#edit_icon').is(':not(:visible)')) {
					hidden.val('');
					
					
					icon.removeAttr('class');
					
					
					link.hide();
					
					
					$('#add_icon').hide();
					
					$('#cancel_icon').hide();
				}
			} else {
				li.removeClass('active');
				
				
				parentLi.addClass('active');
				
				
				hidden.val($(this).attr('class'));
				
				
				icon.removeAttr('class').addClass($(this).attr('class'));
				
				
				link.show();
				
				
				if ($('#edit_icon').is(':not(:visible)')) {
					$('#add_icon').show();
				}
				
				
				$('#cancel_icon').show();
			}
			
			
			return false;
		} );
		
		
		
		$('.icon_management').on('click', '.icon_del', function () { 
			var del_icon_number = Number($('#custom_icons_number').val()) - 1;
			
			
			if (confirm(cmsms_setting.remove_icon)) {
				$('#custom_icons_number').val(del_icon_number);
				
				
				$(this).parent().remove();
				
				
				var li_input = undefined, 
					li_input_val = '';
				
				
				for (var n = 1; n <= del_icon_number; n += 1) {
					li_input = $('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
					
					
					li_input_val = li_input.attr('name').split('_-_');
					
					
					$('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
						name : 	li_input_val[0] + '_-_' + n + ']', 
						id : 	li_input_val[0] + '_-_' + n + ']' 
					} );
				}
				
				
				if ( 
					$('#edit_icon').is(':visible') && 
					$('#edit_icon').data('id') === $(this).parent().find('input[type="hidden"]').attr('id') 
				) {
					$('#cancel_icon').trigger('click');
				}
			}
			
			
			return false;
		} );
		
		
		
		$('.icon_management > ul').on('click', '> li > div', function () { 
			var edit_icon_val = $(this).find('input[type="hidden"]').val().split('|'), 
				edit_icon_class = $(this).attr('class');
				edit_icon_id = $(this).find('input[type="hidden"]').attr('id');
			
			
			$('#add_icon').hide();
			
			
			$('#edit_icon').attr( { 
				'data-id' : edit_icon_id 
			} ).show();
			
			
			$('#new_icon_icon').removeAttr('class').addClass(edit_icon_val[0]);
			
			
			$('#new_icon_name').val(edit_icon_val[0])
			
			$('#new_icon_link').val(edit_icon_val[1]);
			
			$('#new_icon_title').val(edit_icon_val[2]);
			
			
			$('#new_icon_target').prop('checked', ((edit_icon_val[3] == 'true') ? true : false));
			
			
			$('.icon_upload_link').show();
			
			$('#cancel_icon').show();
			
			
			$('.icon_choose_container .icons_list_parent > ul > li.active').removeAttr('class');
			
			
			return false;
		} );
		
		
		
		$('#add_icon').click(function () { 
			if ($('#new_icon_name').val() !== '') {
				var icon_number = Number($('#custom_icons_number').val()) + 1, 
					icon_name = $('#custom_icons_number').attr('name').split('_number]'), 
					icons_id = icon_name[0].split('[');
				
				
				$('#custom_icons_number').val(icon_number);
				
				
				$('.icon_management > ul').append('<li>' + 
					'<div class="' + $('#new_icon_name').val() + '">' + 
						'<input type="hidden" id="' + icons_id[0] + '_' + icons_id[1] + '_-_' + icon_number + '" name="' + icon_name[0] + '_-_' + icon_number + ']" value="' + $('#new_icon_name').val() + '|' + (($('#new_icon_link').val() != '') ? $('#new_icon_link').val() : '#') + '|' + $('#new_icon_title').val() + '|' + (($('#new_icon_target').is(':checked')) ? 'true' : 'false') + '" />' + 
					'</div>' + 
					'<a href="#" class="icon_del admin-icon-remove" title="' + cmsms_setting.remove + '"></a> ' + 
					'<span class="icon_move icon-move"></span> ' + 
				'</li>');
				
				
				$('#new_icon_icon').removeAttr('class');
				
				
				$('#new_icon_name').val('');
				
				$('#new_icon_link').val('');
				
				$('#new_icon_title').val('');
				
				
				$('#new_icon_target').prop('checked', false);
				
				
				$('.icon_upload_link').hide();
				
				
				$('#add_icon').hide();
				
				$('#cancel_icon').hide();
				
				
				$('.icon_choose_container .icons_list_parent > ul > li.active').removeAttr('class');
			}
			
			
			return false;
		} );
		
		
		
		$('#edit_icon').click(function () { 
			var edit_icon_data_id = $(this).attr('data-id');
			
			
			if ($('#new_icon_name').val() !== '') {
				$('input#' + edit_icon_data_id).val($('#new_icon_name').val() + '|' + (($('#new_icon_link').val() != '') ? $('#new_icon_link').val() : '#') + '|' + $('#new_icon_title').val() + '|' + (($('#new_icon_target').is(':checked')) ? 'true' : 'false'));
				
				
				$('input#' + edit_icon_data_id).parent().removeAttr('class').addClass($('#new_icon_name').val());
				
				
				$('#new_icon_icon').removeAttr('class');
				
				
				$('#new_icon_name').val('');
				
				$('#new_icon_link').val('');
				
				$('#new_icon_title').val('');
				
				
				$('#new_icon_target').prop('checked', false);
				
				
				$('.icon_upload_link').hide();
				
				
				$('#edit_icon').hide();
				
				$('#cancel_icon').hide();
			}
			
			
			return false;
		} );
		
		
		
		$('#cancel_icon').click(function () { 
			$('#new_icon_icon').removeAttr('class');
			
			
			$('#new_icon_name').val('');
			
			$('#new_icon_link').val('');
			
			$('#new_icon_title').val('');
			
			
			$('#new_icon_target').prop('checked', false);
			
			
			$('.icon_upload_link').hide();
			
			
			$('#edit_icon').hide();
			
			$('#add_icon').hide();
			
			$('#cancel_icon').hide();
			
			
			$('.icon_choose_container .icons_list_parent > ul > li.active').removeAttr('class');
			
			
			return false;
		} );
		
		
		
		$('.icon_management > ul').sortable( { 
			items : 		'> li', 
			placeholder : 	'ui-sortable-highlight', 
			handle : 		'.icon_move', 
			update : 		function () { 
				var numb = 1;
				
				
				$(this).find('> li > div > input').each(function () { 
					$(this).attr('id', $(this).attr('id').slice(0, -1) + numb);
					
					
					$(this).attr('name', $(this).attr('name').slice(0, -2) + numb + ']');
					
					
					numb += 1;
				} );
				
				
				if ($('#edit_icon').is(':visible')) {
					$('#cancel_icon').trigger('click');
				}
			} 
		} );
	} );
} )(jQuery);


/* Field Error Highlight Script */
(function ($) { 
	var error_msg = $('#message p[class="setting-error-message"]');
	
	
	if (error_msg.length != 0) {
		var error_setting = error_msg.attr('title');
		
		
		$('label[for="' + error_setting + '"]').addClass('error');
		
		
		$('input[id="' + error_setting + '"]').attr('style', 'border-color:red');
	}
} )(jQuery);


/* Import Button Click Function */
(function ($) { 
	$('.cmsms-demo-import').bind('click', function () { 
		var settings_field = 	$('#' + cmsms_setting.shortname + '_demo_import'), 
			theme_settings = 	settings_field.val(), 
			importer_url = 		cmsms_setting.theme_uri + '/framework/admin/settings/inc/settings-import.php';
		
		
		$.ajax( { 
			type : 		'POST', 
			url : 		importer_url, 
			data : { 
						settings : 	theme_settings 
			}, 
			dataType : 	'text' 
		} ).done(function () { 
			settings_field.val('');
			
			
			alert(cmsms_setting.done);
		} ).fail(function () { 
			alert(cmsms_setting.fail);
		} );
	} );
} )(jQuery);


/* Export Button Click Function */
(function ($) { 
	$('.cmsms-demo-export').bind('click', function () { 
		document.location = cmsms_setting.theme_uri + '/framework/admin/settings/inc/settings-export.php';
	} );
} )(jQuery);

