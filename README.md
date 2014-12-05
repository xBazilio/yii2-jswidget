JSWidget for Yii2
=================

#What is this?

A simple widget to wrap your javascript code and output it in specified position of the rendered page.

#Installation

    composer require "xbazilio/yii2-jswidget":"1.0.0"

#Usage

By default it outputs code in the `yii\web\View::POS_END`. Pass `position` parameter if you want to change this behaviour.

```html
<?php
use xBazilio\JSWidget\JSWidget;
?>

<?php JSWidget::begin(); ?>
<script type="text/javascript">
console.log('test');
</script>
<?php JSWidget::end(); ?>

```

If there are two widgets with the same id, the later will take precedence and overwrite the former

<?php
use xBazilio\JSWidget\JSWidget;
?>

<?php JSWidget::begin(['id' => 'test']); ?>
<script type="text/javascript">
console.log('test');
</script>
<?php JSWidget::end(); ?>

<?php JSWidget::begin(['id' => 'test']); ?>
<script type="text/javascript">
console.log('test overwritten');
</script>
<?php JSWidget::end(); ?>

```

Only 'test overwritten' will be logged.
