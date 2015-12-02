# laravel-order

# Installation

    composer require "trexology/laravel-order:1.0.*"

After installation，go to `config/app.php` under `providers` section to add the following:

    'Trexology\LaravelOrder\LaravelOrderServiceProvider'

and under "aliases" add:

    'Order'   => 'Trexology\LaravelOrder\Facades\Order',


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
    Order::addItem($order->id, $veh, 90, 2, null, 0.07);
```

## Get an order
```php
    Order Order::getOrder($order_id);
```

## Get user's orders
```php
    Collection Order::getUserOrders($user_id);
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
    float Order::total($order_id);
```

## Calculate an Order total item count
```php
    int Order::count($order_id);
```