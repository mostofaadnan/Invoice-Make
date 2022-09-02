<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandCategories;
use App\Models\Category;
use App\Models\InvoiceDetails;
use App\Models\OpeningStock;
use App\Models\Product;
use App\Models\purchasedetails;
use App\Models\PurchaseReturnDetails;
use App\Models\SaleReturnDetails;
use App\Models\Subcategory;
use App\Models\unit;
use App\Models\VatSetting;
use App\Models\WastageDetails;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit', 'update', 'Active', 'Inactive']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('product.index');
    }

    public function LoadAll(Request $request)
    {
        $product = Product::orderBy('id', 'desc')
            ->whereIn('status', [0, 1])
            ->latest()
            ->get();
        return Datatables::of($product)
            ->addIndexColumn()
            ->addColumn('category', function (product $products) {
                return $products->CategoryName->title;
            })
        /*    ->addColumn('subcategory', function (product $products) {
        return optional($products->SubcategoryName->title);
        })
        ->addColumn('brand', function (product $products) {
        return $products->BrandName->title;
        }) */
            ->addColumn('unit', function (product $products) {

                return $products->UnitName->Shortcut;
            })
            ->addColumn('user', function (product $products) {

                return $products->username ? $products->username->name : 'Deleted User';
            })
            ->addColumn('status', function ($product) {
                return $product->status == 1 ? 'Active' : 'In-Active';
            })
            ->addColumn('action', function ($product) {
                $button = '<div class="btn-group" role="group">';
                $button .= '<button id="btnGroupDrop1" type="button" class="btn btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $button .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                $button .= '<a class="dropdown-item" id="datashow" data-id="' . $product->id . '">View</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="dataedit" data-id="' . $product->id . '">Edit</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="datadelete" data-id="' . $product->id . '">Delete</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="stocksum" data-id="' . $product->id . '">Stock Summerise</a>';
                $button .= '<div class="dropdown-divider"></div>';
                if ($product->status == 1) {
                    $button .= '<a class="dropdown-item" id="inactive" data-id="' . $product->id . '"><span class="badge badge-danger">In-Active</span></a>';
                    $button .= '<div class="dropdown-divider"></div>';
                } else {
                    $button .= '<a class="dropdown-item" id="active" data-id="' . $product->id . '"><span class="badge badge-success">Active</span></a>';
                    $button .= '<div class="dropdown-divider"></div>';
                }
                $button .= '<a class="dropdown-item" id="dataarcive" data-id="' . $product->id . '">Archive</a>';
                $button .= '</div></div>';
                return $button;
            })

            ->make(true);
    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (product::where("id", "=", $code)->first());

        return $code;
    }
    public function BarcodeMaker()
    {
        /*  $NumberFormat = NumberFormat::select('product')->where('id', 1)->first();
        $productNumber = $NumberFormat->product;
        $lastproduct =DB::table('products')->latest()->first();
        if(!is_null($lastproduct)){
        $barcode = $lastproduct->id+1;
        }else{

        $barcode =1;
        } */
        do {
            $code = random_int(100000, 999999);
        } while (product::where("id", "=", $code)->first());

        return $code;

        return response()->json($code);
    }

    public function ItemDataList(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('status', 1)->orderBy("id", 'asc')->get();
            return view('datalist.itemdatalist', compact('products'))->render();
        }
    }
    public function ItemDataListCategory(Request $request)
    {
        $categoryid = $request->categoryid;
        if ($request->ajax()) {
            $products = Product::where('status', 1)
                ->where('category_id', $categoryid)
                ->orderBy("id", 'asc')
                ->get();
            return view('datalist.itemdatalist', compact('products'))->render();
        }
    }
    public function ItemSearch(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->value;
            $products = Product::query()
            /* ->select('id', 'name', 'barcode', 'tp', 'mrp','value') */
                ->where('id', 'LIKE', "%{$data}%")
                ->orWhere('productid', 'LIKE', "%{$data}%")
                ->orWhere('barcode', 'LIKE', "%{$data}%")
                ->orWhere('name', 'LIKE', "%{$data}%")
                ->orWhere('status', 1)
                ->orderBy("id", 'asc')
                ->get();
            return view('datalist.itemdatalist', compact('products'))->render();
        }
    }
    public function productGetList()
    {
        $products = Product::with('CategoryName', 'SubcategoryName', 'BrandName', 'UnitName')
            ->orderBy("id", 'asc')
            ->where('status', 1)
            ->get();
        return response()->json($products);
    }

    public function search(Request $request)
    {
        $data = $request->search;
        $products = Product::query()
            ->where('id', 'LIKE', "%{$data}%")
            ->orWhere('productid', 'LIKE', "%{$data}%")
            ->orWhere('barcode', 'LIKE', "%{$data}%")
            ->orWhere('name', 'LIKE', "%{$data}%")
            ->with('CategoryName', 'SubcategoryName', 'BrandName', 'UnitName')
            ->orderBy("id", 'asc')
            ->get();

        return response()->json($products);
    }

    public function getDataById(Request $request)
    {
       // $id = $request->dataid;
         $id = Session::get('productid');
        $product = Product::with(
            'CategoryName',
            'SubcategoryName',
            'UnitName',
            'BrandName',
            'VatName',
            'username')->find($id);
        return response()->json($product);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $units = unit::orderBy('Shortcut', 'asc')->get();
        $vats = VatSetting::orderBy('name', 'asc')->get();
        return view('product.create', compact('categories', 'units', 'vats'));
    }
    public function getSubcaegoryList(Request $request)
    {
        $subcategory = Subcategory::orderBy('title', 'asc')
            ->where("category_id", $request->category_id)
            ->pluck("title", "id");
        return response()->json($subcategory);
    }
    public function getBrandList(Request $request)
    {
        $brand = BrandCategories::with('BrandName')
            ->where("category_id", $request->category_id)
            ->get();
        //   ->pluck("title", "id");
        return response()->json($brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate(
            [
                'name' => 'required|min:5|string',
                'category' => 'required|numeric|min:1',
                /*  'brand' => 'nullable', */
                'unit' => 'required|min:1',
                'openingdate' => 'required|date',
                'tp' => 'required|numeric|min:1',
                'mrp' => 'required|numeric|min:1',
                'remark' => 'nullable',
                'barcode' => 'nullable',
                'subcategory' => 'nullable',
            ],
            [
                'name.required' => 'Product Name Required',
                'category.required' => 'Please Select Category',
                'category.min:1' => 'Please Select Category',
                /*  'brand.required' => 'Please Select Brand', */
                'brand.min:1' => 'Please Select Brand',
                'unit.required' => 'Please Select Unit',
                'unit.min:1' => 'Please Select Unit',

            ]
        );

        $product = new Product();
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        /*     $product->brand_id = $request->brand; */
        $product->unit_id = $request->unit;
        $product->openingDate = $request->openingdate;
        $product->tp = $request->tp;
        $product->mrp = $request->mrp;
        $product->VatSetting_id = $request->vattype;
        $product->remark = $request->remark;
        $product->status = $request->status;
        $product->admin_id = 1;
        $productSave = $product->save();
        return response()->json($productSave);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->productId($id);
        return view('product.view');
    }
    public function Active($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $prductactive = $product->update();
        return response()->json($prductactive);
    }
    public function Inactive($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $prductactive = $product->update();
        return response()->json($prductactive);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->productId($id);
        $brands = Brand::orderBy('title', 'asc')->get();
        $categories = Category::orderBy('id', 'asc')->get();
        $units = unit::orderBy('Shortcut', 'asc')->get();
        $vats = VatSetting::orderBy('name', 'asc')->get();
        return view('product.create', compact('brands', 'categories', 'units', 'vats'));
    }
    public function productId($id)
    {
        Session::put('productid', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->dataid;
        $validator = $request->validate(
            [
                'name' => 'required|min:5|string',
                'category' => 'required|numeric|min:1',
                'brand' => 'nullable',
                'unit' => 'required|min:1',
                'openingdate' => 'required|date',
                'tp' => 'required|numeric|min:1',
                'mrp' => 'required|numeric|min:1',
                'remark' => 'nullable',
                'barcode' => 'nullable',
                'subcategory' => 'nullable',
            ],
            [
                'name.required' => 'Product Name Required',
                'category.required' => 'Please Select Category',
                'category.min:1' => 'Please Select Category',
                'brand.required' => 'Please Select Brand',
                'brand.min:1' => 'Please Select Brand',
                'unit.required' => 'Please Select Unit',
                'unit.min:1' => 'Please Select Unit',

            ]
        );
        $product = Product::find($id);
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->brand_id = $request->brand;
        $product->unit_id = $request->unit;
        $product->openingDate = $request->openingdate;
        $product->tp = $request->tp;
        $product->mrp = $request->mrp;
        $product->VatSetting_id = $request->vattype;
        $product->remark = $request->remark;
        $product->status = $request->status;
        $product->admin_id = 1;
        $productSave = $product->update();
        return response()->json($productSave);
    }

    public function DataUpdate(Request $request)
    {
        $id = $request->dataid;
        $validator = $request->validate(
            [
                'name' => 'required|min:5|string',
                'category' => 'required|numeric|min:1',
                'brand' => 'nullable',
                'unit' => 'required|min:1',
                'openingdate' => 'required|date',
                'tp' => 'required|numeric|min:1',
                'mrp' => 'required|numeric|min:1',
                'remark' => 'nullable',
                'barcode' => 'nullable',
                'subcategory' => 'nullable',
            ],
            [
                'name.required' => 'Product Name Required',
                'category.required' => 'Please Select Category',
                'category.min:1' => 'Please Select Category',
                'brand.required' => 'Please Select Brand',
                'brand.min:1' => 'Please Select Brand',
                'unit.required' => 'Please Select Unit',
                'unit.min:1' => 'Please Select Unit',

            ]
        );

        $product = Product::find($id);
        //$product->productid = 1;
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->brand_id = $request->brand;
        $product->unit_id = $request->unit;
        $product->openingDate = $request->openingdate;
        $product->tp = $request->tp;
        $product->mrp = $request->mrp;
        $product->VatSetting_id = $request->vattype;
        $product->remark = $request->remark;
        $product->status = $request->status;
        $product->admin_id = 1;

        $productSave = $product->update();
        $product->update();
        return response()->json($productSave);
        /*  Session()->flash('success', 'product has update successfully');
    return redirect()->Route('products');
     */
    }
    public function OpeningStock($id)
    {
        return view('product.openstock' ,compact('id'));
    }
    public function GetOpening($id)
    {
        $getOpening = OpeningStock::where('product_id', $id)->first();
        if (!is_null($getOpening)) {
            $qty = $getOpening->qty;
        } else {
            $qty = 0;
        }

        return response()->json($qty);
    }
    public function OpeningStore(Request $request)
    {
        $productid = $request->product_id;
        $qty = $request->qty;
        $getOpening = OpeningStock::where('product_id', $productid)->first();
        if (!is_null($getOpening)) {
            //update
            $getOpening->qty = $qty;
            $getOpening->update();
        } else {
            $OpeningStock = new OpeningStock();
            $OpeningStock->product_id = $productid;
            $OpeningStock->qty = $qty;
            $OpeningStock->unit_id = $request->unit_id;
            $OpeningStock->user_id = Auth::id();
            $OpeningStock->save();
        }
        return response()->json($productid);
    }
    public function StockCheck($id)
    {
        $products = Product::find($id);
        $openigqty = $products->qty;
        $invoice = $products->QuantityOutBySale->sum('qty');
        $invoiceReturn = $products->QuantityOutBySaleReturn->sum('qty');
        $totalinvoiceqty = $invoice - $invoiceReturn;
        $purchase = $products->QuantityOutByPurchase->sum('qty');
        $PurchaseReturn = $products->QuantityOutByPurchaseReturn->sum('qty');
        $totalPurchaseqty = $purchase - $PurchaseReturn;
        $stock = $openigqty + ($totalPurchaseqty - $totalinvoiceqty);
        return $stock;
    }

    public function CurrentStock(Request $request)
    {
        $id = $request->id;
        $products = Product::find($id);
        $openigqty = $products->openingStock()->sum('qty');
        $invoice = $products->QuantityOutBySale()->sum('qty');
        $invoiceReturn = $products->QuantityOutBySaleReturn()->sum('qty');
        $totalinvoiceqty = $invoice - $invoiceReturn;
        $purchase = $products->QuantityOutByPurchase()->sum('qty');
        $PurchaseReturn = $products->QuantityOutByPurchaseReturn()->sum('qty');
        $totalPurchaseqty = $purchase - $PurchaseReturn;
        $stock = $openigqty + ($totalPurchaseqty - $totalinvoiceqty);
        return response()->json($stock);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            if (InvoiceDetails::where('item_id', '=', $id)->exists() || purchasedetails::where('itemcode', '=', $id)->exists() || SaleReturnDetails::where('	item_id', '=', $id)->exists() || PurchaseReturnDetails::where('itemcode', '=', $id)->exists()) {
                $product->status = 2;
                $product->update();
            } else {
                $product->delete();
                $wastage = WastageDetails::where('item_id', $id);
                if (!is_null($wastage)) {
                    $wastage->delete();
                }
            }
            return response()->json($product);
        }
    }

    public function Discount()
    {
        return view('product.discount');
    }
    public function updateDiscount(Request $request)
    {
        $tableData = $request->itemtables;
        foreach ($tableData as $items) {
            $itemid = $items['code'];
            $Product = Product::find($itemid);
            $Product->tp = $items['tp'];
            $Product->mrp = $items['mrp'];
            $Product->discount = $items['discountprice'];
            $Product->update();
        }
    }
    public function makeArchive($id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            $product->status = 2;
            $product->update();
            return response()->json($product);
        }
    }
    public function makeRetrive($id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            $product->status = 1;
            $product->update();
            return response()->json($product);
        }
    }
    public function Archive()
    {
        return view('product.archive');
    }
    public function loadallarchive()
    {
        $product = Product::orderBy('id', 'desc')
            ->where('status', 2)
            ->latest()
            ->get();
        return Datatables::of($product)
            ->addIndexColumn()
            ->addColumn('category', function (product $products) {
                return $products->CategoryName->title;
            })
            ->addColumn('unit', function (product $products) {
                return $products->UnitName->Shortcut;
            })
            ->addColumn('user', function (product $products) {
                return $products->username ? $products->username->name : 'Deleted User';

            })
            ->addColumn('status', function ($product) {
                return $product->status == 1 ? 'Active' : 'In-Active';
            })
            ->addColumn('action', function ($product) {
                $button = '<div class="btn-group" role="group">';
                $button .= '<button id="btnGroupDrop1" type="button" class="btn btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $button .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                $button .= '<a class="dropdown-item" id="dataretrived" data-id="' . $product->id . '">Retrive</a>';
                $button .= '</div></div>';
                return $button;
            })
            ->make(true);
    }
}
