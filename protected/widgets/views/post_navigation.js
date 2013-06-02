jQuery(function ($){
	var $nav = $('#widget-post-navigation')
	, $content = $('.widget-content', $nav)
	, $trigger = $('#trigger', $nav);
	$trigger.on('click', function(){
		var $this = $(this)
		if ($this.hasClass('icon-arrow-left')) {
			$nav.animate({
				'margin-right': '0px',				
			})
			$this.attr('class', 'icon-arrow-right')
			$this.attr('title', '隐藏文章目录')
		}else {
			$nav.animate({
				'margin-right': '-160px',
			})
			$this.attr('class', 'icon-arrow-left')
			$this.attr('title', '显示文章目录')
		}
	})
	
})
