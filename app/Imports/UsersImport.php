<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Nette\Utils\Random;
use Illuminate\Support\Str;

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
        return new User([
            'name' => $row['name'].Str::random(5),
            'email' => $row['email'].Str::random(5),
            // 'name' => $row[0].Str::random(5),
            // 'email' => $row[1].Str::random(5).'@gmail.com',
            // 'password' => bcrypt($row[2]), // Hash::make($row[2])
            'password' => Hash::make(Str::random(8)),
        ]);

        dd($row);
        
        return new Post(attributes: [
            'name' => $row['name'],
            'email' => $row['email'],
            // 'title' => $row[0],
            // 'content' => $row[1],
        ]);
    }
}
