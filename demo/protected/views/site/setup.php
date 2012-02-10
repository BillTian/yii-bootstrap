<?php $this->pageTitle = Yii::app()->name.' - Setup'; ?>

<section id="setup">

	<h2>Setup</h2>

	<p class="alert alert-block alert-info">Please note that these installation instructions are for Bootstrap 0.9.8</p>

	<p>Download the latest release.</p>

	<p>
		<?php echo CHtml::link('<i class="icon-share icon-white"></i> Get Yii-Bootstrap from Yii extensions',
				'http://www.yiiframework.com/extension/bootstrap/', array('class'=>'btn btn-primary btn-large', 'target'=>'_blank')); ?>
	</p>

	<p>Unzip the extension under <strong>protected/extensions/bootstrap</strong> and add the following code to your application configuration:</p>

<?php echo $parser->safeTransform("~~~
[php]
'preload'=>array(
    .....
    'bootstrap', // preload the bootstrap component
),
'modules'=>array(
    .....
    'gii'=>array(
        .....
        'generatorPaths'=>array(
            'bootstrap.gii', // since 0.9.1
        ),
    ),
),
'components'=>array(
    .....
    'bootstrap'=>array(
        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
        'coreCss'=>true // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
        'responsiveCss'=>false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
        'plugins'=>array(
            // Optionally you can configure the \"global\" plugins (button, popover, tooltip and transition)
            // To prevent a plugin from being loaded set it to false as demonstrated below
            'transition'=>false, // disable CSS transitions
            'tooltip'=>array(
                'selector'=>'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
                'options'=>array(
                    'placement'=>'bottom', // place the tooltips below instead
				),
            ),
            .....
            // If you need help with configuring the plugins, please refer to Bootstrap's own documentation:
			// http://twitter.github.com/bootstrap/javascript.html
        ),
    ),
),
~~~"); ?>

	<p>
		You're done! Now you can start using Bootstrap in your application. For examples on how to use the widgets please visit the
		<?php echo CHtml::link('demo page', array('site/index')); ?>.
	</p>

</section>

<section id="less">

	<h2>Using LESS</h2>

	<p>
		If you haven't tried LESS yet now is the time, you won't be disappointed. LESS is a dynamic stylesheet language
		that extends CSS with dynamic behavior such as variable, mixins, operations and functions. Bootstrap itself is
		written in LESS and comes with a wide variety of useful mixins, operations and functions that you can use in your
		own LESS.
	</p>

	<p>
		The easiest way to use LESS is to include <?php echo CHtml::link('the native JavaScript compiler', 'http://www.lesscss.org'); ?>.
		Alternatively you can use my <?php echo CHtml::link('LESS extension', 'http://www.yiiframework.com/extension/less'); ?>
		which uses <?php echo CHtml::link('Agar\'s PHP LESS compiler', 'https://github.com/agar/less.php'); ?>.
		When you have set up the LESS compiler of your choice create a <strong>less</strong> folder under your webroot
		and create a <strong>styles.less</strong> file with the following content:
	</p>

<?php echo $parser->safeTransform("~~~
[css]
/*
	IMPORTS
*/

// Import the Bootstrap mixins, operations and functions so that you can use them in this file.
@import \"../protected/extensions/bootstrap/lib/bootstrap/less/mixins.less\";

/*
	VARIABLES
*/

// Your variables goes here ...

/*
	MIXINS
*/

// Your mixins goes here ...

/*
	RULES
*/

// Your rules goes here ...
~~~"); ?>

	<p>
		Now all that remains is to compile your LESS. For instructions on how to compile your LESS files
		Please refer to the compiler documentation.
	</p>

</section>

<section id="api">

	<h2>Plugin API</h2>

	<p>Yii-Bootstrap comes with an API for registering and binding Bootstrap JavaScript plugins without a single line of JavaScript.</p>

	<p>Here's an example of how to use the API to register the Typeahead plugin:</p>

	<div class="well">
		<input class="typeahead span3" type="text" placeholder="Start typing ..." />
	</div>

	<?php Yii::app()->bootstrap->registerTypeahead('.typeahead', array(
		'source'=>array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'),
		'items'=>4,
		'matcher'=>"js:function(item) {
			return ~item.toLowerCase().indexOf(this.query.toLowerCase());
		}",
	)); ?>
	
<?php echo $parser->safeTransform("~~~
[html]
<input class=\"typeahead span3\" type=\"text\" placeholder=\"Start typing ...\" />
~~~
~~~
[php]
Yii::app()->bootstrap->registerTypeahead('.typeahead', array(
	'source'=>array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'),
	'items'=>4,
	'matcher'=>\"js:function(item) {
		return ~item.toLowerCase().indexOf(this.query.toLowerCase());
	}\",
));
~~~"); ?>

	<p>
		That's it! The Typeahead is now bound to all elements with the class <strong>typehead</strong>.
		There are similar methods for each plugin that can be used to register them from anywhere in your application.
		All these methods take two arguments, the CSS selector and options for the jQuery plugin.
	</p>

</section>

<div class="subnav subnav-fixed">

	<?php $this->widget('BootMenu', array(
		'type'=>'pills',
		'scrollspy'=>array('spy'=>'.subnav', 'offset'=>50),
		'items'=>array(
			array('label'=>'Setup', 'url'=>'#setup'),
			array('label'=>'Using LESS', 'url'=>'#less'),
			array('label'=>'Plugin API', 'url'=>'#api')
		),
	)); ?>

</div>