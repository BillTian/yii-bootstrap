<?php
/**
 * BootModal class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 * @since 0.9.3
 */

/**
 * Bootstrap modal widget.
 */
class TbModal extends CWidget
{
	/**
	 * @var boolean indicates whether to automatically open the modal when initialized.
	 */
	public $autoOpen = false;
    /**
     * @var boolean indicates whether the modal should use transitions.
     */
    public $fade = true;
	/**
	 * @var array the options for the Bootstrap JavaScript plugin.
	 */
	public $options = array();
	/**
	 * @var string[] the JavaScript event handlers.
	 */
	public $events = array();
	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		if (!isset($this->htmlOptions['id']))
			$this->htmlOptions['id'] = $this->getId();

		if (!$this->autoOpen && !isset($this->options['show']))
			$this->options['show'] = false;

        $classes = array('modal');

        if ($this->fade === true)
            $classes[] = 'fade';

        if (!empty($classes))
        {
            $classes = implode(' ', $classes);
            if (isset($this->htmlOptions['class']))
                $this->htmlOptions['class'] .= ' '.$classes;
            else
                $this->htmlOptions['class'] = $classes;
        }

		echo CHtml::openTag('div', $this->htmlOptions).PHP_EOL;
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$id = $this->id;

		echo '</div>';

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';
		$cs->registerScript(__CLASS__.'#'.$id, "jQuery('#{$id}').modal({$options});");

		foreach ($this->events as $name => $handler)
		{
			$handler = CJavaScript::encode($handler);
			$cs->registerScript(__CLASS__.'#'.$id.'_'.$name, "jQuery('#{$id}').on('".$name."', {$handler});");
		}
	}
}
