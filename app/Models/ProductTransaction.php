<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTransaction extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'booking_trx_id',
        'city',
        'post_code',
        'address',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'is_paid',
        'shirt_id',
        'shirt_size',
        'promo_code_id',
        'proof',
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = "OMO_TRX";
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
            // mengecek apakah dari nomor randomnya sudah ada atau belum karena tidak bole sama 
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function shirt(): BelongsTo
    {
        return $this->belongsTo(Shirt::class, 'shirt_id');
    }

    public function shirtSize(): BelongsTo
    {
        return $this->belongsTo(ShirtSize::class, 'shirt_size');
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
}
