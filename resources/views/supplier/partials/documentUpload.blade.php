@extends('layouts.master')
@section('content')
<style>
    .image-body {
        margin: auto;
    }

    .img-upload {
        margin: auto;
        align-items: center;
    }

    .card {
        margin: auto;
    }
</style>
<div class="col-sm-12 form-single-input-section">
    <div class="card">
        <div class="card-header card-header-custom">
            Document Upload
        </div>
        <div class="card-body">
            @include('partials.ErrorMessage')
            <form action="{{ route('supplier.documentupload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-8 col-md-8">
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Supplier</span>
                            </div>
                            <input type="text" name="sup_name" id="sup_name" class="form-control" placeholder="Supplier Name" value="{{ $supplier->name }}" readonly>
                            <input type="hidden" name="id" value="{{ $supplier->id }}">
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Document Type</span>
                            </div>
                            <input type="text" name="type" class="form-control" placeholder="Documents Type">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Remark</label>
                            </div>
                            <textarea name="remark" class="form-control" cols="30" rows="10" placeholder="remark">
                             </textarea>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="card">
                            <div class="card-body image-body">
                                <div class="main-img-preview">
                                    <img class="thumbnail img-preview" src="{{asset('images/supplier/SupplierDoucument/simple.png')}}" style="width:200px; height: 200px" name="image" class="img-thumbnail" title="Preview Logo">
                                </div>
                            </div>
                            <div class="card-footer" ">
        <div class=" input-group">
                                <input id="fakeUploadLogo" type="hidden" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                                <div class="input-group-btn img-upload">
                                    <div class="fileUpload btn btn-danger ">
                                        <span><i class="glyphicon glyphicon-upload"></i> Upload</span>
                                        <input id="logo-id" name="supplier_image" type="file" class="attachment_upload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <hr>
        <div class="pull-right">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Save</button>
        </div>

        </form>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var brand = document.getElementById('logo-id');
        brand.className = 'attachment_upload';
        brand.onchange = function() {
            document.getElementById('fakeUploadLogo').value = this.value.substring(12);
        };

        // Source: http://stackoverflow.com/a/4459419/6396981
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#logo-id").change(function() {
            readURL(this);
        });
    });
</script>
@endsection