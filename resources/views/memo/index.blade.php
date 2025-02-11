@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="row">
        <div class="col-md-3">
            <button onclick="modalAction('{{ url('/memo/create') }}')"
                class="btn btn-primary btn-block mb-3">Compose</button>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Folders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ url('/memo')}}" class="nav-link {{ $activeSubMenu == 'inbox' ? 'active' : '' }} ">
                                <i class="fas fa-inbox"></i> Created
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Created</h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="card-body table-responsive mailbox-messages">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-hover table-sm" id="memo-table">
                            <thead>
                                <tr>
                                    <th>To</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Attachment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">
                    
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var tableMemo;
        $(document).ready(function() {
            tableMemo = $('#memo-table').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('memo/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                    data: "name",
                    className: "",
                    width: "25%",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data.length > 10 ?
                            data.substr(0, 10) + '...' :
                            data;
                    }
                }, {
                    data: "perihal",
                    className: "",
                    width: "20%",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data.length > 20 ?
                            data.substr(0, 20) + '...' :
                            data;
                    }
                }, {
                    data: "created_at",
                    className: "",
                    width: "14%",
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        if (!data) return ""; // Handle empty values

                        return moment(data).format('DD/MM/YYYY'); // Format with Moment.js
                    }
                }, {
                    data: "lampiran",
                    className: "",
                    width: "10%",
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data ?
                            `<i class="fas fa-paperclip"></i>` :
                            'None';
                    }
                }, {
                    data: "aksi",
                    className: "text-center",
                    width: "14%",
                    orderable: false,
                    searchable: false
                }]
            });

            $('#memo_refresh').click(function refreshData() {
                tableMemo.ajax.reload();
            });

            $('#memo-table_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { // enter key
                    tableMemo.search(this.value).draw();
                }
            });
        });
    </script>
@endpush
