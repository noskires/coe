<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Exports\EmployeesExport;
use App\Http\Exports\TransactionsExport;
use App\Http\Exports\TransactionItemsExport;

use DB;
use Auth;
use Excel;
use App\User;
use Carbon\Carbon;

class ExportToExcelController extends Controller {

	public function index(){
		return view('layout.index');
	}

    public function exportEmployees(){
        return Excel::download(new EmployeesExport, 'All_Users.xlsx');
    }

    public function exportTransactions(){
        return Excel::download(new TransactionsExport, 'All_Transactions.xlsx');
    }

    public function exportTransactionItems($transactionCode){
        return (new TransactionItemsExport)->forTransactionCode($transactionCode)->download($transactionCode.'.xlsx');
    }

}