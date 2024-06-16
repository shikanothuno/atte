<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "date",
        "start_time",
        "end_time",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 指定したユーザーの指定した日時の休憩開始時間を取得
    public function getStartBreakTimes($user_id,$date)
    {
        return $start_break_times = BreakTime::select("start_time")->where("user_id","=",$user_id)
        ->where("date","=",$date)->get()->all();
    }

    // 指定したユーザーの指定した日時の休憩終了時間を取得
    public function getEndBreakTimes($user_id,$date)
    {
        return $end_break_times = BreakTime::select("end_time")->where("user_id","=",$user_id)
        ->where("date","=",$date)->get()->all();
    }

    // 指定したユーザーの指定した日時の休憩時間を計算
    public function calcBreakTime($user_id,$date)
    {
        $start_break_times = $this->getStartBreakTimes($user_id,$date);

        $end_break_times = $this->getEndBreakTimes($user_id,$date);

        $totalBreakTime = 0;

        foreach(array_map(null,$end_break_times,$start_break_times) as [$end,$start]){
            // end_timeがnull→休憩終了がされていないデータなので計算に反映しない
            if($end->end_time != null){
                $totalBreakTime += (strtotime(date("H:i:s",strtotime($end->end_time))) - strtotime(date("H:i:s",strtotime($start->start_time))));
            }
        }

        return $totalBreakTime;

    }
}
