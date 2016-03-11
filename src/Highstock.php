<?php
/**
 * @link https://github.com/LAV45/yii2-db-migrate
 * @copyright Copyright (c) 2015 LAV45!
 * @author Alexey Loban <lav451@gmail.com>
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace lav45\highcharts;

/**
 * @see Highcharts
 */
class Highstock extends Highcharts
{
    protected $constructor = 'StockChart';

    protected function registerAssets()
    {
        HighstockAsset::register($this->getView());
    }
}
