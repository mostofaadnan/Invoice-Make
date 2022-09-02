<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\purchase;
use App\Models\SupplierPayment;
use App\Models\CustomerPaymentRecieve;
use App\Models\CashDrawer;
use App\Models\Expenses;
use App\Charts\CashInvoiceChart;
use App\Charts\PurchaseChart;
use App\Charts\SupplierPaymentChart;
use App\Charts\CustomerPaymentChart;
use App\Charts\ExpensesChart;
use App\Charts\DayCloseChart;
use App\User;
use DB;
use Charts;
use Illuminate\Support\Carbon;


class PageController extends Controller
{
  public function index()
  {
    $apiinvoice = url('Chart/InvoiceBarchart');
    $apipurchase = url('Chart/PurchaseBarchart');
    $apiSupplierPaymentChart = url('Chart/SupplierPaymentChart');
    $apiCustomerPaymentChart = url('Chart/CustomerPaymentchart');
    $apiExpensesChart = url('Chart/ExpensesChart');
    $apiDayCloseChart = url('Chart/DayCloseChart');

    $invoicechart = new CashInvoiceChart;
    $invoicechart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($apiinvoice);

    $purchasechart = new PurchaseChart;
    $purchasechart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($apipurchase);

    $SupplierPaymentChart = new SupplierPaymentChart;
    $SupplierPaymentChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($apiSupplierPaymentChart);

    $CustomerPaymentChart = new CustomerPaymentChart;
    $CustomerPaymentChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($apiCustomerPaymentChart);


    $ExpensesChart = new ExpensesChart;
    $ExpensesChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($apiExpensesChart);

    $DayCloseChart = new DayCloseChart;
    $DayCloseChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($apiDayCloseChart);



    return view('pages.index', compact('invoicechart', 'purchasechart', 'SupplierPaymentChart', 'CustomerPaymentChart', 'ExpensesChart', 'DayCloseChart'));
  }

  public function AccountSummery(Request $request)
  {

    $cashin = 0;
    $cashout = 0;
    $type = $request->type;
    switch ($type) {
      case 1:
        $currentdate = date('Y-m-d');
        $data['date'] = date('Y-m-d');
        $data['invoice'] = Invoice::whereDate('created_at', $currentdate)
          ->sum('nettotal');
        $data['purchase'] = purchase::whereDate('created_at', $currentdate)
          ->sum('nettotal');
        $data['SupplierPayment'] = SupplierPayment::whereDate('created_at', $currentdate)
          ->sum('amount');
        $data['CustomerRecieved'] = CustomerPaymentRecieve::whereDate('created_at', $currentdate)
          ->sum('amount');
        $data['Expenses'] = Expenses::whereDate('created_at', $currentdate)
          ->sum('amount');
        break;
      case 2:
        $sevendays = \Carbon\Carbon::today()->subDays(7);
        $data['invoice'] = Invoice::where('created_at', '>=', $sevendays)

          ->sum('nettotal');
        $data['purchase'] = Purchase::where('created_at', '>=', $sevendays)
          ->sum('nettotal');
        $data['SupplierPayment'] = SupplierPayment::where('created_at', '>=', $sevendays)
          ->sum('amount');
        $data['CustomerRecieved'] = CustomerPaymentRecieve::where('created_at', '>=', $sevendays)
          ->sum('amount');
        $data['Expenses'] = Expenses::where('created_at', '>=', $sevendays)
          ->sum('amount');
        break;
      case 3:
        $month = \Carbon\Carbon::now()->month;
        $year = \Carbon\Carbon::now()->year;

        $data['invoice'] = Invoice::whereYear('created_at', $year)
          ->whereMonth('created_at', $month)

          ->sum('nettotal');

        $data['purchase'] = purchase::whereYear('created_at', $year)
          ->whereMonth('created_at', $month)
          ->sum('nettotal');
        $data['SupplierPayment'] = SupplierPayment::whereMonth('inputdate', date('m'))
          ->sum('amount');
        $data['CustomerRecieved'] = CustomerPaymentRecieve::whereYear('created_at', $year)
          ->whereMonth('created_at', $month)
          ->sum('amount');
        $data['Expenses'] = Expenses::whereYear('created_at', $year)
          ->whereMonth('created_at', $month)
          ->sum('amount');
        break;
      default:
        $year = \Carbon\Carbon::now()->year;
        $data['invoice'] = Invoice::whereYear('created_at', $year)
          ->sum('nettotal');
        $data['purchase'] = purchase::whereYear('created_at', $year)
          ->sum('nettotal');
        $data['SupplierPayment'] = SupplierPayment::whereYear('created_at', $year)
          ->sum('amount');
        $data['CustomerRecieved'] = CustomerPaymentRecieve::whereYear('created_at', $year)
          ->sum('amount');
        $data['Expenses'] = Expenses::whereYear('created_at', $year)
          ->sum('amount');
        break;
    }

    $cashin = CashDrawer::sum('cashin');
    $cashout = CashDrawer::sum('cashout');
    $data['balance'] = $cashin - $cashout;
    return response()->json($data);
  }
}
