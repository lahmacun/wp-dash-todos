(function( $ ) {
	'use strict';

	$(document).on('keypress', '.wdt-entry-input', function(e) {
		if (e.which == 13) {
			var itemValue = e.target.value;
			$('.wdt-tasks').append('<li>\n' +
				'\t\t\t\t\t<label class="wdt-task">\n' +
				'\t\t\t\t\t\t<input type="checkbox" />\n' +
				'\t\t\t\t\t\t<span class="wdt-task-content">' + itemValue + '</span>\n' +
				'\t\t\t\t\t</label>\n' +
				'\t\t\t\t\t<div class="wdt-actions">\n' +
				'\t\t\t\t\t\t<a href="#" class="wdt-trash"><span class="dashicons dashicons-trash"></span></a>\n' +
				'\t\t\t\t\t</div>\n' +
				'\t\t\t\t</li>');
			e.target.value = "";

			$.saveTodos();
		}
	});

	$(document).on('change', '.wdt-task input[type=checkbox]', function(e) {
		var checked = e.target.checked;
		if (checked) {
			$(this).parent().parent().addClass('completed');
		} else {
			$(this).parent().parent().removeClass('completed');
		}
		$.saveTodos();
	});

	$(document).on('click', '.wdt-trash', function(e) {
		e.preventDefault();
		$(this).parent().parent().remove();
		$.saveTodos();
	});

	$.saveTodos = function() {
		const todos = [];

		$('.wdt-content .wdt-tasks li').each(function(index, item) {
			todos.push({
				text: $(item).find('.wdt-task-content').text(),
				done: $(item).find('input[type=checkbox]').prop('checked'),
			});
		});

		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {action: 'wdt_save_todos', todo_items: JSON.stringify(todos)},
			success: function(response) {
				if (response.status == 'failure') {
					alert('Error occured: ' + response.message);
				} else {
					console.log('Saved');
				}
			}
		});
	}

})( jQuery );
