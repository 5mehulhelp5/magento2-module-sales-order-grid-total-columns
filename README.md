# AimaneCouissi_SalesOrderGridTotalColumns

[![Latest Stable Version](http://poser.pugx.org/aimanecouissi/module-sales-order-grid-total-columns/v)](https://packagist.org/packages/aimanecouissi/module-sales-order-grid-total-columns) [![Total Downloads](http://poser.pugx.org/aimanecouissi/module-sales-order-grid-total-columns/downloads)](https://packagist.org/packages/aimanecouissi/module-sales-order-grid-total-columns) [![Latest Unstable Version](http://poser.pugx.org/aimanecouissi/module-sales-order-grid-total-columns/v/unstable)](https://packagist.org/packages/aimanecouissi/module-sales-order-grid-total-columns) [![License](http://poser.pugx.org/aimanecouissi/module-sales-order-grid-total-columns/license)](https://packagist.org/packages/aimanecouissi/module-sales-order-grid-total-columns) [![PHP Version Require](http://poser.pugx.org/aimanecouissi/module-sales-order-grid-total-columns/require/php)](https://packagist.org/packages/aimanecouissi/module-sales-order-grid-total-columns)

Adds additional total columns to the Admin **Sales → Orders** grid (base and purchased currency).

## Installation
```bash
composer require aimanecouissi/module-sales-order-grid-total-columns
bin/magento module:enable AimaneCouissi_SalesOrderGridTotalColumns
bin/magento setup:upgrade
bin/magento cache:flush
```

## Usage
Open **Admin → Sales → Orders**. The module adds total columns—**Paid, Due, Invoiced, Refunded, Canceled**—for both **base** and **purchased** currency. They’re hidden by default; enable them from **Columns**.

## Uninstall
```bash
bin/magento module:disable AimaneCouissi_SalesOrderGridTotalColumns
composer remove aimanecouissi/module-sales-order-grid-total-columns
bin/magento setup:upgrade
bin/magento cache:flush
```

## License
[MIT](LICENSE)
