<?php

use App\Eloquent\User;
use App\Eloquent\UserStudents;
use App\Generators\DefaultAvatarGenerator;
use Illuminate\Database\Seeder;

/**
 * This <konseling-1> project created by :
 * Name         : syafiq
 * Date / Time  : 25 November 2017, 11:30 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
class UserStudentsSeeder extends Seeder
{
    use DefaultAvatarGenerator;

    /**
     *
     */
    public function run()
    {
        $data = [
            ['credential' => '10000', 'name' => 'Student-1', 'gender' => 'male', 'role' => 'student', 'avatar' => $this->generate('male'), 'password' => bcrypt('12345678'), 'student' => ['school' => 'UM', 'grade' => '10', 'active' => 0]],
            ['credential' => '10001', 'name' => 'Student-2', 'gender' => 'female', 'role' => 'student', 'avatar' => $this->generate('female'), 'password' => bcrypt('12345678'), 'student' => ['school' => 'UM', 'grade' => '10', 'active' => 1]],
            ['credential' => '10002', 'name' => 'Student-3', 'gender' => 'male', 'role' => 'student', 'avatar' => $this->generate('male'), 'password' => bcrypt('12345678'), 'student' => ['school' => 'UM', 'grade' => '10', 'active' => 0]],
        ];

        /** @var \Illuminate\Database\Query\Builder $model */
        $model = new User();
        foreach ($data as $category)
        {
            if (!$model->where('credential', '=', $category['credential'])->first())
            {
                /** @var UserStudents $student */
                $student = new UserStudents();
                $student->setRawAttributes($category['student']);
                unset($category['student']);
                $model = new User($category);
                $model->save();
                $model->student()->save($student);
            }
        }
    }
}

?>
