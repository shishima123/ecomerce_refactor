@extends('templates.Admin.master')
@section('title','Admin Page - Management Order')
@section('header','orders management')
@section('content')
@include('templates.Admin.flash_message')

{{-- Status Order --}}
<p class="text-uppercase font-weight-bold">{{ $type or 'all' }} orders</p>
<hr>
<div class="d-flex">
    <h5 class="m-0 pt-1 text-uppercase">filter:</h5>
    <a href="{{ route('order.sortBy','all') }}"><button class="btn btn-sm btn-primary mx-2">All</button></a>
    <a href="{{ route('order.sortBy','pending') }}"><button class="btn btn-sm btn-warning mx-2">Pending</button></a>
    <a href="{{ route('order.sortBy','complete') }}"><button class="btn btn-sm btn-success mx-2">Compelete</button></a>
</div>
{{-- End Status Order --}}

{{-- Table Order --}}
<table class="table table-sm table-bordered table-hover mt-3 table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">User Order</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Detail</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key=>$order)
        <tr class="text-center">
            <th scope="row">{{ $orders->firstItem()+$key }}</th>
            <td><a href="{{ route('order.show',$order->id) }}" class="No--UdLine">{{ $order->user->name }}</a></td>
            <td>{{ number_format($order->total,0,',','.').' $' }}</td>
            <td>
                @if ($order->status)
                <h4><span class="badge badge-success">Completed</span></h4>
                @else
                <h4><span class="badge badge-warning">Pending</span></h4>
                @endif
            </td>
            <td>
                <form action="{{ route('order.show',$order->id) }}" method="get">
                    <button class="btn btn-primary text-uppercase">Show</button>
                </form>
            </td>
            <td class="d-flex justify-content-center h-100">
                @if ($order->status)
                <button type="button" class="btn btn-secondary text-uppercase mx-2" disabled>
                    Approve
                </button>
                <button type="button" class="btn btn-secondary text-uppercase mx-2" disabled>
                    Cancel
                </button>
                @else
                <form action="{{ route('order.edit',$order->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <button type="button" class="btn btn-success text-uppercase mx-2" data-toggle="modal" data-target="#approveConfirm{{ $order->id }}">
                        Approve
                    </button>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="approveConfirm{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Alert!!!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you want to <span class="text-success text-uppercase">accpet</span> this order?
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
                <form action="{{ route('order.destroy',$order->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-danger text-uppercase mx-2" data-toggle="modal" data-target="#cancelConfirm{{ $order->id }}">
                        Cancel
                    </button>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="cancelConfirm{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- End Table Order --}}

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{ $orders->url(1) }}" rel="prev">«</a></li>

        @for ($i=1;$i<=$orders->lastPage();$i++)
            <li class="page-item @if ($orders->currentPage()===$i) {{ 'active' }} @endif)">
                <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a></li>
            @endfor

            <li class="page-item"><a class="page-link" href="{{ $orders->url($orders->lastPage()) }}" rel="next">»</a></li>
    </ul>
</div>
{{-- End Pagination --}}
@endsection