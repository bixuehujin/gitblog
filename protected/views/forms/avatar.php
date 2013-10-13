<?php
/**
 * User avatar form template file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2012-04-19
 */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'avatar-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
))?>

<?php echo $form->fileField($model, 'files', array('name' => 'files[avatar]'))?>
<?php echo CHtml::submitButton(Yii::t('view', 'Upload Avatar'), array('class' => 'btn'))?>

<?php $this->endWidget()?>
