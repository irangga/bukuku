<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    /**
     * Eager loading default untuk mengatasi masalah N+1
     * sesuai dengan aturan proyek (Strict N+1 Prevention).
     *
     * @var array
     */
    protected $with = ['category'];

    /**
     * Relasi dengan model Category (Kategori).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi dengan model OrderItem (Item Pesanan).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
