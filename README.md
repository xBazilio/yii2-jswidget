JSWidget for Yii2
=================

#What is this?

A simple widget to wrap your javascript code and output it in specified position of the rendered page.

#Installation

todo

#Usage

```html
<?php
use xBazilio\widgets\JSWidget;
?>

<?php JSWidget::begin(); ?>
<script type="text/javascript">
console.log('test');
</script>
<?php JSWidget::end(); ?>

```
