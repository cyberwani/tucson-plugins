jQuery(document).ready(function($){
	
	$('.mega-menu-content').each(function(){
		$(this).parents('li.dropdown').addClass('mega-menu-item mega-menu-fullwidth');
	});
	
	$('p:empty').remove();
	
});