[![Latest Stable Version](https://poser.pugx.org/trexology/laravel-order/v/stable)](https://packagist.org/packages/trexology/laravel-order) [![Total Downloads](https://poser.pugx.org/trexology/laravel-order/downloads)](https://packagist.org/packages/trexology/laravel-order) [![Latest Unstable Version](https://poser.pugx.org/trexology/laravel-order/v/unstable)](https://packagist.org/packages/trexology/laravel-order) [![License](https://poser.pugx.org/trexology/laravel-order/license)](https://packagist.org/packages/trexology/laravel-order)

# laravel-order
Basic Ordering Package for Laravel 5

# Installation

    composer require "trexology/laravel-order:1.*"

After installation，go to `config/app.php` under `providers` section to add the following:

    Trexology\LaravelOrder\LaravelOrderServiceProvider::class

and under "aliases" add:

    'Order'     => Trexology\LaravelOrder\Facades\Order::class


publish the migration and config files with the command:

    php artisan vendor:publish

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
        'complete' => "complete"

    ];
```

# Usage

## Create a new order

```php
    $data = [
        //Custom fields
        'cust_first_name' => $cust->first_name,
        'cust_last_name' => $cust->last_name
    ];

    Order Order::order(int $user_id, array $data);
```

## Add item to Order
```php
    $data = [
      'description' => "My item descriptions",
      'currency' => "SGD"
    ];
    Order Order::addItem(Order $order, Model $object, double $price, int $quantity, array $data, double $vat);
```

## Batch Adding item to Order
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
    Order Order::batchAddItems(Order $order, array $order_Items);
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
