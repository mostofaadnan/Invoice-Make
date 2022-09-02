@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.item') @lang('home.management')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-success" href="{{Route('product.create')}}"><i class="fa fa-plus" aria-hidden="true"> @lang('home.new') @lang('home.item')</i>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="mytable" style="width:100%" cellspacing="0">

            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.barcode')</th>
                    <th> @lang('home.name') </th>
                    <th> @lang('home.category') </th>
                    <th> @lang('home.stock') @lang('home.unit')</th>
                    <th> @lang('home.tp')</th>
                    <th> @lang('home.mrp')</th>
                    <th> @lang('home.discount')</th>
                    <th> @lang('home.status')</th>
                    <th> @lang('home.action')</th>
                </tr>

            </thead>
            <tbody id="tablebody">

            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.barcode')</th>
                    <th> @lang('home.name') </th>
                    <th> @lang('home.category') </th>
                    <th> @lang('home.stock') @lang('home.unit')</th>
                    <th> @lang('home.tp')</th>
                    <th> @lang('home.mrp')</th>
                    <th> @lang('home.discount')</th>
                    <th> @lang('home.status')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </tfoot>
            <!-- <tfoot>
                <tr>
                    <td><input type="text" class="form-control" placeholder="Sl"></td>
                    <td><input type="text" class="form-control" placeholder="Barcode"></td>
                    <td><input type="text" class="form-control" placeholder="Name"></td>
                    <td><input type="text" class="form-control" placeholder="Category"></td>
                    <td><input type="text" class="form-control" placeholder="Stock unit"></td>
                    <td><input type="text" class="form-control" placeholder="TP"></td>
                    <td><input type="text" class="form-control" placeholder="MRP"></td>
                    <td><select name="" id="" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="2" selected>Inactive</option>
                        </select></td>
                    <td><button class="btn btn-success" style="width:100%">Find</button></td>
                </tr>
            </tfoot> -->
        </table>
    </div>
    <!--    <div class="card-footer">

    </div> -->

</div>
@include('product.partials.productindexscript')

@endsection