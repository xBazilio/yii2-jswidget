<?php
/**
 * @link https://github.com/xBazilio
 * @license http://bazilio.mit-license.org/
 */
namespace xBazilio\widgets;

use Yii;
use yii\base\Widget;
use yii\web\View;


/**
 * Outputs javascript code using yii\web\View::registerJs(). It is supposed to use in your views
 * to wrap javascript code and output it in $position of rendered page. So you can use
 * javascript code in views and do not worry about dependencies which have to be loaded before
 * the code.
 *
 * For example:
 *
 * <?php JSWidget::begin(); ?>
 * <script type="text/javascript">
 * console.log('test');
 * </script>
 * <?php JSWidget::end(); ?>
 *
 * If there are two widgets with the same id, the later will take precedence and overwrite
 * the former.
 * For example:
 *
 * <?php JSWidget::begin(['id' => 'test']); ?>
 * <script type="text/javascript">
 * console.log('test');
 * </script>
 * <?php JSWidget::end(); ?>
 *
 * <?php JSWidget::begin(['id' => 'test']); ?>
 * <script type="text/javascript">
 * console.log('test overwritten');
 * </script>
 * <?php JSWidget::end(); ?>
 *
 * Only 'test overwritten' will be logged.
 *
 * @see yii\web\View::registerJs()
 * @author Vasiliy Rumyantsev <x.bazilio@gmail.com>
 */
class JSWidget extends Widget
{
    /**
     * @var string
     * ID that uniquely identifies this piece of JavaScript code.
     */
    public $id;

    /**
     * @var integer
     * The position of the JavaScript code.
     */
    public $position = View::POS_END;

    public static function begin($config = [])
    {
        ob_start();

        return parent::begin($config);
    }

    public function run()
    {
        $output = ob_get_clean();

        if (Yii::$app->request->getIsAjax()) {
            echo $output;
        }
        else {
            $output = preg_replace('/<script[^>]*>/i', '', $output);
            $output = str_ireplace('</script>', '', $output);

            $id = is_null($this->id) ? uniqid() : $this->id;

            Yii::$app->view->registerJs($output, $this->position, $id);
        }
    }
}
