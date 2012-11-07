<?php
/**
 * WeiboShow widget class file.
 * 
 * @author JinHu <bixuehujin@gmail.com>
 */

class WeiboShow extends CWidget {
	
	public $title = '我的微博';
	
	public $height = 550;
	public $uid;
	public $showTitle = 0;
	public $showBorder = 1;
	public $showFans = 1;
	public $fansRows = 2;
	public $showWeibo = 1;
	
	public function init() {
		if (is_null($this->uid)) {
			throw new Exception();
		}
	}
	
	public function run() {
		echo $this->buildHtml();
	}
	
	
	protected function buildHtml() {
		$tpl = <<<EOF
<div class="widget" id="weibo-widget">
<h3>{$this->title}</h3>
<div class="widget-swapper">
	<iframe width="100%" height="{$this->height}" 
		class="share_self"  
		frameborder="0"
		scrolling="no"
		src="http://widget.weibo.com/weiboshow/index.php?
	language=&width=0&height={$this->height}&
	fansRow={$this->fansRows}&ptype=1&speed=0&skin=1&
	isTitle={$this->showTitle}&noborder={$this->showBorder}&isWeibo={$this->showWeibo}&
	isFans={$this->showFans}&uid={$this->uid}&verifier=568f5a45&dpc=1">
	
	</iframe>
</div>
</div>
EOF;
		return $tpl;
	}
}
