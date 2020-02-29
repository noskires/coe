<?php

namespace App\Http\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Transaction;
use App\TransactionItem;
use App\User;

use DB;

class TransactionItemsExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function headings(): array
    {
        return [
            'ID',
            'Transaction Code',
            'Transaction Desc',
            'Transaction Date',
            'Destination',
            'Addressee Code',
            'Addressee Name',
            'Document Type',
            'Employee Code',
            'Employee Name',
            'Remarks',
            'Waybill Number',
            'Office Location',
            'Created By',
            'Created At'
        ];
    }

    public function forTransactionCode($transactionCode)
    {
        $this->transactionCode = $transactionCode;
        return $this;
    }

    public function query()
    {
        $collection = DB::table('transaction_items as transaction_item')
            ->select(
            'transaction_item.id',
            'transaction_item.transaction_code',
            'transaction.transaction_desc',
            'transaction.transaction_date',
            'location.location_desc',
            'transaction_item.addressee_code',
            DB::raw("CONCAT(rtrim(CONCAT(addresseeName.last_name,' ',COALESCE(addresseeName.affix,''))),', ', COALESCE(addresseeName.first_name,''),' ', COALESCE(addresseeName.middle_name,'')) as addressee_name"),
            'document.document_desc',
            'transaction_item.employee_code',
            DB::raw("CONCAT(rtrim(CONCAT(employee.last_name,' ',COALESCE(employee.affix,''))),', ', COALESCE(employee.first_name,''),' ', COALESCE(employee.middle_name,'')) as employee_name"),
            'transaction_item.remarks',
            'transaction_item.waybill_number',
            'transaction_item.office_location',
            'transaction_item.created_by',
            'transaction_item.created_at'
            
            )
            ->leftjoin('transactions as transaction','transaction.transaction_code','=','transaction_item.transaction_code')
            ->leftjoin('employees as employee','employee.employee_code','=','transaction_item.employee_code')
            ->leftjoin('documents as document','document.document_code','=','transaction_item.document_code')
            ->leftjoin('addressees as addressee','addressee.addressee_code','=','transaction_item.addressee_code')
            ->leftjoin('employees as addresseeName','addresseeName.employee_code','=','transaction_item.addressee_code')
            ->leftjoin('locations as location','location.location_code','=','transaction_item.location_code');
        
        $collection = $collection->orderBy('location.location_desc', 'asc');
        $collection = $collection->orderBy('document.document_desc', 'asc');
        $collection = $collection->orderBy('addresseeName.last_name', 'asc');
        $collection = $collection->orderBy('addresseeName.affix', 'asc');
        $collection = $collection->orderBy('addresseeName.first_name', 'asc');
        $collection = $collection->orderBy('addresseeName.middle_name', 'asc');
        $collection = $collection->orderBy('employee.last_name', 'asc');
        $collection = $collection->orderBy('employee.affix', 'asc');
        $collection = $collection->orderBy('employee.first_name', 'asc');
        $collection = $collection->orderBy('employee.middle_name', 'asc');

        $collection = $collection->where('transaction.transaction_code', $this->transactionCode);

        return $collection;
    }
}