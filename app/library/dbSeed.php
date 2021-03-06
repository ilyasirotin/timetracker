<?php
declare(strict_types=1);

define('USERS_COUNT', 10);
define('TIMESTAMPS_COUNT', 200);

function seedUsers()
{
    for ($i = 0; $i < USERS_COUNT; $i++) {
        $users = new \App\Models\Users();
        $users->assign([
            'fname' => 'FirstName_' . $i,
            'lname' => 'LastName_' . $i,
            'username' => 'Username_' . $i,
            'email' => "test_{$i}" . "@localhost.com",
            'is_admin' => false,
            'password' => 'password_' . $i,
        ]);

        try {
            $users->save();
        } catch (\Phalcon\Exception $e) {
            print_die($e->getMessage());
        }
    }
}

function seedTimeTable()
{
    for ($i = 0; $i < TIMESTAMPS_COUNT; $i++) {
        $timeTable = new \App\Models\TimeTable();
        $start_time = [
            random_int(7, 9),
            random_int(0, 59),
            0,
            random_int(1, 2),
            random_int(1, 31),
            random_int(2020, 2020),
        ];

        $end_time = [
            random_int($start_time[0], 20),
            random_int($start_time[1], 59),
            0,
            $start_time[3],
            $start_time[4],
            $start_time[5],
        ];

        $timeTable->assign([
            'user_id' => random_int(1, USERS_COUNT),
            'start' => mktime(...$start_time),
            'end' => mktime(...$end_time),
            'created_at' => mktime(0, 0, 0, $start_time[3], $start_time[4], $start_time[5]),
        ]);

        try {
            $timeTable->save();
        } catch (\Phalcon\Exception $e) {
            print_die($e->getMessage());
        }
    }
}
