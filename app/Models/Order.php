<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    // вывод имени юзера
   /* public function user()
    {
        return $this->$this->belongsTo(User::class);
    }
*/
    // вывод полной стоимости заказа
    public function getFullPrice()
    {
      $sum = 0;
      foreach ($this->products as $product) {
          $sum += $product->getPriceForCount();
      }
      return $sum;
    }

    // сохранение заказа в бд
    public function saveOrder($name, $phone)
    {
        if ($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }
}
