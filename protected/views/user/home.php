<?php
/**
 * User feed home template file.
 * 
 * @var CActiveDataProvider $provider  
 */
?>

<?php 
$this->renderPartial('/post/_posts', array('provider' => $provider))
?>
