<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id',
    	'title',
    	'contents',
    	'reporting_time',
    ];

    protected $dates = [
    	'reporting_time',
    	'created_at',
    	'deleted_at',
    	'updated_at',
    ];

    public function getSearchResult($input)
    {
    	$result = $this->searchMonth('reporting_time', $input['search_month'])->get();

    	return $result;
    }

    public function scopeSearchMonth($query, $field, $date)
    {
    	if(!$field || !$date) {
    		return $query;
    	}
    	switch($field) {
    		case 'reporting_time':
    			$query->whereYear($field, '=', date('Y', strtotime($date)))
    				  ->whereMonth($field, '=', date('m', strtotime($date)));
    			return $query;
    			break;
    		default:
    			return $query;
    	}
    }

    public function updateDailyReport($input, $daily_report)
    {
    	$daily_report->where('id', $daily_report['id'])->update([
    		'reporting_time' 	=> $input['reporting_time'],
    		'title' 			=> $input['title'],
    		'contents' 			=> $input['contents']
    	]);
    }
}
