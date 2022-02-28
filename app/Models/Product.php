<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // отображение категории
   /* public function getCategory()
    {
        return Category::find($this->category_id);
    }*/

    // для отображения хитов продаж и рекомендуемых
    protected $fillable = ['name', 'code', 'price', 'category_id', 'description', 'images', 'new', 'hit', 'recommend', 'count', ];

    // прописываем связи
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // рассчитывать стоимость в корзине
    public function getPriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    // вывод продукта в карточке товара по коду
    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    // галочки у хита, нового товара и рекомендуемого
    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    // доступен если количество больше 0
    public function isAvailable()
    {
        return $this->count > 0;
    }

    // хит продаж
    public function isHit()
    {
        return $this->hit === 1;
    }

    // новый товар
    public function isNew()
    {
        return $this->new === 1;
    }

    // рекомендовано
    public function isRecommend()
    {
        return $this->recommend === 1;
    }
}
