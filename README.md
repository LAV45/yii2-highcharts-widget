Yii2 Highcharts Widget
======================

[![Latest Stable Version](https://poser.pugx.org/lav45/yii2-highcharts-widget/v/stable.png)](https://packagist.org/packages/lav45/yii2-highcharts-widget)
[![Total Downloads](https://poser.pugx.org/lav45/yii2-highcharts-widget/downloads.png)](https://packagist.org/packages/lav45/yii2-highcharts-widget)
[![License](https://poser.pugx.org/lav45/yii2-highcharts-widget/license.png)](https://packagist.org/packages/lav45/yii2-highcharts-widget)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lav45/yii2-highcharts/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lav45/yii2-highcharts/?branch=master)

Easily add [Highcharts, Highstock and Highmaps](http://www.highcharts.com/) graphs to your Yii2 application.

![Screen Shot](http://www.yiiframework.com/extension/yii2-highcharts-widget/files/screenshot.png)


About
-----

### Highcharts ###
> Create interactive charts easily for your web projects. Used by tens of thousands of developers and 59 out of the world's 100 largest companies, Highcharts is the simplest yet most flexible charting API on the market.

### Highstock ###
> Highstock lets you create stock or general timeline charts in pure JavaScript. Including sophisticated navigation options like a small navigator series, preset date ranges, date picker, scrolling and panning.

### Highmaps ###
> Build interactive maps to display sales, election results or any other information linked to geography. Perfect for standalone use or in dashboards in combination with Highcharts!


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require "lav45/yii2-highcharts-widget:1.0.*"
```

or add

```
"lav45/yii2-highcharts-widget": "1.0.*"
```

to the require section of your `composer.json` file.


Usage
-----

### Preferred Method (using PHP arrays) ###

To use this widget, insert the following code into a view file:
```php
use lav45\highcharts\Highcharts;

echo Highcharts::widget([
   'clientOptions' => [
      'title' => ['text' => 'Fruit Consumption'],
      'xAxis' => [
         'categories' => ['Apples', 'Bananas', 'Oranges']
      ],
      'yAxis' => [
         'title' => ['text' => 'Fruit eaten']
      ],
      'series' => [
         ['name' => 'Jane', 'data' => [1, 0, 4]],
         ['name' => 'John', 'data' => [5, 7, 3]]
      ]
   ]
]);
```

By configuring the `options` property, you can specify the options that need to be passed to the Highcharts JavaScript object. Please refer to the demo gallery and documentation on the [Highcharts website](http://www.highcharts.com/) for possible options.

See [/doc/examples](https://github.com/lav45/yii2-highcharts/tree/master/doc/examples) for more usage examples.

### Demo ###

[Highcharts Demo](http://www.highcharts.com/demo), [Highstock Demo](http://www.highcharts.com/stock/demo) and [Highmaps Demo](http://www.highcharts.com/maps/demo) pages.


Tips
----

* If you need to use JavaScript in any of your configuration options, use Yii's [[JsExpression]] object. For instance:

  ```php
  ...
  'tooltip' => [
     'formatter' => new JsExpression('function(){ return this.series.name; }')
  ],
  ...
  ```
  Note, this is currently only possible when using a PHP associative array ([Preferred Method](#preferred-method-using-php-arrays)) for configuration.
* Highcharts by default displays a small credits label in the lower right corner of the chart. This can be removed using the following top-level option.

  ```php
  ...
  'credits' => ['enabled' => false],
  ...
  ```

* You can access the JavaScript chart object from another script like this:

  ```javascript
  var chart = $('#my-chart-id').highcharts();
  ```
  where `my-chart-id` is set via the top-level `id` configuration option. Just make sure you
  register your script after the widget declaration so that it has a chance to initialize.
* The top-level `'callback'` option allows you to initialize the chart after an AJAX request or other preprocessing.
  See included [Highstock Widget Examples](https://github.com/lav45/yii2-highcharts/tree/master/doc/examples/highstock.md) for usage.
