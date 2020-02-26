@extends('templates.Admin.master')
@section('title','Admin Page - Management Category')
@section('header','Categories management')
@section('content')
@include('templates.Admin.error')
@include('templates.Admin.flash_message')

{{-- Button Show Create --}}
<div class="d-flex justify-content-end">
    <button class="btn btn-primary my-3" id="btnAdd"><i class="fas fa-plus" id="iconBtnAdd"></i></button>
</div>
{{-- End Button Show Create --}}

{{-- Create Category --}}
<div class="mb-4 NoDisp" id="layoutCreate">
    <div class="border border-secondary rounded ">
        <div class="d-flex justify-content-between mt-3 px-2">
            <h3 class="text-uppercase text-primary">create Category</h3>
            <button id="btnReset" class="btn btn-sm btn-warning text-uppercase">Reset</button>
        </div>
        <hr width="96%">
        <form action="{{ route('category.store') }}" id="txtFormCreate" method="post" class="p-2">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Category</label>
                </div>

                <select class="custom-select" name="parent_id">
                    <option value="0">New Parent Category</option>
                    @foreach ($categories as $category)
                    @if (empty($category->parent_id))
                    <option value="{{ $category->id }}">---{{ $category->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&nbsp;&nbsp;Name:&nbsp;&nbsp;</span>
                </div>
                <input class="form-control" type="text" id="txtName" name="name" value="{{ old('name') }}" placeholder="Insert Name Category Here"
                    required>
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
                                Do you want to <span class="text-success text-uppercase">add</span> new Category?
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
{{-- End Create Category --}}

{{-- Table Category --}}
@foreach ($categories as $category)
@if (empty($category->parent_id))
@if (empty($category->subcategories_count))
<div class="d-flex">
    <h5 class="font-weight-bold mr-5">Category: <span class="text-capitalize text-success font-weight-normal">{{
            $category->name
            }}</span></h5>
    <form action="{{ route('category.destroy',$category->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="button" class="btn btn-sm btn-danger text-uppercase" data-toggle="modal" data-target="#delConfirm{{ $category->id }}">
            Delete
        </button>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="delConfirm{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                        category?
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
</div>
@else
<h5 class="font-weight-bold">Category: <span class="text-capitalize text-success font-weight-normal">{{ $category->name}}</span></h5>
@endif
@if ($category->subcategories_count)
<table class="table table-sm table-bordered table-hover table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">Category Name</th>
            <th scope="col">Total Products</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $subcategory)
        @if ($subcategory->parent_id==$category->id)
        <tr class="text-center">
            {{-- <th scope="row">{{ $subcategory->firstItem()+$key }}</th> --}}
            <td><a href="{{ asset('admin/category\/').$subcategory->id }}" class="No--UdLine">{{ $subcategory->name }}</a></td>
            <td>{{ $subcategory->products_count }}</td>
            <td class="d-flex justify-content-around align-items-center">
                <form action="{{ route('category.show',$subcategory->id) }}" method="get"><button class="btn btn-sm btn-warning text-uppercase">Edit</button>
                </form>

                <form action="{{ route('category.destroy',$subcategory->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-sm btn-danger text-uppercase" data-toggle="modal" data-target="#delConfirm{{ $subcategory->id }}">
                        Delete
                    </button>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="delConfirm{{ $subcategory->id }}" tabindex="-1" role="dialog"
                        aria-hidden="true">
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
                                    category?
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
    </tbody>
    @endif
    @endforeach
</table>
@endif
@endif
@endforeach
{{-- End Table category --}}
@endsection