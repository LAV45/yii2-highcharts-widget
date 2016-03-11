<?php
/**
 * @link https://github.com/LAV45/yii2-db-migrate
 * @copyright Copyright (c) 2015 LAV45!
 * @author Alexey Loban <lav451@gmail.com>
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace lav45\highcharts;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Highcharts encapsulates the {@link http://www.highcharts.com/ Highcharts}
 * charting library's Chart object.
 *
 * To use this widget, you can insert the following code in a view:
 * ```php
 * echo \lav45\highcharts\Highcharts::widget([
 *     'clientOptions' => [
 *         'title' => ['text' => 'Fruit Consumption'],
 *         'xAxis' => [
 *             'categories' => ['Apples', 'Bananas', 'Oranges']
 *         ],
 *         'yAxis' => [
 *             'title' => ['text' => 'Fruit eaten']
 *         ],
 *         'series' => [
 *             ['name' => 'Jane', 'data' => [1, 0, 4]],
 *             ['name' => 'John', 'data' => [5, 7, 3]]
 *         ]
 *     ]
 * ]);
 * ```
 *
 * By configuring the {@link $options} property, you may specify the options
 * that need to be passed to the Highcharts JavaScript object. Please refer to
 * the demo gallery and documentation on the {@link https://www.highcharts.com/
 * Highcharts website} for possible options.
 *
 * Note: You do not need to specify the <code>chart->renderTo</code> option as
 * is shown in many of the examples on the Highcharts website. This value is
 * automatically populated with the id of the widget's container element. If you
 * wish to use a different container, feel free to specify a custom value.
 */
class Highcharts extends Widget
{
    protected $constructor = 'Chart';
    public $options = [];
    public $clientOptions = [];
    public $setupOptions = [];
    public $callback;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    public function run()
    {
        $this->clientOptions['chart']['renderTo'] = $this->options['id'];

        $this->registerAssets();
        $this->registerJsPlugin();

        return Html::tag('div', '', $this->options);
    }

    protected function registerAssets()
    {
        HighchartsAsset::register($this->getView());
    }

    protected function registerJsPlugin()
    {
        $setupOptions = Json::encode($this->setupOptions);
        $js = "Highcharts.setOptions({$setupOptions});";

        $jsOptions = Json::encode($this->clientOptions);
        $js .= "var highChart_{$this->options['id']} = new Highcharts.{$this->constructor}({$jsOptions});";

        if (is_string($this->callback)) {
            $js = "function {$this->callback}(data) {{$js}}";
        }

        $this->getView()->registerJs($js);
    }
}
