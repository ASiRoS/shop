<?php

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    protected $subjects = [
        'Русский язык',
        'Математика',
        'Обществознание',
        'География',
        'Литература',
        'История',
        'Химия',
        'Английский язык',
        'Физика',
        'Биология',
        'Информатика',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->subjects as $name) {
            $subject = new Subject();
            $subject->name = $name;
            $subject->save();
        }
    }
}
