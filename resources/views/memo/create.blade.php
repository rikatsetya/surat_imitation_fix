<form id="form-tambah" enctype="multipart/form-data" method="POST" action="{{ url('/memo/store') }}">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make a Memo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>To</label>
                    <select name="kepada" id="kepada" class="form-control" required>
                        <option value="">- Choose User -</option>
                        @foreach ($user as $l)
                            <option value="{{ $l->user_id }}">{{ $l->name }}</option>
                        @endforeach
                    </select>
                    <small id="error-kepada" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>CC</label>
                    <select name="tembusan" id="tembusan" class="form-control">
                        <option value="">- Choose User -</option>
                        @foreach ($user as $l)
                            <option value="{{ $l->user_id }}">{{ $l->name }}</option>
                        @endforeach
                    </select>
                    <small id="error-tembusan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Sender</label>
                    <select name="pengirim" id="pengirim" class="form-control" required readonly>
                        @foreach ($user as $l)
                            @if ($l->user_id == session('user_id'))
                                <option value="{{ $l->user_id }}">{{ $l->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <small id="error-pengirim" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Examiner</label>
                    <select name="pemeriksa" id="pemeriksa" class="form-control">
                        <option value="">- Choose User -</option>
                        @foreach ($user as $l)
                            <option value="{{ $l->user_id }}">{{ $l->name }}</option>
                        @endforeach
                    </select>
                    <small id="error-pemeriksa" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="perihal" id="perihal" class="form-control" required>
                    <small id="error-perihal" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Compose Memo</label>
                    <textarea type="text" name="isi_surat" id="isi_surat" class="form-control" required rows="4" cols="50"></textarea>
                    <small id="error-isi_surat" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Attachment</label>
                    <input type="file" name="lampiran" id="lampiran" class="form-control"
                        accept=".pdf,.xlsx,.png,.jpg,.jpeg">
                    <small id="error-lampiran" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Batal</button>
                <button type="submit" class="btn btn-warning" id="btn-save">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                kepada: {
                    required: true,
                    number:true,
                },
                tembusan: {
                    required: false,
                    number:true,
                },
                pengirim: {
                    required: true,
                    number:true,
                },
                pemeriksa: {
                    required: false,
                    number:true,
                },
                perihal: {
                    required: true,
                    minlength:5
                },
                isi_surat: {
                    required: true,
                    minlength: 30
                },
                lampiran: {
                    required: false,
                    accept:"pdf,xlsx,png,jpg,jpeg"
                },
            },
            submitHandler: function(form) {
                var formData = new FormData(
                    form);
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false, // setting processData dan contentType ke false, untuk menghandle file 
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            tableMemo.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
