<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }

        table {
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

        .d-block {
            display: block;
        }

        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
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
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }
    </style>
</head>

<body>
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
        <pre style='white-space: pre-wrap; word-break: keep-all;'>
        </pre>
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
        <pre style='white-space: pre-wrap; word-break: keep-all;'>
        </pre>
        <p>
            {{ $surat->isi_surat }}
        </p>
        <pre style='white-space: pre-wrap; word-break: keep-all;'>
        </pre>


        <table>
            <tr>
                <td>Tembusan</td>
                @foreach ($user as $item)
                    @if ($surat->tembusan == $item->user_id)
                        <td>: {{ $item->name }} / {{ $item->email }}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <td>Pemeriksa</td>
                @foreach ($user as $item)
                    @if ($surat->pemeriksa == $item->user_id)
                        <td>: {{ $item->name }} / {{ $item->email }}</td>
                    @endif
                @endforeach
            </tr>
        </table>

        <!-- /.mailbox-read-message -->
    </div>
</body>

</html>
