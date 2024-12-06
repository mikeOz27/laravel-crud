<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = [
            [
                'title' => 'Note 1',
                'content' => 'Content of note 1',
                'marked' => false,
            ],
            [
                'title' => 'Note 2',
                'content' => 'Content of note 2',
                'marked' => false,
            ],
            [
                'title' => 'Note 3',
                'content' => 'Content of note 3',
                'marked' => false,
            ],
            [
                'title' => 'Note 4',
                'content' => 'Content of note 4',
                'marked' => false,
            ],
            [
                'title' => 'Note 5',
                'content' => 'Content of note 5',
                'marked' => false,
            ],
        ];

        foreach ($notes as $note) {
            \App\Models\Note::create($note);
        }
    }
}
