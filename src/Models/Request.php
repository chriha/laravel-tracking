<?php

namespace Chriha\LaravelTracking\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    /** @var string */
    protected $table = 'tracking_requests';

    /** @var array */
    protected $guarded = [];

    /** @var string|null */
    const UPDATED_AT = null;

    /** @var array */
    protected $casts = [];


}
