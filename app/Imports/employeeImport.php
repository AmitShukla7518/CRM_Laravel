<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Employees;

class employeeImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        $duplicateEntry = array();
        foreach ($rows as $index) {
            $generator = "1357902468";
            $result = "";
            for ($i = 1; $i <= 8; $i++) {
                $result .= substr($generator, (rand() % (strlen($generator))), 1);
            }
            $member = Employees::where('email', $index['email'])->first();
            if ($member === null) {
                Employees::create([
                    'EmployeeID' => 'CE' . $result,
                    'name' => $index['name'],
                    'email' => $index['email'],
                    'docID' => $index['docid'],
                    'address' => $index['address'],
                ]);
                // session()->flash('successMSG', 'All Entry has been store successfully !! ');
                session()->flash('success', 'All Entry has been store successfully !! ');
            } else {
                array_push($duplicateEntry, $index['email']);
                // session()->flash('duplicateMSG', '' . count($duplicateEntry) . ' Dpllicate Entry Found');
                session()->flash('error', '' . count($duplicateEntry) . '  Dpllicate Entry Found');
            }
        }
    }
}
