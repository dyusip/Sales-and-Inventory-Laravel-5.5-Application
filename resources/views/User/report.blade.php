@extends('layout.app'){{--layout--}}
@section('content');
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
        @include('layout.header'){{--header navigation--}}
        <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-1">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h2 class="text-white font-weight-bold my-2 mr-5">Sales Report</h2>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <div class="d-flex align-items-center font-weight-bold my-2">
                                    <!--begin::Item-->
                                    <a href="#" class="opacity-75 hover-opacity-100">
                                        <i class="flaticon2-shelter text-white icon-1x"></i>
                                    </a>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Dashboard</a>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Sales Report</a>
                                    <!--end::Item-->
                                </div>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        {{--sales form--}}

                            <div class="row">
                                <div class="col-md-12">
                                    <!--begin::Card-->
                                    <div class="card card-custom gutter-b example example-compact">
                                        <div class="card-header">
                                            <h3 class="card-title">View Sales Report</h3>
                                        </div>
                                        <!--begin::Form-->
                                        <div class="card-body">
                                            <form action="/report" method="post" id="myform">
                                                {{ csrf_field() }}
                                                <div class="form-group row">
                                                    <label class="col-form-label text-right col-lg-3 col-sm-12">Date Picker</label>
                                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                                        <div class="input-daterange input-group" id="kt_datepicker_5">
                                                            <input required value="{{ (isset($request->start))?$request->start:date('m/d/Y') }}" type="text" class="form-control" name="start" />
                                                            <div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-ellipsis-h"></i>
															</span>
                                                            </div>
                                                            <input required value="{{ (isset($request->end))?$request->end:date('m/d/Y') }}" type="text" class="form-control" name="end" />
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" type="submit">Go!</button>
                                                            </div>
                                                        </div>
                                                        <span class="form-text text-muted">Select date range of sales</span>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="separator separator-dashed my-12"></div>
                                            <!--begin: Datatable-->
                                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                                <thead>
                                                <tr>
                                                    <th width="10%">Order #</th>
                                                    <th>Date</th>
                                                    <th width="10%">Code</th>
                                                    <th width="25%">Name</th>
                                                    <th>OS</th>
                                                    <th width="10%">Qty</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($reports))
                                                    @php $total = 0 @endphp
                                                    @foreach($reports as $report)
                                                        <tr>
                                                            <td>{{$report->sh_no}}</td>
                                                            <td>{{$report->date}}</td>
                                                            <td>{{$report->prod_code}}</td>
                                                            <td>{{$report->prod_name}}</td>
                                                            <td>{{$report->prod_os}}</td>
                                                            <td>{{$report->prod_qty}}</td>
                                                            <td>{{$report->prod_price}}</td>
                                                            <td>{{$report->prod_total}}</td>
                                                        </tr>
                                                        @php $total += $report->prod_total; @endphp
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                            <div class="form-group row">
                                                <div class="col-lg-4 offset-8">
                                                    <label>Total Amount</label>
                                                    <input type="text" readonly class="form-control form-control-solid" value="{{@$total}}" name="totalAmount" id="totalAmount" placeholder="Total Amount">
                                                </div>
                                            </div>
                                            <!--end: Datatable-->
                                        </div>
                                    </div>
                                    <!--end::Card-->
                                </div>
                                {{--end col--}}
                            </div>
                            {{--end row--}}
                        {{--endform--}}
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
        @include('layout.footer')
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
@endsection
@push('styles')
    {{--<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />

@endpush
@push('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.5')}}"></script>
    <script>
        //initialize scripts
        $(document).ready(function () {

        });
        //datatables
        $('#kt_datatable').DataTable({
            responsive: true,
            paging: true,
            sort: false,
        });
    </script>
@endpush
