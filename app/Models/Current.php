<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Current extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'current';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'invest_amount', 'invest_start_time','invest_stop_time','profit','state'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function get_profit($current_id)
    {
        $current=Current::findOrfail($current_id);
        $startdate=strtotime(Carbon::parse($current->invest_start_time));
        $enddate=strtotime(Carbon::now());
        $invest_days=round(($enddate-$startdate)/3600/24);
        $website_info=Website_info::findOrFail(1);
        $year_profit=$website_info->year_profit;
        $profit=$current->invest_amount*$year_profit/100*$invest_days/365;
        return round($profit,2);
    }
}
