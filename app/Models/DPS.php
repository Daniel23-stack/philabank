<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DPS extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dps';

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query) {
        $query->where('status', 1);
    }

    public function currency() {
        return $this->belongsTo('App\Models\Currency', 'currency_id')->withDefault();
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function plan() {
        return $this->belongsTo('App\Models\DPSPlan', 'dps_plan_id')->withDefault();
    }

    public function getNextInstallmentDateAttribute($value) {
        $date_format = get_date_format();
        return \Carbon\Carbon::parse($value)->format("$date_format");
    }

    public function dueInstallmentDate() {
        $installmentDate = $this->getRawOriginal('next_installment_date');
        if (Carbon::now()->diffInDays($installmentDate) > 0 && $this->status == 1) {
            return Carbon::parse($installmentDate)->diffForHumans();
        }
    }
}