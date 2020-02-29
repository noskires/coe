<?php

namespace App\Http\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use App\Transaction;
use App\User;

class TransactionsExport implements FromView
{
    public function view(): View
    {
        return view('export.exportTransactions', [
            'transactions' => Transaction::all()
        ]);
    }
}