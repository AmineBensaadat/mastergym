<?php

namespace App\Imports;

use App\Models\Members;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class MembersImport implements ToModel , WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!array_filter($row)) {
            return null;
         } 

         return new User([
            'email' => $row['email'],
        ]);
    }

    //     return new Members([
    //         'firstname' => $row['firstname'],
    //         'lastnamet' => $row['lastname'],
    //         // 'DOB' => !$row[2] ? null : $row[2],
    //         //'email' => $row[3],
    //         // 'address' => $row[4],
    //         // 'status' => $row[5],
    //         // 'gender' => $row[6],
    //         // 'phone' => $row[7],
    //         // 'emergency_contact' => $row[8],
    //         // 'health_issues' => $row[9],
    //         // 'source' => $row[10],  
    //         // 'created_by' => $row[11],
    //         // 'updated_by' => $row[12],
    //         // 'cin' => $row[13]
    //     ]);
    // }

    public function rules(): array
    {
        return [
            'email' => function($attribute, $value, $onFailure) {
                if ($value === 'bensaadat1.amine@gmail.com') {
                     $onFailure('Name is not Patrick Brouwers t1');
                }
            }
        ];
    }

    public function onFailure(Failure ...$failure)
    {
    
    }

    // public function collection(Collection $rows)
    // {
    //      Validator::make($rows->toArray(), [
    //          '*.0' => 'required',
    //      ])->validate();

    //     foreach ($rows as $row) {
    //         Members::create([
    //                 'firstname' => $row[0],
    //                 'lastname' => $row[1],
    //                 //'DOB' => $row[2],
    //                 'email' => $row[3],
    //                 'address' => $row[4],
    //                 'status' => $row[5],
    //                 'gender' => $row[6],
    //                 'phone' => $row[7],
    //                 'emergency_contact' => $row[8],
    //                 'health_issues' => $row[9],
    //                 'source' => $row[10],  
    //                 'created_by' => $row[11],
    //                 'updated_by' => $row[12],
    //                 'cin' => $row[13]
    //         ]);
    //     }
    // }
}
