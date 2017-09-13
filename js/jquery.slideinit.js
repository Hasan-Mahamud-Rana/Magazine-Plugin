jQuery(document).ready(function($){
	$('.magazineSlide').slick({
		dots: true,
		autoplay: true,
		autoplaySpeed: 10000,
		speed: 1000,
		infinite: true,
		arrows: true,
		nextArrow: '<button type="button" style="color:#ffffff; font-size:20px;background:#a1497c;" class="slick-next circle-bg"><i class="ultsl-arrow-right4"></i></button>',
		prevArrow: '<button type="button" style="color:#ffffff; font-size:20px;background:#a1497c;" class="slick-prev circle-bg"><i class="ultsl-arrow-left4"></i></button>',
		slidesToScroll:3,
		slidesToShow:3,
		swipe: true,
		draggable: true,
		touchMove: true,
		responsive: [
			{
				breakpoint: 1025,
				settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
			}
		},
		{
				breakpoint: 769,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		},
		{
				breakpoint: 481,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
		}
	}
	],pauseOnHover: true,
	pauseOnDotsHover: true,customPaging: function(slider, i) {
                   return '<i type="button" style="color:#ffffff;" class="ultsl-record" data-role="none"></i>';
	},});
});