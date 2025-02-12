@extends('layouts.template')
@section('content')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $surat->perihal }}</title>
    <style>
        table {
            font-family: "Times New Roman", Times, serif;
            margin: 20px;
            line-height: 15px;
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 4px 3px;
        }

        th {
            text-align: left;
        }

        tr {}

        .d-block {
            display: block;
        }

        img.image {
            /* width: auto; */
            height: 80px;
            max-width: 400px;
            max-height: 250px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .p-1 {
            padding: 5px 1px 5px 1px;
        }

        .font-10 {
            font-size: 10pt;
        }

        .font-11 {
            font-size: 11pt;
        }

        .font-12 {
            font-size: 12pt;
        }

        .font-13 {
            font-size: 13pt;
        }

        .border-bottom-header {
            border-bottom: 1px solid;
            max-width: 97%;
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }
    </style>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="row">

        <div class="col-md-3">

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
                            <a href="{{ url('/') }}" class="nav-link">
                                <i class="fas fa-inbox"></i> Inbox
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/outbox') }}" class="nav-link">
                                <i class="far fa-envelope"></i> Sent
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Read Mail</h3>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-default"
                            onclick="modalAction('{{ url('/surat/' . $surat->surat_id . '/forward') }}')"><i
                                class="fas fa-share"></i> Forward</button>
                        <a href="{{ url('/surat/' . $surat->surat_id . '/export') }}" type="button"
                            class="btn btn-default"><i class="fas fa-download"></i> Download</a>
                        <button type="button" class="btn btn-default"
                            onclick="modalAction('{{ url('/inbox/' . $inbox->inbox_id . '/delete') }}')"><i
                                class="far fa-trash-alt"></i> Delete</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="border-bottom-header">
                        <tr>
                            <td width="15%" class="text-center"><img src="{{ asset('asset/jasatirta.png') }}"
                                    style="height: 80px; width:80px"></td>
                            <td width="85%">
                                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN
                                    PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                                <span class="text-center d-block font-13 font-bold mb-1">PERUM JASA TIRTA 1</span>
                                <span class="text-center d-block font-10">Jl. Surabaya Dalam, Sumbersari, Kec. Lowokwaru,
                                    Kota Malang, Jawa Timur 65115</span>
                                <span class="text-center d-block font-10">Telepon (0341) 551971</span>
                                <span class="text-center d-block font-10">Laman: https://jasatirta1.co.id/</span>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tbody id="table-body">
                            <tr>
                                <td>Tanggal</td>
                                <td>: {{ $surat->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Pengirim</td>
                                @foreach ($user as $item)
                                    @if ($surat->pengirim == $item->user_id)
                                        <td>: {{ $item->name }} / {{ $item->email }}</td>
                                    @endif
                                @endforeach

                            </tr>
                            <tr>
                                <td>Kepada</td>
                                @foreach ($user as $item)
                                    @if ($surat->kepada == $item->user_id)
                                        <td>: {{ $item->name }} / {{ $item->email }}</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>: {{ $surat->perihal }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                    </p>
                    <pre style='white-space: pre-wrap; word-break: keep-all;'>
                    {{ $surat->isi_surat }}
                </pre>

                    <footer>
                        <table>
                            <tr>
                                <td>Tembusan:</td>
                                @foreach ($user as $item)
                                    @if ($surat->tembusan == $item->user_id)
                                        <td>{{ $item->name }} / {{ $item->email }}</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>Pemeriksa:</td>
                                @foreach ($user as $item)
                                    @if ($surat->pemeriksa == $item->user_id)
                                        <td>{{ $item->name }} / {{ $item->email }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                    </footer>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                @if ($surat->lampiran == null)
            </div>
            <!-- /.card -->
        </div>
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
    </script>
@endpush
@else
<!-- /.card-footer -->
<div class="card-footer">
    <div class="card-footer bg-white">
        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
            <li>
                <div class="mailbox-attachment-info">
                    <label class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>
                        Lampiran</label>
                    <a href="{{ asset($surat->lampiran) }}" class="btn btn-default btn-sm float-right" download><i
                            class="fas fa-cloud-download-alt"></i></a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /.card-footer -->
</div>
<!-- /.card -->
</div>
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
</script>
@endpush
@endif
