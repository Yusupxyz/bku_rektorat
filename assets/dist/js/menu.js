   $(document).ready(function () {
   	$('.sidebar-menu').tree()
   })
   $(function () {
   	$('#sidebar-form').on('submit', function (e) {
   		e.preventDefault();
   	});
   	$('.sidebar-menu li.active').data('lte.pushmenu.active', true);
   	$('#search-input').on('keyup', function () {
   		var term = $('#search-input').val().trim();
   		if (term.length === 0) {
   			$('.sidebar-menu li').each(function () {
   				$(this).show(0);
   				$(this).removeClass('active');
   				if ($(this).data('lte.pushmenu.active')) {
   					$(this).addClass('active');
   				}
   			});
   			return;
   		}
   		$('.sidebar-menu li').each(function () {
   			if ($(this).text().toLowerCase().indexOf(term.toLowerCase()) === -1) {
   				$(this).hide(0);
   				$(this).removeClass('pushmenu-search-found', false);
   				if ($(this).is('.treeview')) {
   					$(this).removeClass('active');
   				}
   			} else {
   				$(this).show(0);
   				$(this).addClass('pushmenu-search-found');
   				if ($(this).is('.treeview')) {
   					$(this).addClass('active');
   				}
   				var parent = $(this).parents('li').first();
   				if (parent.is('.treeview')) {
   					parent.show(0);
   				}
   			}
   			if ($(this).is('.header')) {
   				$(this).show();
   			}
   		});

   		$('.sidebar-menu li.pushmenu-search-found.treeview').each(function () {
   			$(this).find('.pushmenu-search-found').show(0);
   		});
   	});
   });
