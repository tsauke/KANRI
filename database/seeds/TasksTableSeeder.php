<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     foreach (range(1, 3) as $num) {
         DB::table('tasks')->insert([
             'folder_id' => 1,
             'title' => "サンプルタスク{$num}",
             'due_date' => Carbon::now()->addDay($num),
             'status' => $num,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now(),
         ]);
     }   

    }
}
