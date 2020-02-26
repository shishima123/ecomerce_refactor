@extends('templates.Admin.master')
@section('title','Admin Page - Management comment')
@section('header','comment management')
@section('content')
@include('templates.Admin.flash_message')

{{-- Table Order --}}
<table class="table table-sm table-bordered table-hover mt-3 table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col" colspan="3">Comment</th>
        </tr>
        <tr class="text-center">
            <td class="text-truncate" colspan="3">{{ $comment->content }}</td>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <th scope="col">User</th>
            <th scope="col">Product</th>
            <th scope="col">Action</th>
        </tr>
        <tr class="text-center">
            <td>{{ $comment->user->name }}</td>
            <td>{{ $comment->product->name }}</td>
            <td class="d-flex justify-content-center h-100">
                <form action="{{ route('comment.update',$comment->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <button type="button" class="btn btn-danger text-uppercase mx-2" data-toggle="modal" data-target="#deleteConfirm{{ $comment->id }}">
                        Delete
                    </button>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="deleteConfirm{{ $comment->id }}" tabindex="-1" role="dialog"
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
                                    Do you want to <span class="text-danger text-uppercase">cancel </span>this order?
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
</table>
{{-- End Table Order --}}

@endsection