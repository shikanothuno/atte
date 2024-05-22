<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=100;$i++){
            for($j=0;$j<10;$j++){
                Attendance::create([
                    "user_id" => $i,
                    "date" => date("Y-m-d",strtotime("2024-5-1 +" . strval($j) . "day")),
                    "start_time" => date("H:i:s",strtotime("08:30:00")),
                    "end_time"=> date("H:i:s",strtotime("17:30")),
                ]);
            }
        }
    }
}
