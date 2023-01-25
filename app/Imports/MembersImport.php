<?php

namespace App\Imports;

use App\Models\Members;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class MembersImport implements ToCollection
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {

    //     return new Members([
    //         'firstname' => $row[0],
    //         'lastname' => $row[1],
    //         //'DOB' => $row[2],
    //         'email' => $row[3],
    //         'address' => $row[4],
    //         'status' => $row[5],
    //         'gender' => $row[6],
    //         'phone' => $row[7],
    //         'emergency_contact' => $row[8],
    //         'health_issues' => $row[9],
    //         'source' => $row[10],  
    //         'created_by' => $row[11],
    //         'updated_by' => $row[12],
    //         'cin' => $row[13]
    //     ]);
    // }

    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
             '*.0' => 'required',
         ])->validate();

        foreach ($rows as $row) {
            Members::create([
                    'firstname' => $row[0],
                    'lastname' => $row[1],
                    //'DOB' => $row[2],
                    'email' => $row[3],
                    'address' => $row[4],
                    'status' => $row[5],
                    'gender' => $row[6],
                    'phone' => $row[7],
                    'emergency_contact' => $row[8],
                    'health_issues' => $row[9],
                    'source' => $row[10],  
                    'created_by' => $row[11],
                    'updated_by' => $row[12],
                    'cin' => $row[13]
            ]);
        }
    }
}
