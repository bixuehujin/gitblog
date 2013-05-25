<?php
/**
 * User articles list template file.
 * 
 * @var Controller $this
 * @var CActiveDataProvider $provider
 */
?>

<?php $this->renderPartial('/post/_posts', array('provider' => $provider))?>
