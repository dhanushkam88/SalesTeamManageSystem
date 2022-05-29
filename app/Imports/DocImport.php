<?php

namespace App\Imports;

use App\Models\User;
use Excel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email'=> $row['email'],
            'password'=> Hash::make($row['password']),
            'contact'=> $row['contact'],
            'joined_date' => $row['joined_date'],
            'current_route' => $row['current_route'],
            'address' => $row['address'],
            'city' => $row['city'],
            'province' => $row['province'],
            'zip' => $row['zip'],
            'comment' => $row['comment'],
        ]);
    }
}
