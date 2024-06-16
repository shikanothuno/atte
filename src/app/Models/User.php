<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function attendences()
    {
        return $this->hasMany(Attendance::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }
    // 勤務開始を記録
    public function startAttendance($user_id)
    {
        $attendance = new Attendance();
        $attendance->user_id = $user_id;
        $attendance->date = date("Y-m-d 00:00:00");
        $attendance->start_time = date("Y-m-d H:i:s");
        $attendance->save();

        $user = User::find($user_id);
        $user->working = true;
        $user->save();
    }

    // 勤務終了を記録
    public function endAttendance($user_id)
    {
        $attendance_collection = Attendance::where("user_id","=",$user_id)->where("date","<=",date("Y-m-d H:i:s"))->where("date",">=",date("Y-m-d"))->get();

        $attendance = Attendance::find($attendance_collection[0]->id);
        $attendance->end_time = date("Y-m-d H:i:s");
        $attendance->save();

        $user = User::find($user_id);
        $user->working = false;
        $user->save();
    }

    // 休憩開始を記録
    public function startBreakTime($user_id)
    {
        $break_time = new BreakTime();
        $break_time->user_id = $user_id;
        $break_time->date = date("Y-m-d 00:00:00");
        $break_time->start_time = date("Y-m-d H:i:s");
        $break_time->save();

        $user = User::find($user_id);
        $user->breaking = true;
        $user->save();
    }

    // 休憩終了を記録
    public function endBreakTime($user_id)
    {
        $break_times_collections = BreakTime::where("user_id","=",$user_id)->where("date","<=",date("Y-m-d H:i:s"))->where("date",">=",date("Y-m-d"))->get();

        foreach($break_times_collections as $break_times_collection){
            if($break_times_collection->end_time == null){
                $break_time = BreakTime::find($break_times_collection->id);
                $break_time->end_time = date("Y-m-d H:i:s");
                $break_time->save();
            }
        }

        $user = User::find($user_id);
        $user->breaking = false;
        $user->save();
    }
}
