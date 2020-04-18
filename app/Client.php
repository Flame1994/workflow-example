<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @author Ruan Haarhoff <ruan@aptic.com>
 * @since 20200418 Initial creation.
 */
class Client extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'joined',
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
