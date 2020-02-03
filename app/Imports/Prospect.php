<?php

namespace App\Imports;

use App\Prospect as ProspectModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Prospect implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        if(ProspectModel::find($row['matric']) == null){
            return new ProspectModel([
                'matric'     => $row['matric'],
                'first_name'    => $row['first_name'],
                'last_name' => $row['last_name'],
                'other_name' => $row['other_name'],
                'email' => $row['email'],
                'level' => $row['level'],
             ]);
        }
       
    }
}