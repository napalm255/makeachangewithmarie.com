/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version 	1.0.0
 * 
 * Post, Page, Project & Profile Options Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	$(document).ready(function () { 
		/* Options Tabs Change */
		$('h2.nav-tab-wrapper a.nav-tab').bind('click', function () { 
			if ($(this).is(':not(.nav-tab-active)')) {
				$(this).parent().find('a.nav-tab.nav-tab-active').removeClass('nav-tab-active');
				$(this).parent().parent().find('div.nav-tab-content.nav-tab-content-active').hide();
				$(this).addClass('nav-tab-active').parent().parent().find('div' + $(this).attr('href')).addClass('nav-tab-content-active').show();
			}
			
			return false;
		} );
		
		
		
		/* Uploaded Image Remove */
		$('table.form-table .cmsms_upload .cmsms_upload_cancel').bind('click', function () { 
			$(this).parent().fadeOut(500, function () {
				$(this).removeAttr('style').find('.cmsms_preview_image').attr('src', '');
				
				
				$(this).next().val('');
			} );
			
			
			return false;
		} );
		
		
		
		/* Number Field Type Script */
		$('table.form-table .cmsms-spinner-field').spinner( { 
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
		
		
		
		// Gallery Image Remove
		$('table.form-table .cmsms_gallery').on('click', '.cmsms_gallery_cancel', function () { 
			$(this).parents('li').fadeOut(500, function () {
				if ($(this).parents('ul').find('li').length < 2) {
					$(this).parents('ul').parent().find('.cmsms_upload_button').data( { 
						state : 	'gallery-library', 
						editing : 	false 
					} ).val(cmsms_options.create_gallery);
				}
				
				
				var listParent = $(this).parents('.cmsms_gallery_parent');
				
				
				$(this).remove();
				
				
				setTimeout(function () { 
					var newText = '';
					
					
					$('table.form-table .cmsms_gallery > li').each(function () { 
						newText += $(this).find('img').data('id') + '|';
						
						newText += $(this).find('img').attr('src') + ',';
					} );
					
					
					if (newText !== '') {
						newText = newText.slice(0, -1);
					}
					
					
					listParent.find('input[type="hidden"]').val(newText);
				}, 150);
			} );
			
			
			return false;
		} );
		
		// Sort Gallery Images
		$('table.form-table .cmsms_gallery').sortable( { 
			items : '> li', 
			handle : '> img', 
			tolerance : 'pointer', 
			opacity : 0.85, 
			cursor : 'move', 
			update : function (el) { 
				setTimeout(function () { 
					var newText = '';
					
					
					$('table.form-table .cmsms_gallery > li').each(function () { 
						newText += $(this).find('img').data('id') + '|';
						
						newText += $(this).find('img').attr('src') + ',';
					} );
					
					
					if (newText !== '') {
						newText = newText.slice(0, -1);
					}
					
					
					$(el.target).parents('.cmsms_gallery_parent').find('input[type="hidden"]').val(newText);
				}, 150);
			} 
		} );
		
		
		
		/* Repeatable Add Button Click */
		$('.repeatable-add').bind('click', function () { 
			var field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			$('input', field).val('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if ( 
				field.attr('style') !== undefined && 
				field.attr('style') !== '' && 
				(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
			) {
				field.removeAttr('style');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Link Add Button Click */
		$('.repeatable-link-add').bind('click', function () { 
			var select_name = $(this).prev().find('option:selected').text(), 
				select_link = $(this).prev().val(), 
				field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			$('input.cmsms_name', field).val((select_link !== '') ? select_name : '').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			$('input.cmsms_link', field).val((select_link !== '') ? select_link : '').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if ( 
				field.attr('style') !== undefined && 
				field.attr('style') !== '' && 
				(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
			) {
				field.removeAttr('style');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Multiple Add Button Click */
		$('.repeatable-multiple-add').bind('click', function () { 
			var field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			$('input.cmsms_name', field).val('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			$('textarea.cmsms_val', field).val('').text('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if ( 
				field.attr('style') !== undefined && 
				field.attr('style') !== '' && 
				(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
			) {
				field.removeAttr('style');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Media Add Button Click */
		$('.repeatable-media-add').bind('click', function () { 
			var select_format = $(this).prev().val(), 
				field = $(this).parents('td').find('.custom_repeatable li:last').clone(true), 
				fieldLocation = $(this).parents('td').find('.custom_repeatable li:last');
			
			if (select_format === '') {
				alert(cmsms_options.select_format);
				
				return false;
			}
			
			for (var i = 0, ilength = $(this).parents('td').find('.custom_repeatable li').length; i < ilength; i += 1) {
				if ($(this).parents('td').find('.custom_repeatable li:eq(' + i + ')').find('input.cmsms_format').val() === select_format) {
					alert(cmsms_options.link_exists);
					
					return false;
				}
			}
			
			$('input.cmsms_format', field).val(select_format).attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			$('input.cmsms_link', field).val('').attr('name', function (index, name) { 
				return name.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} ).attr('id', function (index, id) { 
				return id.replace(/(\d+)/, function (fullMatch, n) { 
					return Number(n) + 1;
				} );
			} );
			
			if ( 
				field.attr('style') !== undefined && 
				field.attr('style') !== '' && 
				(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
			) {
				field.removeAttr('style');
				
				field.insertAfter(fieldLocation, $(this).parents('td'));
				
				$(this).parents('td').find('.custom_repeatable li:first').remove();
			} else {
				field.insertAfter(fieldLocation, $(this).parents('td'));
			}
			
			return false;
		} );
		
		
		/* Repeatable Remove Button Click */
		$('.custom_repeatable').on('click', '.repeatable-remove', function () {
			if (confirm(cmsms_options.want_remove)) {
				if ($(this).parent().prev().is('li') || $(this).parent().next().is('li')) {
					$(this).parent().remove();
				} else {
					$(this).parent().css( { 
						display : 'none' 
					} );
					
					$(this).prev().val('');
					
					if ($(this).prev().prev().is('input')) {
						$(this).prev().prev().val('');
					}
				}
			}
			
			return false;
		} );
		
		
		/* Repeatable Copy Button Click */
		$('.custom_repeatable').on('click', '.repeatable-copy', function () {
			var field = $(this).parents('li'), 
				fieldTitle = field.find('input.cmsms_name').val(), 
				fieldValues = field.find('textarea.cmsms_val').val(), 
				fieldClone = field.clone();
			
			
			fieldClone.insertAfter(field);
			
			
			field.next().find('input.cmsms_name').val(fieldTitle);
			
			field.next().find('textarea.cmsms_val').val(fieldValues);
			
			
			setTimeout(function () { 
				var fields = field.parents('ul').find('li'), 
					i = 0;
				
				
				fields.each(function () { 
					$('input.cmsms_name', this).attr('name', function (index, name) { 
						return name.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} ).attr('id', function (index, id) { 
						return id.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} );
					
					
					$('textarea.cmsms_val', this).attr('name', function (index, name) { 
						return name.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} ).attr('id', function (index, id) { 
						return id.replace(/(\d+)/, function (fullMatch, n) { 
							return i;
						} );
					} );
					
					
					i += 1;
				} );
			}, 500);
			
			
			return false;
		} );
		
		
		/* Repeatable Sorting Script */
		$('.custom_repeatable').sortable( { 
			opacity : 0.7, 
			revert : true, 
			cursor : 'move', 
			handle : '.sort' 
		} );
		
		
		
		/* Project Size Change Script */
		$('.cmsms_tr_radio_img_pj input[type="radio"]').bind('change', function () { 
			var pj_size = $(this).attr('data-size');
			
			
			$(this).parents('tr.cmsms_tr_radio_img_pj').find('span.description > strong.pj_size').text(pj_size);
			
			
			return false;
		} );
		
		
		
		/* Icon Choose Script */
		$('.icon_choose_button').bind('click', function () { 
			if ($(this).parents('.icon_management').find('.icon_choose_container').is(':hidden')) {
				var icons = cmsms_composer_icons(), 
					hidden = $(this).prev().prev().val(), 
					fieldContent = '<div class="icons_list_parent">' + 
					'<div class="cmsms_icon_search">' + 
						'<label>' + cmsms_options.find + ':</label>' + 
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
				
				
				$(this).parents('.icon_management').find('.icon_choose_container').append(fieldContent).show();
				
				
				if (hidden !== '') {
					$(this).parents('.icon_management').find('.icon_choose_container .icons_list_parent ul li a.' + hidden).parent().addClass('active');
				}
			} else {
				$(this).parents('.icon_management').find('.icon_choose_container').hide().empty();
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
		
		
		
		/* Social Field Type Script */
		$('.icon_choose_container.icon_choose_social').on('click', '.icons_list_parent > ul > li > a', function () { 
			var parentLi = $(this).parent(), 
				li = $(this).parents('.icons_list_parent').find('> ul > li'), 
				hidden = $(this).parents('.icon_choose_container.icon_choose_social').prev().find('#new_icon_name'), 
				icon = $(this).parents('.icon_choose_container.icon_choose_social').prev().find('#new_icon_icon'), 
				link = $(this).parents('.icon_choose_container.icon_choose_social').next().next();
			
			
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
			
			
			if (confirm(cmsms_options.remove_icon)) {
				$('#custom_icons_number').val(del_icon_number);
				
				
				if ( 
					$('#edit_icon').is(':visible') && 
					$('#edit_icon').data('id') === $(this).parent().find('input[type="hidden"]').attr('id') 
				) {
					$('#cancel_icon').trigger('click');
				}
				
				
				$(this).parent().remove();
				
				
				var li_input = undefined, 
					li_input_val = '';
				
				
				for (var n = 1; n <= del_icon_number; n += 1) {
					li_input = $('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
					
					
					li_input_val = li_input.attr('name').split('[');
					
					
					$('.icon_management > ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
						name : 	li_input_val[0] + '[' + n + ']', 
						id : 	li_input_val[0] + '_' + n 
					} );
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
			
			
			$('.icon_choose_container.icon_choose_social .icons_list_parent > ul > li.active').removeAttr('class');
			
			
			return false;
		} );
		
		
		$('#add_icon').click(function () { 
			if ($('#new_icon_name').val() !== '') {
				var icon_number = Number($('#custom_icons_number').val()) + 1, 
					icon_name = $('#custom_icons_number').attr('name').split('_number');
				
				
				$('#custom_icons_number').val(icon_number);
				
				
				$('.icon_management > ul').append('<li>' + 
					'<div class="' + $('#new_icon_name').val() + '">' + 
						'<input type="hidden" id="' + icon_name[0] + '_' + icon_number + '" name="' + icon_name[0] + '[' + icon_number + ']" value="' + $('#new_icon_name').val() + '|' + (($('#new_icon_link').val() != '') ? $('#new_icon_link').val() : '#') + '|' + $('#new_icon_title').val() + '|' + (($('#new_icon_target').is(':checked')) ? 'true' : 'false') + '" />' + 
					'</div>' + 
					'<a href="#" class="icon_del admin-icon-remove" title="' + cmsms_options.remove + '"></a> ' + 
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
				
				
				$('.icon_choose_container.icon_choose_social .icons_list_parent > ul > li.active').removeAttr('class');
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
			
			
			$('.icon_choose_container.icon_choose_social .icons_list_parent > ul > li.active').removeAttr('class');
			
			
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
		
		
		/* Icon Field Type Script */
		$('.icon_choose_container.icon_choose_heading').on('click', '.icons_list_parent > ul > li > a', function () { 
			var parentLi = $(this).parent(), 
				li = $(this).parents('.icons_list_parent').find('> ul > li'), 
				hidden = $(this).parents('.icon_choose_container.icon_choose_heading').prev().find('.icon_upload_image'), 
				icon = $(this).parents('.icon_choose_container.icon_choose_heading').prev().find('#new_icon_img');
			
			
			if (parentLi.hasClass('active')) {
				parentLi.removeClass('active');
				
				
				hidden.val('');
				
				
				icon.removeAttr('class');
				
				
				$('#remove_icon').hide();
			} else {
				li.removeClass('active');
				
				
				parentLi.addClass('active');
				
				
				hidden.val($(this).attr('class'));
				
				
				icon.removeAttr('class').addClass($(this).attr('class'));
				
				
				$('#remove_icon').show();
			}
			
			
			return false;
		} );
		
		
		$('#remove_icon').click(function () { 
			$(this).parents('.icon_management').find('#new_icon_img').removeAttr('class');
			
			
			$(this).parents('.icon_management').find('.icon_upload_image').val('');
			
			
			$(this).parents('.icon_management').find('.icon_choose_container.icon_choose_heading .icons_list_parent > ul > li.active').removeAttr('class');
			
			
			$('#remove_icon').hide();
			
			
			return false;
		} );
	} );
} )(jQuery);



/* Update Media Uploader Images ID's Function */
function cmsmsOptionsUploadIdsUpdate() { 
	var href_array = '';
	
	
	jQuery('ul.gallery_post_image_list > li').each(function () { 
		href_array += jQuery(this).find('> a').attr('href') + ',';
	} );
	
	
	jQuery('ul.gallery_post_image_list').next().val(href_array.slice(0, -1));
}

