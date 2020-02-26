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
@include('templates.Admin.btnCreate')

{{-- table Product --}}
<div class="w-100">
    {{-- Create Product --}}
    <div class="mb-4 NoDisp" id="layoutCreate">
        <div class="border border-secondary rounded ">
            <div class="d-flex justify-content-between mt-3 px-2">
                <h3 class="text-uppercase text-primary">create product</h3>
                <button id="btnReset" class="btn btn-sm btn-warning text-uppercase">Reset</button>
            </div>
            <hr width="96%">
            <form action="{{ route('product.store') }}" id="txtFormCreate" method="post" class="p-2" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-8">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">&nbsp;&nbsp;Name:&nbsp;&nbsp;</span>
                            </div>
                            <input class="form-control" type="text" id="txtName" name="name" value="{{ old('name') }}"
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
                                        <option value="{{ $categories[$j]->id }}">{{ $categories[$j]->name }}</option>
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
                            <input class="form-control" type="text" id="txtPrice" name="price" value="{{ old('price') }}"
                                placeholder="Insert Price Products Here">
                        </div>

                        <div class="input-group mb-3 d-flex justify-content-around">
                            <div><input class="form-check-input" type="checkbox" name="chkbNews" value="1" id="chkbNews"
                                    checked>
                                <label class="form-check-label" for="chkbNews">
                                    News
                                </label></div>
                            <div><input class="form-check-input" type="checkbox" name="chkTopSelling" value="1" id="chkTopSelling">
                                <label class="form-check-label" for="chkTopSelling">
                                    Top Selling
                                </label></div>
                            <div><input class="form-check-input" type="checkbox" name="chkbSaleOff" value="1" id="chkbSaleOff">
                                <label class="form-check-label" for="chkbSaleOff">
                                    Sale
                                </label>
                                <input class type="text" id="txtSaleOff" name="txtSaleOff" value="{{ old('txtSaleOff') }}"
                                    disabled></div>
                        </div>

                        <div class="mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea id="txtDescription" name="txtDescription" class="form-control" value=""
                                aria-label="With textarea">{{ old('txtDescription') }}
                            </textarea>
                            <script type="text/javascript">
                                ckeditor('txtDescription')
                            </script>
                        </div>

                        <div class="mb-3">
                            <span class="input-group-text">Content</span>
                            <textarea id="txtContent" name="txtContent" class="form-control" value="" aria-label="With textarea">{{ old('txtContent') }}</textarea>
                            <script type="text/javascript">
                                ckeditor('txtContent')
                            </script>
                        </div>

                        <div class="form-group">
                            <p>Avatar Product</p>
                            <input type="file" value="{{ old('productImage') }}" name="productImage" id='productImage' />
                        </div>
                    </div>

                    {{-- multi image --}}
                    <div class="col-4">
                        @for ($i = 1; $i < 5; $i++) <div class="form-group">
                            <label>Image Product Detail {{ $i }}</label>
                            <input type="file" name="picProductDetail[]" id='picture{{ $i }}' />
                    </div>
                    {{-- end multi image --}}
                    @endfor
                </div>
        </div>

        <hr width="96%">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-sm btn-success text-uppercase" data-toggle="modal" data-target="#createConfirm">
                Create
            </button>
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="createConfirm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alert!!!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Do you want to <span class="text-success text-uppercase">add</span> new product?
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger text-uppercase" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary text-uppercase">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        </div>
        </form>

    </div>
</div>
{{-- End Create Product --}}

{{-- Table Product --}}
{{-- Status Product --}}
<p class="text-uppercase font-weight-bold">{{ $type or 'all' }} Products</p>
<hr>
<div class="d-flex">
    <h5 class="m-0 pt-1 text-uppercase">filter:</h5>
    <a href="{{ route('product.sortBy','all') }}"><button class="btn btn-sm btn-dark mx-2">All</button></a>
    <a href="{{ route('product.sortBy','new') }}"><button class="btn btn-sm btn-success mx-2">News</button></a>
    <a href="{{ route('product.sortBy','top_selling') }}"><button class="btn btn-sm btn-warning mx-2">Top Selling</button></a>
    <a href="{{ route('product.sortBy','sale') }}"><button class="btn btn-sm btn-danger mx-2">Sale Off</button></a>
</div>
{{-- End Status Product --}}
<table class="table table-sm table-bordered table-hover table-striped mt-3">
    <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Picture</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key=>$product)
        <tr class="text-center">
            <th scope="row">{{ $products->firstItem()+$key }}</th>

            <td>
                <a href="{{ asset('admin/product\/').$product->id.'/edit' }}" class="No--UdLine">
                    {{ $product->name }}
                    @if ($product->new)
                    <span class="badge badge-success">NEW</span>
                    @endif
                    @if ($product->top_selling)
                    <span class="badge badge-warning">TOP</span>
                    @endif
                    @if ($product->sale)
                    <span class="badge badge-danger">-{{$product->sale }}%</span>
                    @endif
                </a>
            </td>

            <td scope="col"><img style="height:50px;width:50px;" src="{{asset($product->picture) }}" alt="product"></td>
            <td>{{ number_format($product->price,0,',','.').' $' }}</td>

            <td class="d-flex justify-content-around align-items-center">
                <form action="{{ route('product.edit',$product->id) }}" method="get"><button class="btn btn-sm btn-warning text-uppercase">Edit</button>
                </form>

                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-sm btn-danger text-uppercase" data-toggle="modal" data-target="#delConfirm{{ $product->id }}">
                        Delete
                    </button>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="delConfirm{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Alert!!!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you want to <span class="text-danger text-uppercase">delete</span> this
                                    product?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-uppercase" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary text-uppercase">Okay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal --}}
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- End Table Product --}}

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{ $products->url(1) }}" rel="prev">«</a></li>
        @for ($i=1;$i<=$products->lastPage();$i++)
            <li class="page-item @if ($products->currentPage()===$i) {{ 'active' }} @endif)">
                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a></li>
            @endfor
            <li class="page-item"><a class="page-link" href="{{ $products->url($products->lastPage()) }}" rel="next">»</a></li>
    </ul>
</div>
{{-- End Pagination --}}
</div>
{{-- end table Product --}}

@endsection