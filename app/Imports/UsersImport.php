<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = ! $row instanceof Collection ? collect($row) : $row;

        $user = User::create([
            'name'  => $data->get('full_name'),
            'email' => $data->get('email'),
            'password'  => bcrypt('wan123123')
        ]);
    }
}
