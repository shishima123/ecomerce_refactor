@extends('templates.Admin.master')
@section('title','Admin Page - Management Product')
@section('ckeditor')
<script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript">
    var baseURL = "{!! url('/') !!}";
    console.log(baseURL);
</script>
<script type="text/javascript" src="{{ asset('js/func_ckfinder.js') }}"></script>

@endsection
@section('content')
@section('header','Products management')
@include('templates.Admin.error')
@include('templates.Admin.flash_message')

{{-- Edit Product --}}
<div class="w-100">
    <div class="border border-secondary rounded ">
        <div class="d-flex justify-content-between mt-3 px-2">
            <h3 class="text-uppercase text-primary">Edit product</h3>
            <button id="btnReset" class="btn btn-sm btn-warning text-uppercase">Reset</button>
        </div>
        <hr width="96%">
        <form action="{{ route('product.update',$product->id) }}" id="txtFormCreate" method="post" class="p-2" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">&nbsp;&nbsp;Name:&nbsp;&nbsp;</span>
                        </div>
                        <input class="form-control" type="text" id="txtName" name="name" value="{{ $product->name }}"
                            placeholder="Insert Name Products Here">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Category</label>
                        </div>

                        <select class="custom-select" name="parent_id">
                            @for ($i = 0; $i < count($categories); $i++) @if ($categories[$i]->parent_id===0)
                                <option value="{{ $categories[$i]->id }}" disabled class="text-success">{{
                                    $categories[$i]->name }}</option>
                                @for ($j = 0; $j < count($categories); $j++) @if ($categories[$j]->parent_id===$categories[$i]->id)
                                    @if ($categories[$j]->parent_id=$product->category_id)
                                    <option value="{{ $categories[$j]->id }}" selected>{{ $categories[$j]->name }}</option>
                                    @else
                                    <option value="{{ $categories[$j]->id }}">{{ $categories[$j]->name }}</option>
                                    @endif
                                    @endif
                                    @endfor
                                    @endif
                                    @endfor
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">&nbsp;&nbsp;Price:&nbsp;&nbsp;</span>
                        </div>
                        <input class="form-control" type="text" id="txtPrice" name="price" value="{{ $product->price }}"
                            placeholder="Insert Price Products Here">
                    </div>

                    <div class="input-group mb-3 d-flex justify-content-around">
                        <div>
                            @if ($product->new)
                            <input class="form-check-input" type="checkbox" name="chkbNews" value="1" id="chkbNews"
                                checked>
                            @else
                            <input class="form-check-input" type="checkbox" name="chkbNews" value="1" id="chkbNews">
                            @endif
                            <label class="form-check-label" for="chkbNews">
                                News
                            </label>
                        </div>
                        <div>
                            @if ($product->top_selling)
                            <input class="form-check-input" type="checkbox" name="chkTopSelling" value="1" id="chkTopSelling"
                                checked>
                            @else
                            <input class="form-check-input" type="checkbox" name="chkTopSelling" value="1" id="chkTopSelling">
                            @endif
                            <label class="form-check-label" for="chkTopSelling">
                                Top Selling
                            </label>
                        </div>
                        <div>
                            @if ($product->sale)
                            <input class="form-check-input" type="checkbox" name="chkbSaleOff" value="1" id="chkbSaleOff"
                                checked>
                            <label class="form-check-label" for="chkbSaleOff">
                                Sale
                            </label>
                            <input class type="text" id="txtSaleOff" name="txtSaleOff" value="{{$product->sale}}">
                            @else
                            <input class="form-check-input" type="checkbox" name="chkbSaleOff" value="1" id="chkbSaleOff">
                            <label class="form-check-label" for="chkbSaleOff">
                                Sale
                            </label>
                            <input class type="text" id="txtSaleOff" name="txtSaleOff" value="{{ old('txtSaleOff') }}"
                                disabled>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <span class="input-group-text">Description</span>
                        <textarea id="txtDescription" name="txtDescription" class="form-control" value="" aria-label="With textarea">{{ $product->description }}</textarea>
                        <script type="text/javascript">
                            ckeditor('txtDescription')
                        </script>
                    </div>

                    <div class="mb-3">
                        <span class="input-group-text">Content</span>
                        <textarea id="txtContent" name="txtContent" class="form-control" value="" aria-label="With textarea">{{ $product->content }}</textarea>
                        <script type="text/javascript">
                            ckeditor('txtContent')
                        </script>
                    </div>

                    <div class="form-group">
                        <p>Current Image</p>
                        <img src="{{ asset($product->picture) }}" class="img--Product_Height mb-2" alt="product">
                        <p>Change Image Product</p>
                        <input type="file" value="{{ old('productImage') }}" name="productImage" id='productImage' />
                    </div>
                </div>
                {{-- multi image --}}
                <div class="col-4">
                    @foreach ($product->image_products as $image)
                    <div class="text-center" id="img-{{ $image->id }}">
                        <img src="{{ asset($image->path) }}" class="img--Product_Height mb-2" alt="product">
                        <button type="button" class="btn btn-danger mb-3 delImg" id={{ $image->id }}>Delete Image</button>
                    </div>
                    @endforeach
                    <hr width="96%">
                    <button type="button" class="btn btn-success" id="addImage">Add Image</button>
                    <div id="insertImage">
                    </div>
                </div>
                {{-- end multi image --}}
            </div>
    </div>

    <hr width="96%">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-sm btn-success text-uppercase mb-3" data-toggle="modal" data-target="#updateConfirm">
            Update
        </button>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="updateConfirm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alert!!!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you want to <span class="text-success text-uppercase">changes</span> this product?
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger text-uppercase" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-uppercase">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        </form>
    </div>
</div>
{{-- End Create Product --}}
@endsection