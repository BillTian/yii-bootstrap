<?php
/**
 * BootModal class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since 0.9.3
 */

Yii::import('bootstrap.widgets.BootWidget');

/**
 * @todo DocBlock
 */
class BootModal extends BootWidget
{
	/**
	 * @var string the name of the container element. Defaults to 'div'.
	 */
	public $tagName = 'div';

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->registerScriptFile('bootstrap-modal.js');
		$this->htmlOptions['id'] = $this->getId();

		echo CHtml::openTag($this->tagName, $this->htmlOptions).PHP_EOL;
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		echo CHtml::closeTag($this->tagName);

		// Register the "show" event-handler.
		if (isset($this->events['show']))
		{
			$fn = CJavaScript::encode($this->events['show']);
			Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->id.'.show', "jQuery('#{$this->id}').on('show', {$fn});");
		}

		// Register the "shown" event-handler.
		if (isset($this->events['shown']))
		{
			$fn = CJavaScript::encode($this->events['shown']);
			Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->id.'.shown', "jQuery('#{$this->id}').on('shown', {$fn});");
		}

		// Register the "hide" event-handler.
		if (isset($this->events['hide']))
		{
			$fn = CJavaScript::encode($this->events['hide']);
			Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->id.'.hide', "jQuery('#{$this->id}').on('hide', {$fn});");
		}

		// Register the "hidden" event-handler.
		if (isset($this->events['hidden']))
		{
			$fn = CJavaScript::encode($this->events['hidden']);
			Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->id.'.hidden', "jQuery('#{$this->id}').on('hidden', {$fn});");
		}
	}
}
