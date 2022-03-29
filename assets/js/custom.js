// Sticky header
 if (window.matchMedia('(min-width: 767px)').matches) 
{
$('.header').addClass('original').clone().insertAfter('.header').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','9999').removeClass('original').hide();
scrollIntervalID = setInterval(stickIt, 10);
function stickIt() {

  var orgElementPos = $('.original').offset();
  orgElementTop = orgElementPos.top;               

  if ($(window).scrollTop() >= (orgElementTop)) {
    // scrolled past the original position; now only show the cloned, sticky element.

    // Cloned element should always have same left position and width as original element.     
    orgElement = $('.original');
	
    coordsOrgElement = orgElement.offset();
    leftOrgElement = coordsOrgElement.left;  
    widthOrgElement = orgElement.css('width');
    $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
    $('.original').css('visibility','hidden');
    } else {
    // not scrolled past the menu; only show the original menu.
    $('.cloned').hide();
    $('.original').css('visibility','visible');
	
   }
  }
}



// Back to Top
 $(document).ready( function() {
                $('#backTop').backTop({
                    'position' : 200,
                    'speed' : 500,
                    'color' : 'red',
                });
            });
!function(o){o.fn.backTop=function(e){var n=this,i=o.extend({position:400,speed:500,color:"white"},e),t=i.position,c=i.speed,d=i.color;n.addClass("white"==d?"white":"red"==d?"red":"green"==d?"green":"black"),n.css({right:25,bottom:40,position:"fixed"}),o(document).scroll(function(){var e=o(window).scrollTop();console.log(e),e>=t?n.fadeIn(c):n.fadeOut(c)}),n.click(function(){o("html, body").animate({scrollTop:0},{duration:1200})})}}(jQuery);



