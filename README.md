# mconsole-commerce

Commerce module for Mconsole

## Installation

```
$ composer require milax/mconsole-commerce
$ php artisan vendor:publish
```

## Repositories

- Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository
- Milax\Mconsole\Commerce\Contracts\Repositories\DeliveryTypesRepository
- Milax\Mconsole\Commerce\Contracts\Repositories\DiscountsRepository
- Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository

## Adding product custom tables and properties

Open and edit `config/commerce.products.php`, remove example tables and lists.

## Module settings

* `commerce_category_has_cover` - Enable or disable categories cover
* `commerce_product_has_cover` - Enable or disable products cover
* `commerce_product_has_gallery` - Enable or disable products gallery
* `commerce_shop_enabled` - Enable or disable shop
* `commerce_increase_price` - Set increased price in percents
* `commerce_decrease_price` - Set decreased price in percents
* `commerce_guests_enabled` - Allow unauthorized users to use shop
* `commerce_show_empty_categories` - Show empty categories
* `commerce_commerce_message` - Set shop message of the day