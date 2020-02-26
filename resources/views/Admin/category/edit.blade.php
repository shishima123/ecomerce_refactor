@extends('templates.Admin.master')
@section('title','Admin Page - Management Category')
@section('header','Categories management')
@section('content')
@include('templates.Admin.error')

{{-- Create Category --}}
<div class="mb-4" id="layoutCreate">
    <div class="border border-secondary rounded ">
        <div class="d-flex justify-content-between mt-3 px-2">
            <h3 class="text-uppercase text-primary">Edit Category</h3>
            <button id="btnReset" class="btn btn-sm btn-warning text-uppercase">Reset</button>
        </div>
        <hr width="96%">
        <form action="{{ route('category.update',$category->id) }}" id="txtFormCreate" method="post" class="p-2" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Category</label>
                </div>

                <select class="custom-select" name="parent_id">
                    @foreach ($categories as $item)
                    @if ($category->parent_id===$item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&nbsp;&nbsp;Name:&nbsp;&nbsp;</span>
                </div>
                <input class="form-control" type="text" id="txtName" name="name" value="{{$category->name}}" required>
            </div>

            <div class="mb-3 text-center">
                <img src="{{ asset($category->picture) }}" alt="category picture" class="mx-auto border border-info shadow Avatar--Height">
                <h6 class="mt-4">Upload a different photo</h6>
                <input type="file" value="{{ old('categoryImage') }}" name="categoryImage" id='categoryImage' />
            </div>

            <hr width="96%">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-success text-uppercase" data-toggle="modal" data-target="#updateConfirm">
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
                                Do you want to <span class="text-success text-uppercase">edit</span> this Category?
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

@endsection