import $ from 'jquery';
 var headernav, menuToggle, siteNavContain, ibar, iclose, searchOpen, searchClose, searchForm;

headernav       = $( '.header-nav' );
menuToggle     = headernav.find( '.menu-toggle' );
siteNavContain = headernav.find( '.menu' );
ibar 		   = menuToggle.find('.icon-bars');
iclose			= menuToggle.find('.icon-close');
searchOpen = headernav.find('.search-icon-form');
searchForm = headernav.find('#fullscreensearch');
searchClose = searchForm.find('.search-close');
//siteNavigation = masthead.find( '.main-navigation > div > ul' );

// Enable menuToggle.
(function() {

	// Return early if menuToggle is missing.
	if ( ! menuToggle.length ) {
		return;
	}

	// Add an initial value for the attribute.
	menuToggle.attr( 'aria-expanded', 'false' );

	menuToggle.on( 'click', function() {
		siteNavContain.toggleClass( 'toggled-on' );
		ibar.toggleClass('none');
		iclose.toggleClass('visible');
        
	$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
	 });
})();

	   /* SUBMENUs and Dropdown BUTTON and LEFT BUTTON FOR MENU */

$('.c-navigation').on('mouseenter', '.menu-item-has-children', (e) => {
    $(e.currentTarget).addClass('open');
}).on('mouseleave', '.menu-item-has-children', (e) => {
    $(e.currentTarget).removeClass('open');
})

$('.c-navigation').on('click', '.menu .menu-button', (e)=> {
    if(!$(e.currentTarget).parents('.sub-menu').length){
        $('.menu > .menu-item.open').find('> a > .menu-button').trigger('click');
    }
    e.preventDefault();
    e.stopPropagation();
    let menu_button = $(e.currentTarget);
    let menu_link = menu_button.parent();
    let menu_item = menu_link.parent();
    if(menu_item.hasClass('open')){
        menu_item.add(menu_item.find('.menu-item.open')).removeClass('open');
        menu_link.add(menu_item.find('a')).attr('aria-expanded', 'false');
        menu_button.find('.menu-button-show').attr('aria-hidden', 'false');
        menu_button.find('.menu-button-hide').attr('aria-hidden', 'true');
    } else {
        menu_item.siblings('.open').find('>a>.menu-button').trigger('click');
        menu_item.addClass('open');
        menu_link.attr('aria-expanded', 'true');
        menu_button.find('.menu-button-show').attr('aria-hidden', 'true');
        menu_button.find('.menu-button-hide').attr('aria-hidden', 'false');
    }
});

$(document).click((e) => {
    if($('.menu-item.open').length)
     $('.menu > .menu-item.open > a > .meu-button').trigger('click');
});

//////search window close/open with toggle button
searchOpen.on('click', function(){
    searchForm.addClass('open');
});
searchClose.on('click', function(){
    searchForm.removeClass('open');
});





          

