//navbar mob
$(document).ready(function(){
	$(".show-nav").click(function(){
		$(".left-sidebar").css({
			'display' : 'block',
			'width' : '100%'
		})
		$(".main-content").css({
			'display' : 'none',
		});
		$(".show-nav").hide();
		$(".hide-nav").show();
	})
	$(".hide-nav").click(function(){
		$(".left-sidebar").css({
			'display' : 'none',
			'width' : '0'
		})
		$(".main-content").css({
			'display' : 'block',
			'width' : '100%'

		});
		$(".show-nav").show();
		$(".hide-nav").hide();
	})
})


//filtering row
$(document).ready(function(){
	$(".filter-item").click(function(){
		var selectItem 	= $(this).attr('id');
		var selectRow 	= $(this).attr('id');
		if( selectItem != 'all' ){
			$(".filter-item").removeClass("active-item");
			$("." + selectItem).addClass("active-item");
		}
		if( selectRow != 'all' ){
			$(".filter-row").removeClass("active-row");
			$(".filter-row").removeClass("active-item");
			$("." + selectRow).addClass("active-row");
		}
	})
})