@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Variant</h1>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Variants</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.variant.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New</a>
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
@endpush


