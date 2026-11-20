
@extends('templates.layoutApp')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/css/tabulator_bootstrap5.min.css"
    crossorigin="anonymous" />
@endpush

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Starter Page</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Starter Page
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header">
                        <!-- Button Product & Search -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 w-100">
                            <!-- Button Product -->
                            <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#createProductModal">

                                <i class="bi bi-plus-circle me-1" aria-hidden="true"></i>
                                PRODUCT
                            </button>

                            <!-- Search Input -->
                            <div class="input-group" style="width: 250px; max-width: 100%;">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input
                                    type="text"
                                    id="table-filter"
                                    class="form-control"
                                    placeholder="Filter rows..."
                                >
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <!-- Export Buttons -->
                        <div class="d-flex gap-2 mb-3">
                            <button id="export-csv" type="button"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-filetype-csv me-1" aria-hidden="true"></i>
                                Export CSV
                            </button>
                            <button id="export-json" type="button"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-filetype-json me-1" aria-hidden="true"></i>
                                Export JSON
                            </button>
                            <button id="print-table" type="button"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-printer me-1" aria-hidden="true"></i>
                                Print
                            </button>
                        </div>

                        <!-- Product Table -->
                        <div id="product-table" aria-label="product-table"></div>

                        <!-- Pagination -->
                        <div
                            id="table-pagination"
                            class="d-flex flex-wrap gap-2 justify-content-end mt-2">
                        </div>
                    </div>

                    <div class="card-body">
                        Start creating your amazing application!
                    </div>
                    <div class="card-footer">
                        The footer of the card
                    </div>
                </div>

                <!--end::Card-->
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->
@endsection

@section('modal')
    @include('products.modal')
@endsection

@push('script')

<script
    src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/js/tabulator.min.js"
    crossorigin="anonymous">
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const table = new Tabulator('#product-table', {

            ajaxURL: "{{ route('products.api') }}",

            layout: 'fitColumns',

            filterMode: 'local',

            pagination: true,
            paginationMode: 'local',

            paginationElement: document.getElementById('table-pagination'),

            paginationSize: 10,

            paginationSizeSelector: [10, 25, 50, 100],

            movableColumns: true,

            columns: [
                {
                    title: 'ID',
                    field: 'id',
                    width: 80,
                    headerSort: true
                },
                {
                    title: 'Product Name',
                    field: 'name'
                },
                {
                    title: 'Price',
                    field: 'price'
                },
                {
                    title: 'Stock',
                    field: 'stock',
                    width: 120
                },
                {
                    title: 'Aksi',
                    field: 'id',

                    formatter: function(cell) {

                        var id = cell.getValue();

                        var editUrl = "{{ url('products') }}/" + id + "/edit";

                        return `
                            <a href="${editUrl}" class="btn btn-success">Edit</a>

                            <button onclick="deleteProduct(${id})"
                                class="btn btn-danger">
                                Hapus
                            </button>
                        `;
                    },

                    headerSort: false,

                    width: 200,

                    hozAlign: 'center'
                }
            ]
        });

        // Table Built
        table.on('tableBuilt', () => {

            const grid = document.getElementById('product-table');

            grid.removeAttribute('aria-owns');

            grid.querySelector('.tabulator-tableholder')
                .setAttribute('role', 'rowgroup');

            grid.querySelector('.tabulator-table')
                .setAttribute('role', 'presentation');
        });

        // Pagination Styling
        table.on('renderComplete', () => {

            document.querySelectorAll('#table-pagination button')
                .forEach((button) => {

                    button.classList.add(
                        'btn',
                        'btn-sm',
                        'btn-outline-secondary'
                    );
                });
        });

        // Search Filter
        document.getElementById('table-filter')
            .addEventListener('input', (e) => {

                const value = e.target.value;

                if (value) {

                    table.setFilter([
                        {
                            field: 'name',
                            type: 'like',
                            value: value
                        }
                    ]);

                } else {

                    table.clearFilter();

                }
            });

        // Export CSV
        document.getElementById('export-csv')
            .addEventListener('click', () => {
                table.download('csv', 'products.csv');
            });

        // Export JSON
        document.getElementById('export-json')
            .addEventListener('click', () => {
                table.download('json', 'products.json');
            });

        // Print Table
        document.getElementById('print-table')
            .addEventListener('click', () => {
                table.print(false, true);
            });

    });
</script>

@endpush
