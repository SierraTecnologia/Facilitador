<?php

namespace Facilitador\Models;

use App\Models\Model;
use SierraTecnologia\Cashier\Billable;
// use Support\Traits\Models\BusinessTrait;

class UserMeta extends Model
{
    use Billable; //, BusinessTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone',
        'is_active',
        'activation_token',
        'marketing',
        'sitecpayment_id',
        'card_brand',
        'card_last_four',
        'terms_and_cond',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class));
    }

    /**
     * Get all of the subscriptions for the business.
     */
    public function subscriptions()
    {
        return $this->hasMany('App\Models\Negocios\Subscription');
    }
}
