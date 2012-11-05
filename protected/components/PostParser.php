<?php
/**
 * PostParser class file
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

Yii::import('application.vendors.Markdown.markdown', true);

/**
 * parse raw markdown file from github.
 */
class PostParser extends CComponent {
	/**
	 * @var string raw content fetch form github
	 */
	public $rawContent;
	/**
	 * @var string raw content triped meta infomation.
	 */
	public $rawBody;
	/**
	 * @var array reference related to this post.
	 */
	public $reference;
	/**
	 * @var array meta information extart form raw content.
	 */
	public $meta;
	/**
	 * @var string formatted html content.
	 */
	public $content;
	/**
	 * @var string regexp expression to extract meta data from raw content.
	 */
	protected $metaPattern = '/^-{3,}(.*)-{3,}/s';
	/**
	 * @var string regexp expression to extract reference information for raw content.
	 */
	protected $referencePattern = '/^#{2,}\s*(.*?)\s*#*\s*$/m';
	
	public function __construct($content) {
		$this->rawContent = $content;
	}
	
	public function init() {
		$this->rawBody = preg_replace_callback($this->metaPattern, function($matches) {
			$this->meta = $this->parseMetaData($matches[1]);
			return '';
		}, $this->rawContent);
		$this->rawBody = trim($this->rawBody, "\n");
		return true;
	}
	
	
	public function parse() {
		if($this->init()) {
			$this->content =  Markdown($this->rawBody);
			$this->reference = $this->parseReference($this->rawBody);
			return true;
		}
		return false;
	}
	
	/**
	 * parse meta data string into indexed array. 
	 * 
	 * @param string $metaStr
	 * @return array
	 */
	protected function parseMetaData($metaStr) {
		$meta = array();
		$metaStr = trim($metaStr, "\n");
		$items = explode("\n", $metaStr);
		if (empty($items)) return $meta;
		foreach($items as $item) {
			$item = trim($item);
			$re = explode(':', $item);
			if(count($re) > 1) {
				$meta[$re[0]] = trim($re[1]);
			}
		} 
		return $meta;
	}
	
	/**
	 * 
	 * @param string $rawBody
	 * @return array
	 */
	protected function parseReference($rawBody) {
		$reference = array();
		preg_match_all($this->referencePattern, $this->rawBody, $matches);
		$titles = $matches[1];
		$rawTitles = $matches[0];
		
		foreach ($titles as $key => $title) {
			$reference[] = array(
				'title'=> $title,
				'level' => $this->getLevel($rawTitles[$key]),
			);
		}
		return $this->constructReferenceTree($reference);
	}
	
	/**
	 * get the level of a title element by count the number of '#'
	 * 
	 * @param string $str
	 * @return int
	 */
	protected function getLevel($str) {
		$level = 0;
		while(isset($str[$level]) && $str[$level] == '#') {
			$level ++;
		}
		return $level;
	}
	
	/**
	 * construct a tree structure form a list of navigation item.
	 * 
	 * @param array $reference
	 * @return array
	 * <pre>
	 *     array(
	 *         array('label'=>label, 'url'=>url, 'items'=> array(
	 *         	   array(),
	 *         )),
	 *         array('label'=>label, 'url'=>url)
	 *     )
	 * </pre>
	 */
	protected function constructReferenceTree($reference) {
		if(empty($reference)) {
			return array();
		}
		
		$stack = new SplStack();
		
		$stack->push($reference[0]);
		unset($reference[0]);
		
		foreach ($reference as $item) {
			$top = $stack->top();
			if ($top['level'] <= $item['level']) {
				$stack->push($item);
			}else {
				do_again:
				
				$subArray = array();
				$top = $stack->top();
				
				while(true) {
					$tmp = $stack->top();
					if($tmp['level'] != $top['level']) 
						break;
					$subArray[] = $stack->pop();
				}
				
				$newArray = $stack->pop();
				$newArray['items'] = array_reverse($subArray);
				$stack->push($newArray);
				
				if ($newArray['level'] > $item['level']) {
					goto do_again;
				}
				
				$stack->push($item);
			}
		}
		
		$stack->rewind();
		$tree = array();
		while ($stack->valid()) {
			$tree[] = $stack->current();
			$stack->next();
		}
		return array_reverse($tree);
	}
	
}