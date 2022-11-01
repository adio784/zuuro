<?php
namespace App\Imports;

use App\Models\DataPricing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataPricingImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model\null
     */

     public function model(array $row)
     {
        return new DataPricing([
            //
            'data_quant' => $row['data_quant'],
            'network' => $row['network'],
            'data_price' => $row['data_price'],
            'duration' => $row['duration'],
            'interest' => $row['interest'],
            'loan_price' => $row['loan_price'],
        ]);

     }
}
