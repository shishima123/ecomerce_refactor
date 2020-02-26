@extends('templates.Admin.master')
@section('title','Admin Page - Management Order')
@section('header','orders management')
@section('content')
<h4 class="text-capitalize text-success">
    Code order: <span class="text-primary">#{{ $order->code_order }}</span></h4>
{{-- Table Order --}}
<table class="table table-sm table-bordered table-hover mt-3">
    <thead>
        <tr class="text-center">
            @if ($order->order_name)
            <th scope="col">Guest Name</th>
            <th scope="col">Guest Adress</th>
            <th scope="col">Guest Phone</th>
            @else
            <th scope="col">User Name</th>
            <th scope="col">User Adress</th>
            <th scope="col">User Phone</th>
            @endif
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            @if ($order->order_name)
            <td>{{ $order->order_name }}</td>
            <td>{{ $order->order_address }}</td>
            <td>{{ $order->order_phone }}</td>
            @else
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->user->address }}</td>
            <td>{{ $order->user->phone }}</td>
            @endif
            <td>{{ number_format($order->total,0,',','.').' $' }}</td>
            <td>
                @if ($order->status)
                <h4><span class="badge badge-success">Completed</span></h4>
                @else
                <h4><span class="badge badge-warning">Pending</span></h4>
                @endif
            </td>
            <td class="d-flex justify-content-center h-100">
                @if ($order->status)
                <button type="button" class="btn btn-success text-uppercase mx-2" disabled>Approve</button>
                <button type="button" class="btn btn-secondary text-uppercase mx-2" disabled>Cancel</button>
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
    </tbody>
</table>
{{-- End Table Order --}}

{{-- list item --}}
<h6 class="text-capitalize text-pink">List Items</h6>

<table class="table table-sm border text-center table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Picture</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;?>
        @foreach ($order->products as $item)
        <tr>
            <th>{{ $i++ }}</th>
            <td scope="col">{{ $item->name }}</td>
            <td scope="col"><img style="height:50px;width:50px;" src="{{asset($item->picture) }}" alt="product"></td>
            <td scope="col">{{ $item->price }}</td>
            <td scope="col">x{{ $item->pivot->quantity }}</td>
            <td scope="col">{{ $item->pivot->total }}</td>
        </tr>
        @endforeach
        <tr>
            <td class="border-0" colspan="4"></td>
            <td class="font-weight-bold">Sumary:</td>
            <td>{{ $order->total }}$</td>
        </tr>
    </tbody>
    {{-- end list item --}}
    @endsection