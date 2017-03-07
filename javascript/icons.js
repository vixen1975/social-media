$(window).load(function(){
	var allWidth = 35;
	var bg = '';
	var font = '';
	$('.fa-icon').each(function(){
	  bg = $(this).attr('data-clr');
	  font = $(this).attr('data-font');
	  
	  $(this).css({
		  'background-color': bg,
		  'color' : font
	  });
	  $(this).find('a').css('color', font);
	  allWidth = allWidth + $(this).width();
  });
  if($(window).width() >= 767){
	  $('.popup').css({
		  'right': '185px',
		  'width' : '115px',
		  'top' : '10px',
		  'background-color' : bg,
		  'color' : font,
		  'display' : 'none'
	  });
  } else {
	  $('.popup').css({
		  'right': '20px',
		  'width' : '250px',
		  'font-size' : '25px',
		  'height' : '50px',
		  'line-height' : '50px',
		  'text-align' : 'center',
		  'top' : '50px',
		  'background-color' : bg,
		  'color' : font,
		  'display' : 'none',
		  'box-shadow' : '0px 2px 4px #ccc'
	  });
  }
  
});

$('.fa-icon').mouseenter(function(){ 
	var hover = 'transparent';
	var font2 = $(this).attr('data-font2');
	
	$(this).css({
		'background-color': hover,
		 'color' : font2
	});
	$(this).find('a').css('color', font2);
	$(this).find('a .icon:before').css('color', font2);
})

$('.fa-icon').mouseleave(function(){
	var bg = 'transparent';
	var font = $(this).attr('data-font');
	
	$(this).css({
		'background-color': bg,
		 'color' : font
	});
	$(this).find('a').css('color', font);
	$(this).find('a .icon:before').css('color', font);
})
$('#icon-phone').click(function(){
	$('.popup').fadeToggle('slow');
})