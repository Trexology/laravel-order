[![Latest Stable Version](https://poser.pugx.org/trexology/laravel-order/v/stable)](https://packagist.org/packages/trexology/laravel-order) [![Total Downloads](https://poser.pugx.org/trexology/laravel-order/downloads)](https://packagist.org/packages/trexology/laravel-order) [![Latest Unstable Version](https://poser.pugx.org/trexology/laravel-order/v/unstable)](https://packagist.org/packages/trexology/laravel-order) [![License](https://poser.pugx.org/trexology/laravel-order/license)](https://packagist.org/packages/trexology/laravel-order)

# laravel-order
Basic Ordering Package for Laravel 5+

# Installation

    composer require trexology/laravel-order:2.*

# Upgrade Guide
• This package uses [VentureCraft/revisionable](https://github.com/VentureCraft/revisionable/) to track order changes

• Remove the old migration file '2015_12_02_150448_create_orderLogs_table.php'

• Column `line_item_id` in `Orderitems` table has been changed from integer to string for greater flexibility (version 1 user have to change the column type manually)

After installation，go to `config/app.php` under `providers` section to add the following:

    Trexology\LaravelOrder\LaravelOrderServiceProvider::class

and under "aliases" add:

    'Order'     => Trexology\LaravelOrder\Facades\OrderFacade::class


publish the migration and config files with the commands:

    php artisan vendor:publish
    php artisan migrate --path=vendor/venturecraft/revisionable/src/migrations

Edit additional settings at `config/order.php`

```php
    return [

        /*
        |--------------------------------------------------------------------------
        | Order Status Name
        |--------------------------------------------------------------------------
        | Customize the status name recorded
        |
        */

        'init' => "init",
        'complete' => "complete",

        'ignoredFields' => []

    ];
```

# Usage

## Create a new order
`Order Order::order(int $user_id, array $data = null, bool $draft = FALSE)`
```php
    $data = [
        //Custom fields
        'cust_first_name' => $cust->first_name,
        'cust_last_name' => $cust->last_name
    ];

    $order = Order::order($cust->id, $data);
```

## Add item to Order
`Order Order::addItem(Order $order, Model $object, double $price, int $quantity, array $data = null, double $vat = 0);`
```php
    $data = [
      'description' => "My item descriptions",
      'currency' => "SGD"
    ];
    $order = Order::addItem($order, $object, 25.5, 2, $data, 7);
```

## Add item to Order (Non Eloquent Style)
`Order Order::addItemManual(Order $order, string $object_id, string $object_type, double $price, int $quantity, array $data = null, double $vat = 0)`
```php
    $data = [
      'description' => "My item descriptions",
      'currency' => "SGD"
    ];
    $order = Order::addItem($order, 22, "App\Model\Object", 25.5, 2, $data, 7);
```

## Batch Adding item to Order
`Order Order::batchAddItems(Order $order, array $order_Items)`
```php
    $order_Items = [
        [
            "description" => "Some Description",
            "currency" => "USD",
            "line_item_id" => 1,
            "line_item_type" => "App\\Models\\Package",
            "price" => 1802,
            "quantity" => 1,
            "vat" => 0,
        ],
        [
            "description" => "Some Description",
            "currency" => "USD",
            "line_item_id" => 1,
            "line_item_type" => "App\\Models\\Package",
            "price" => 1802,
            "quantity" => 1,
            "vat" => 0,
        ]
    ];
    $order = Order::batchAddItems($order, $order_Items);
```

## Get an order
```php
    Order Order::getOrder(int $order_id);
```

## Get user's orders
```php
    Collection Order::getUserOrders(int $user_id);
```

## Update Order Status
```php
    boolean Order::updateStatus(int $order_id, string $status);
```

## Delete an Order
```php
    boolean Order::deleteOrder(int $order_id);
```

## Update Order quantity
```php
    OrderItem Order::updateQty(int $item_id, int qty);
```

## Calculate an Order total amount
```php
    float Order::total(Order $order);
```

## Calculate an Order total item count
```php
    int Order::count(Order $order);
```
