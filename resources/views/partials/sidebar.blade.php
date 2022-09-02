<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3 style="border-bottom:1px solid #ccc !important;">@lang('home.menu')</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>@lang('home.deshboard')</a></li>
            <li><a><i class="fa fa-wrench" aria-hidden="true"></i> @lang('home.setup') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('company')}}">@lang('home.company')</a></li>
                    <li><a href="{{route('company.timezone')}}">@lang('home.timezone')</a></li>
                    <li><a href="{{route('categories')}}">@lang('home.category')</a></li>
                    <li><a href="{{Route('subcategories')}}">@lang('home.subcategory')</a></li>
                    <li><a href="{{Route('units')}}">@lang('home.unit')</a></li>
                    <li><a href="{{Route('brands')}}">@lang('home.brand')</a></li>
                    <li><a href="{{Route('banknames')}}">@lang('home.bank') @lang('home.name')</a></li>
                    <li><a href="{{Route('expensestypes')}}">@lang('home.expenses') @lang('home.type')</a></li>
                    <li><a href="{{Route('vatsettings')}}">@lang('home.vat') @lang('home.setting')</a></li>
                    <li><a href="{{Route('saleconfig')}}">@lang('home.sale') @lang('home.config')</a></li>
                    <li><a href="{{Route('numberformat')}}">@lang('home.number') @lang('home.format')</a></li>
                    <li><a href="{{Route('mailconfigs')}}">@lang('home.mail') @lang('home.config')</a></li>
                    <li><a href="{{Route('countrys')}}">@lang('home.country') @lang('home.list')</a></li>
                    <li><a href="{{Route('states')}}">@lang('home.state') @lang('home.list')</a></li>
                    <li><a href="{{Route('citys')}}">@lang('home.city') @lang('home.list')</a></li>
                    <li><a href="{{Route('designations')}}">@lang('home.designation') @lang('home.type')</a></li>
               
                </ul>
            </li>
            <li><a><i class="fa fa-product-hunt"></i>@lang('home.item') @lang('home.management') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('products')}}"> @lang('home.item') @lang('home.management')</a></li>
                    <li><a href="{{Route('product.create')}}">@lang('home.new') @lang('home.item')</a></li>
                    <li><a href="{{ Route('stocks') }}">@lang('home.stock') @lang('home.management')</a></li>
                    <li><a href="{{ Route('product.discount') }}">@lang('home.price')/ @lang('home.discount')  @lang('home.update')</a></li>
                    <li><a href="{{ Route('wastages') }}">@lang('home.wastage')</a></li>
                    <li><a href="{{ Route('labels') }}">@lang('home.print') @lang('home.label')</a></li>
                    <li><a href="{{ Route('product.Archive') }}">@lang('home.archive')</a></li>
                
                
                </ul>
            </li>
            <li><a><i class="fa fa-user" aria-hidden="true"></i> @lang('home.supplier') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ Route('suppliers')}}">@lang('home.supplier') @lang('home.management')</a></li>
                    <li><a href="{{ route('supplier.create') }}">@lang('home.new') @lang('home.supplier')</a></li>
                    <li><a href="{{ route('supplier.statement')}}">@lang('home.statement')</a></li>
                    <li><a href="{{ Route('supplier.Archived')}}">@lang('home.supplier') @lang('home.archive')</a></li>
               
                </ul>
            </li>
            <li><a><i class="fa fa-user" aria-hidden="true"></i>@lang('home.customer') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('customers') }}">@lang('home.customer') @lang('home.management')</a></li>
                    <li><a href="{{ route('customer.create') }}">@lang('home.new') @lang('home.customer')</a></li>
                    <li><a href="{{ route('customer.statement')}}">@lang('home.statement')</a></li>
                    <li><a href="{{ route('customer.Archived') }}">@lang('home.customer') @lang('home.archive')</a></li>
               
                </ul>
            </li>
            <li><a><i class="fa fa-shopping-cart" aria-hidden="true"></i>@lang('home.operation') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('purchases')}}">@lang('home.purchase') @lang('home.order') @lang('home.management')</a></li>
                    <li><a href="{{ route('precieves') }}">@lang('home.grn') </a></li>
                    <li><a href="{{ route('purchasereturns') }}">@lang('home.purchase') @lang('home.return')</a></li>
               
               
                </ul>
            </li>
            <li><a><i class="fa fa-money" aria-hidden="true"></i>@lang('home.payment')<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('supplierpayments') }}">@lang('home.supplier') @lang('home.payment')</a></li>
                    <li><a href="{{ route('customerpayments') }}">@lang('home.credit') @lang('home.payment')</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-shopping-cart" aria-hidden="true"></i>@lang('home.cash') @lang('home.invoice') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('invoices') }}">@lang('home.invoice') @lang('home.list')(@lang('home.cash'))</a></li>
                    <li><a href="{{ route('invoice.create') }}">@lang('home.new') @lang('home.cash') @lang('home.invoice')</a></li>
              
               
                </ul>
            </li>
            <li><a><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('home.credit') @lang('home.invoice') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('creditinvoices') }}">@lang('home.invoice') @lang('home.list')(@lang('home.credit'))</a></li>
                    <li><a href="{{ route('creditinvoice.create') }}">@lang('home.new') @lang('home.credit') @lang('home.invoice')</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-undo" aria-hidden="true"></i>@lang('home.sale') @lang('home.return')<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('salereturns') }}">@lang('home.sale') @lang('home.return')</a></li>
                    <li><a href="{{Route('invoice.cancels')}}">@lang('home.cancel') @lang('home.invoice')</a></li>
                
                </ul>
            </li>
            <li><a><i class="fa fa-percent" aria-hidden="true"></i> @lang('home.vat') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('vatcollections') }}">@lang('home.vat') @lang('home.collection')</a></li>
                    <li><a href="{{ route('vatcollection.vatpayment') }}">@lang('home.vat') @lang('home.payment')</a></li>
               
               
                </ul>
            </li>
            <li><a><i class="fa fa-university" aria-hidden="true"></i> @lang('home.account') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('cashdrawers') }}">@lang('home.cash') @lang('home.drawer')</a></li>
                    <li><a href="{{ route('banks') }}">@lang('home.bank') @lang('home.transection')</a></li>
                    <li><a href="{{ route('cashincashouts') }}">@lang('home.cashin')/@lang('home.cashout')</a></li>
                    <li><a href="{{ route('cards') }}">@lang('home.card') @lang('home.payment')</a></li>
                    <li><a href="{{ route('paypals') }}">@lang('home.paypal') @lang('home.payment')</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-minus-circle" aria-hidden="true"></i>@lang('home.expenses') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('exepensess') }}">@lang('home.expenses') @lang('home.list')</a></li>
                    <li><a href="{{ route('expenses.create') }}">@lang('home.new') @lang('home.expenses')</a></li>
                    <li><a href="{{ route('expenses.sectorexpenditureview') }}">@lang('home.sector') @lang('home.expenditure')</a></li>
                
                </ul>
            </li>
            <li><a><i class="fa fa-plus" aria-hidden="true"></i> @lang('home.income') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('income') }}">@lang('home.income') @lang('home.list')</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-times" aria-hidden="true"></i>@lang('home.closing')<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('daycloses') }}">@lang('home.daily')</a></li>
                    <li><a href="{{ route('dayclose.monthly') }}">@lang('home.monthly')</a></li>
                    <li><a href="{{ route('dayclose.yearly') }}">@lang('home.yearly')</a></li>

                </ul>
            </li>
            <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i> @lang('home.chart')<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('chart.invoiceview') }}">@lang('home.invoice')</a></li>
                    <li><a href="{{ route('chart.purchaseViewYearly') }}">@lang('home.purchase')</a></li>
                    <li><a href="{{ route('chart.supplieyPaymentYearlyView') }}">@lang('home.supplier') @lang('home.payment')</a></li>
                    <li><a href="{{ route('chart.customerPaymentYearlyView') }}">@lang('home.customer') @lang('home.payment')</a></li>
                    <li><a href="{{ route('chart.ExpensesYearlyChartView') }}">@lang('home.expenses')</a></li>
                
                </ul>
            </li>
            <li><a><i class="fa fa-flag" aria-hidden="true"></i> @lang('home.report')<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('report.invoice') }}">@lang('home.invoice')</a></li>
                    <li><a href="{{ route('report.invoicedetails') }}">@lang('home.invoice') @lang('home.details')</a></li>
                    <li><a href="{{ route('report.salereturn') }}">@lang('home.sale') @lang('home.return')</a></li>
                    <li><a href="{{ route('report.purchase') }}">@lang('home.purchase')</a></li>
                    <li><a href="{{ route('report.purchasedeatils') }}">@lang('home.purchase') @lang('home.details')</a></li>
                    <li><a href="{{ route('report.spayment') }}">@lang('home.supplier') @lang('home.payment')</a></li>
                    <li><a href="{{ route('report.cpayment') }}">@lang('home.customer') @lang('home.payment')</a></li>
                    <li><a href="{{ route('report.supplierstatement') }}">@lang('home.supplier') @lang('home.statement')</a></li>
                    <li><a href="{{ route('report.customerstatement') }}">@lang('home.customer') @lang('home.statement')</a></li>
                    <li><a href="{{ route('report.stockReport') }}">@lang('home.stock')</a></li>
                    <li><a href="{{ route('report.cashdrawer') }}">@lang('home.cash') @lang('home.drawer')</a></li>
                    <li><a href="{{ route('report.bank') }}">@lang('home.bank') @lang('home.transection')</a></li>
                    <li><a href="{{ route('report.card') }}">@lang('home.card') @lang('home.payment')</a></li>
                    <li><a href="{{ route('report.paypal') }}">@lang('home.paypal') @lang('home.payment')</a></li>
                    <li><a href="{{ route('report.expenses') }}">@lang('home.expenses')</a></li>
                    <li><a href="{{ route('report.sectorexpenditure') }}">@lang('home.sector') @lang('home.expenditure')</a></li>
                    <li><a href="{{ route('report.income') }}">@lang('home.income')</a></li>
                    <li><a href="{{ route('report.vat') }}">@lang('home.vat')</a></li>
                    <li><a href="{{ route('report.vatpayment') }}">@lang('home.vat') @lang('home.payment')</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('home.mail')<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('sendmails') }}">@lang('home.send') @lang('home.mail')</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-user" aria-hidden="true"></i> @lang('home.employee') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('employees') }}">@lang('home.employee') @lang('home.management')</a></li>
                    <li><a href="{{ route('salaries') }}">@lang('home.salary') @lang('home.sheet')</a></li>
                    <li><a href="{{ route('salary.salarypayment') }}">@lang('home.salary') @lang('home.payment')</a></li>
                
                
                </ul>
            </li>
            <li><a><i class="fa fa-user" aria-hidden="true"></i> @lang('home.user') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('users') }}">@lang('home.user') @lang('home.list')</a></li>
                    <li><a href="{{ route('user.create') }}">@lang('home.new') @lang('home.user')</a></li>
                    <li><a href="{{ route('roles') }}">@lang('home.user') @lang('home.role')</a></li>
                
                </ul>
            </li>
            <li><a><i class="fa fa-database" aria-hidden="true"></i> @lang('home.database') <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('database.index')}}"> @lang('home.backup')</a></li>
                    <li><a href="{{route('database.restore')}}"> @lang('home.restore')</a></li>
                </ul>
            </li>
        </ul>


    </div>
</div>