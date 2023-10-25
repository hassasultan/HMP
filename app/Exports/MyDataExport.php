<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithLogo;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class MyDataExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;
    protected $rowNumber = 0; // Initialize row number
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return $this->data;
    }
    public function headings(): array
    {
        return [
            'Sr.#',
            'Date',
            'Order #',
            'Customer Name',
            'Address',
            'Contact #',
            'Tanker Quantity',
            'Order Type',
            'Order Date And Time',
            'Hydrant Name',
            // Add more headings as needed
        ];
    }
    public function map($row): array
    {
        $this->rowNumber++; // Increment the row number
        return [
            $this->rowNumber,
            date('d-m-y'),
            $row->Order_Number,
            $row->customer->name,
            $row->customer->address,
            $row->customer->contact_num,
            $row->truck_type_fun->name, // Access related data using Eloquent relationships
            $row->order_type,
            $row->billing->created_at,
            $row->hydrant->name,
            // Map other related data or fields
        ];
    }
    public function afterSheet(AfterSheet $event)
    {
        // Add the logo image
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertImage('A1', public_path('assets/img/unnamed.png'));
            },
        ];
    }
}
