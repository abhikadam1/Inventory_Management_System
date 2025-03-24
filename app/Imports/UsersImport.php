<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Nette\Utils\Random;
use Str;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // return new User([
        //     'name' => $row[0].Str::random(5),
        //     'email' => $row[1].Str::random(5).'@gmail.com',
        //     // 'password' => bcrypt($row[2]), // Hash::make($row[2])
        //     'password' => Hash::make($row[2].Str::random(8)),
        // ]);

        // dd($row);
        
        return new Post(attributes: [
            'title' => $row['title'],
            'content' => $row['content'],
            // 'title' => $row[0],
            // 'content' => $row[1],
        ]);
    }
}
