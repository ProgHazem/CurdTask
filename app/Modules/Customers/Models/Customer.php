<?php

namespace App\Modules\Customers\Models;

use App\Modules\Services\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use SoftDeletes;


    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'first_name',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $dates = ['deleted_at'];

    /**
     * Interact with the user's Created At.
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::make($value)->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Interact with the user's Update At.
     *
     * @return Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::make($value)->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Interact with the user's deleted At.
     *
     * @return Attribute
     */
    protected function deletedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::make($value)->format('Y-m-d H:i:s') : null,
        );
    }

    /**
     * The services that belong to the customer.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'customer_id');
    }
}
