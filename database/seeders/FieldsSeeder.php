<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field = new Field;
        $field->title = 'DOB';
        $field->type = 'date';
        $field->user_id = 1;
        $field->save();

        $field = new Field;
        $field->title = 'Address';
        $field->type = 'string';
        $field->user_id = 1;
        $field->save();

        $field = new Field;
        $field->title = 'Country Code';
        $field->type = 'number';
        $field->user_id = 1;
        $field->save();

        $field = new Field;
        $field->title = 'Accepted Terms';
        $field->type = 'boolean';
        $field->user_id = 1;
        $field->save();
    }
}
