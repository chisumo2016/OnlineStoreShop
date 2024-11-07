@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Categories</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Rendering with DATATABLE  -->
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function () {
            $('body').on('click', '.change-status' ,function () {
                    /*Check if our  toggle button is checked  on/off*/
                    let  isChecked = $(this).is(':checked');
                        //console.log(isChecked)
                    /*Grab the dynamic id*/
                    let id = $(this).data('id');
                        //console.log(id)
                    /*send ajax request*/
                    $.ajax({
                        url:"{{ route('admin.category.change-status') }}",
                    method:'PUT',
                    data:{
                        status : isChecked,
                        id:id
                    },
                    success: function (data) {
                        /*Show  the success message from front end*/
                        toastr.success(data.message)
                        console.log(data)
                    },
                    error:function (xhr, status, error) {
                        console.log(error)
                    }
                })
            })
        })
    </script>
@endpush


