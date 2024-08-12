<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithLogo;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class BillExport implements FromCollection, WithHeadings, WithMapping
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
            'Order #',
            'Customer Name',
            'Customer Focal Person',
            'Address',
            'Street',
            'Location',
            'GPS',
            'Customer Contact #',
            'Order Type',
            'Tanker',
            'Driver',
            'Driver Phone',
            'Hydrant',
            'Amount',
            'Gallon',
            'Status',
            'Cancle Reason',
            'Creation Date',
            // Add more headings as needed
        ];
    }
    public function map($row): array
    {
        $this->rowNumber++; // Increment the row number
        $status = '';
        if($row->status == 1)
        {
            $status = 'COMPLETE';
        }
        if($row->status == 2)
        {
            $status = 'DISPATCH';
        }
        if($row->status == 3)
        {
            $status = 'CANCEL';
        }
        if($row->status == 4)
        {
            $status = 'PENDING';
        }
        return [
            $this->rowNumber,
            $row->order->Order_Number,
            $row->order->customer->name,
            $row->order->contact_num,
            $row->order->customer->address,
            $row->order->customer->street,
            $row->order->customer->loaction,
            $row->order->customer->gps,
            $row->order->customer->contact_num,
            $row->order->order_type,
            $row->truck->truck_num,
            $row->driver->name,
            $row->driver->phone,
            $row->order->hydrant->name,
            $row->amount,
            $row->order->truck_type_fun->name, // Access related data using Eloquent relationships
            $status,
            $row->cancle_reason,
            $row->created_at,
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
