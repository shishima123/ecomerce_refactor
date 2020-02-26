@extends('templates.Admin.master')
@section('title','Admin Page - Management comment')
@section('header','comment management')
@section('content')
@include('templates.Admin.flash_message')

{{-- Table Order --}}
<table class="table table-sm table-bordered table-hover mt-3 table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Comment</th>
            <th scope="col">User</th>
            <th scope="col">Product</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $key=>$comment)
        <tr class="text-center">
            <th scope="row">{{ $comments->firstItem()+$key }}</th>
            <td class="text-truncate" style="max-width: 150px;">{{ $comment->content }}</td>
            <td>{{ $comment->user->name }}</td>
            <td>{{ $comment->product->name }}</td>
            <td class="d-flex justify-content-center h-100">
                <form action="{{ route('comment.show',$comment->id) }}" method="get">
                    <button class="btn btn-primary">Show</button>
                </form>
                <form action="{{ route('comment.update',$comment->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <button type="button" class="btn btn-danger text-uppercase mx-2" data-toggle="modal" data-target="#deleteConfirm{{ $comment->id }}">
                        Delete
                    </button>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="deleteConfirm{{ $comment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
        @endforeach
    </tbody>
</table>
{{-- End Table Order --}}

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{ $comments->url(1) }}" rel="prev">«</a></li>

        @for ($i=1;$i<=$comments->lastPage();$i++)
            <li class="page-item @if ($comments->currentPage()===$i) {{ 'active' }} @endif)">
                <a class="page-link" href="{{ $comments->url($i) }}">{{ $i }}</a></li>
            @endfor

            <li class="page-item"><a class="page-link" href="{{ $comments->url($comments->lastPage()) }}" rel="next">»</a></li>
    </ul>
</div>
{{-- End Pagination --}}
@endsection