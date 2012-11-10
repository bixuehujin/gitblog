<?php
/**
 * ClientScript class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

class ClientScript extends  CClientScript{
	
	public $globalName;
	
	private $_settings = array();
	
	public function init(){
		parent::init();
		if (!$this->globalName) {
			$this->globalName = 'Yii';
		}
	}
	
	
	/**
	 * 
	 * @param string $groupName 设置分组名称
	 * @param mixed $settings key-value
	 */
	public function registerSettings($groupName, $settings) {
		$this->_settings[$groupName] = $settings;
	}
	
	
	public function settingsToScript() {
		return 'var ' . $this->globalName . ' = '
			. json_encode($this->_settings) . ';';
	}
	
	
	public function renderHead(&$output) {
		$html = '';
		foreach($this->metaTags as $meta)
			$html .= CHtml::metaTag($meta['content'], null, null, $meta) . "\n";

		foreach($this->linkTags as $link)
			$html .= CHtml::linkTag(null, null, null, null, $link) . "\n";

		foreach($this->cssFiles as $url=>$media)
			$html .= CHtml::cssFile($url, $media) . "\n";

		foreach($this->css as $css)
			$html .= CHtml::css($css[0], $css[1]) . "\n";

		if($this->enableJavaScript){
			if(isset($this->scriptFiles[self::POS_HEAD])){
				foreach($this->scriptFiles[self::POS_HEAD] as $scriptFile)
					$html .= CHtml::scriptFile($scriptFile) . "\n";
			}
		
			if(isset($this->scripts[self::POS_HEAD]))
				$html .= CHtml::script(implode("\n", $this->scripts[self::POS_HEAD]))
					. "\n";
			
			if(!empty($this->_settings)) {
				$html .= CHtml::script($this->settingsToScript() . "\n") . "\n";
			}
		}
		
		if($html!==''){
			$count = 0;
			$output = preg_replace('/(<title\b[^>]*>|<\\/head\s*>)/is',
				'<###head###>$1',
				$output, 1, $count);

			if($count)
				$output = str_replace('<###head###>', $html, $output);
			else
				$output = $html . $output;
		}
	}
}

