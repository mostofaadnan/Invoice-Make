@extends('layouts.master')
@section('content')
<style>
.btn-group{
  border:none;
}
</style>
<div class="row">
  <div class="col-sm-8 form-single-input-section">
    <div class="card card-design">
      <div class="card-header card-header-section">
        <div class="row mb-3 mt-2">
          <div class="col-sm-6">
          @lang('home.new')  @lang('home.item')
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="search" placeholder=" @lang('home.search')" list="product" autocomplete="off">
            <datalist id="product">
            </datalist>
          </div>
        </div>
      </div>
      <div class="card-body form-div">
        <div class="mb-2"></div>
        <div class="container">
          @include('partials.ErrorMessage')
          <!--  <form class="forms-sample" action="{{ route('product.store') }} " method="POST" enctype="multipart/form-data">  -->
          @csrf
          <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
            <li class="nav-item waves-effect waves-light">
              <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">@lang('home.description')</a>
            </li>
            <!--  <li class="nav-item waves-effect waves-light">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile Picture</a>
            </li> -->
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              @include('product.partials.inputForm')
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              @include('product.partials.profilePicture')
            </div>
          </div>

        </div>
      </div>

      <div class="card-footer  card-footer-section">
        <div class="pull-right">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="datainsert" class="btn btn-success btn-lg"> @lang('home.submit')</button>
          <button id="reset" class="btn btn-light clear_field btn-lg"> @lang('home.reset')</button>
          <button id="deletedata" class="btn btn-danger btn-lg"> @lang('home.delete')</button>
       </div>
        </div>
      </div>
    </div>

  </div>

</div>



@include('product.partials.productcreatescripts');
  
</script>

@endsection