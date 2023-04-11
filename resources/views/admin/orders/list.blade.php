@extends('admin.layouts.master')
@section('title')
    Customer Order Details - {{ env('APP_NAME') }}
@endsection
@push('styles')
<style>
    .dataTables_filter{
        margin-bottom: 10px !important;
    }
</style>
@endpush

@section('content')
    @php
        use App\Models\User;
    @endphp
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Customer Orders</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">Orders List</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-0">Orders Details</h4>
                            </div>

                        </div>
                    </div>

                    <hr />
                    <div class="table-responsive">
                        <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Order No(#)</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Phone</th>
                                    <th>Order Date</th>
                                    <th>Total Price($)</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer->email }}</td>
                                        <td>{{ $order->customer->phone }}</td>
                                        <td>{{ date('d M, Y', strtotime($order->created_at)) }}</td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>
                                            @if ($order->order_status == 'Order Confirmed')
                                                <span class="badge bg-success-light">Order Confirmed</span>
                                            @elseif($order->order_status == 'Cancelled')
                                                <span class="badge bg-danger-light">Order Cancelled</span>
                                            @elseif($order->order_status == 'Out For Delivery')
                                                <span class="badge bg-info-light">Out For Delivery</span>
                                            @elseif($order->order_status == 'Delivered')
                                                <span class="badge bg-warning-light">Order Delivered</span>
                                            @endif


                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit-designation" data-id="{{ $order['id'] }}"
                                                        href="{{ route('orders.show', $order->id) }}"
                                                        data-bs-target="#edit_designation"><i class="fa fa-eye m-r-5"></i>
                                                        View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //Default data table
            $('#myTable').DataTable({
                "aaSorting": [],
                "columnDefs": [{
                        "orderable": false,
                        "targets": [7]
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1, 2, 3, 4, 5, 6]
                    }
                ]
            });

        });
    </script>
   
@endpush
