@extends('base.header')
@section('body')
    <div class="card vh-100">
        <div class="card-header">
            <h3 class="card-title text-center text-white">My Todo List</h3>
        </div>
        <div class="card-body">
            <ul class="list-group ">
                {{-- <li class="list-group-item">Todo 1</li>
                <li class="list-group-item">Todo 2</li>
                <li class="list-group-item">Todo 3</li> --}}
            </ul>
        </div>
    </div>

    <div class="floating-btn">
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Todo List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="input here">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="input here">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea type="text" class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="input here"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    
        //tambah data
        $(document).ready(function() {
            var formTambah = $('#formTambah');
    
            formTambah.on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var inputTanggal = $('#tanggal').val();
                var inputNama = $('#judul').val();
                var inputDeskripsi = $('#deskripsi').val();
    
                if (inputTanggal == '' || inputNama == '' || inputDeskripsi == '') {
                    Swal.fire({
                        title: "Error",
                        text: "Pastikan mengisi semua form",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonText: "OK"
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('tambahData.todolist') }}",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: "Success",
                                text: "Data berhasil ditambahkan",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK"
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(data) {
                            var errors = data.responseJSON.errors;
                            var errorMessage = "";
    
                            $.each(errors, function(key, value) {
                                errorMessage += value + "<br>";
                            });
    
                            Swal.fire({
                                title: "Error",
                                html: errorMessage,
                                icon: "error",
                                timer: 5000,
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });

    
    </script>
@endsection
