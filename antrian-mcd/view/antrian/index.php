<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../asset/style.css" alt="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <title>Data Antrian MCD</title>
</head>

<body>
    <div class="container">
        <div id="message">
        </div>
        <!-- navbar --><!-- navbar --><!-- navbar --><!-- navbar --><!-- navbar --><!-- navbar -->
        <nav class="navbar navbar-light">
            <div class="container nav">
                <a class="navbar-brand d-flex" href="#">
                    <h1 class="mc text-center"><img src="../../asset/img/logo.jpeg">
                        <div class="animated-text">
                            <span>M</span>
                            <span>C</span>
                            <span>d</span>
                            <span>o</span>
                            <span>n</span>
                            <span>a</span>
                            <span>l</span>
                            <span>s</span>
                        </div>
                    </h1>
                </a>
            </div>
        </nav>
        <div class="judul">
            <h1 class="mt-4 mb-4 text-center ">ANTRIAN KONSUMEN</h1>
        </div>

        <span id="message"></span>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-sm-9">
                        Data Kasir
                        <div class="mt-2">
                            <span id="current-time" class="text-muted"></span><br>
                            <span id="current-date" class="text-muted"></span>
                        </div>
                    </div>
                    <div class="col col-sm-3">
                        <button type="button" id="generate" class="btn btn-success btn-sm float-end mx-2">Kesimpulan</button>
                        <button type="button" id="add_data" class="btn btn-primary btn-sm float-end">Tambah</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="sample_data">
                        <thead>
                            <tr>
                                <th>Waktu Kedatangan</th>
                                <th>Selisih Kedatangan (menit)</th>
                                <th>Waktu Awal Pelayanan</th>
                                <th>Selisih Pelayanan Kasir(menit)</th>
                                <th>Waktu keluar</th>
                                <th>Selisih Keluar Antrian (menit)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="action_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="sample_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dynamic_modal_title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="hide"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Waktu Kedatangan</label>
                            <input type="time" name="waktu_datang" id="waktu_datang" class="form-control" />
                            <span id="waktu_kedatangan_error" class="text-danger"></span>
                        </div>

                        <div class="mb-3 " id="selisih_datang">
                            <label class="form-label">Selisih Kedatangan</label>
                            <input type="text" name="selisihkedatangan" id="selisihkedatangan" class="form-control" />
                            <span id="selisihkedatangan" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu Awal Pelayanan</label>
                            <input type="time" name="awal_pelayanan" id="awal_pelayanan" class="form-control" />
                            <span id="waktu_awal_pelayanan_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3" id="selisih_pelayanan">
                            <label class="form-label">Selisih_Pelayanan_Kasir</label>
                            <input type="text" name="selisihpelayanankasir" id="selisihpelayanankasir" class="form-control" />
                            <span id="selisih_pelayanan_kasir_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu keluar</label>
                            <input type="time" name="keluar" id="keluar" class="form-control" />
                            <span id="waktu_keluar_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3" id="selisih_keluar">
                            <label class="form-label">Selisih Keluar Antrian</label>
                            <input type="text" name="selisihkeluarantrian" id="selisihkeluarantrian" class="form-control" />
                            <span id="selisih_keluar_antrian_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="action" id="action" value="Add" />
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="action_button">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal mb-5 mt-5" tabindex="-1" id="generate_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dynamic_modal_title_generate"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> MCD melakukan percobaan awal waktu pelayanan
                        <b id="waktu_kedatangan_modal"></b>
                        Maka dari data yang telah dikumpulkan dapat disimpulkan sebagai berikut:
                    <ul>
                        <li id="tingkat_kesibukan"></li>
                        <li id="waktu_kedatangan"></li>
                        <li id="SK"></li>
                        <li id="SKA"></li>
                        <li id="transaksi_min"></li>
                        <li id="transaksi_max"></li>
                    </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>



    <!-- <footer class="site-footer fixed-bottom">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="logo.png" alt="Logo">
                    <h1>Bucketman.corp</h1>
                </div>
                <div class="footer-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="https://www.instagram.com/bucket_.man?igsh=OGQ5ZDc2ODk2ZA==" target="_blank">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <a href="https://www.instagram.com/bucket_.man?igsh=OGQ5ZDc2ODk2ZA==" target="_blank"><img src="../../asset/img/ig.jpeg" alt="Instagram"> Instagram</a>
                </div>
            </div>
        </div>
    </footer> -->
    <script>
        $(document).ready(function() {
            showAll();

            $('#add_data').click(function() {
                $('#dynamic_modal_title').text('Tambah Data konsumen  MCD');
                $('#sample_form')[0].reset();
                $('#action').val('Add');
                $('#action_button').text('Simpan');
                $('.text-danger').text('');
                $('#selisih_datang').css('display', 'none');
                $('#selisih_pelayanan').css('display', 'none');
                $('#selisih_keluar').css('display', 'none');
                $('#action_modal').modal('show');

            });

            $('#generate').click(function() {
                $('#dynamic_modal_title_generate').text('Simpulan Simulasi Logika Fuzzy');
                $('.text-danger').text('');
                $('#generate_modal').modal('show');

                $.ajax({
                    type: "GET",
                    contentType: "application/json",
                    url: "http://localhost/antrian-mcd/api/operasi/generatekesimpulan.php",
                    success: function(response) {
                        if (response && response.waktu_datang !== undefined &&
                            response.selisihkedatangan !== undefined &&
                            response.selisihkeluarantrian !== undefined) {

                            // Fuzzy Logic Conclusion
                            var tingkat_kesibukan = response.tingkat_kesibukan;

                            // Update modal content based on fuzzy logic conclusion
                            $('#id').val(response.id);
                            $('#waktu_kedatangan_modal').text(response.waktu_datang + response.max_waktudatang);

                            // Update the modal content based on fuzzy logic conclusion

                            $('#tingkat_kesibukan').text('Tingkat Kesibukan: ' + tingkat_kesibukan);

                            // Display other information
                            $('#waktu_kedatangan').text('Rata-rata selisih kedatangan konsumen: ' + response.selisihkedatangan + " menit");
                            $('#SK').text('Rata-rata pelayanan dimulai dengan waktu: ' + response.selisihpelayanankasir + " menit");
                            $('#SKA').text('Rata-rata waktu konsumen keluar dilayani: ' + response.selisihkeluarantrian + " menit");
                            $('#transaksi_min').text('Waktu tercepat transaksi diselesaikan: ' + response.selisihminkeluarantrian + " menit");
                            $('#transaksi_max').text('Waktu terlama transaksi diselesaikan: ' + response.selisihmaxkeluarantrian + " menit");
                        } else {
                            console.error('Invalid or incomplete response:', response);
                            // Handle the case where the response is not as expected
                        }
                    },
                    error: function(err) {
                        console.error('An error occurred:', err);
                        // Display an error message to the user if needed
                    }
                });

                // $.ajax({
                //     type: "GET",
                //     contentType: "application/json",
                //     url: "http://localhost/antrian-mcd/api/operasi/generate-by-avg.php",
                //     success: function(response) {
                //         if (response && response.waktu_datang !== undefined &&
                //             response.selisihkedatangan !== undefined &&
                //             response.selisihkeluarantrian !== undefined) {

                //             // Update modal content based on fuzzy logic conclusion
                //             $('#id').val(response.id);
                //             $('#waktu_kedatangan_modal').text(response.waktu_datang + response
                //                 .max_waktu_datang);
                //             $('#waktu_kedatangan').text(
                //                 'Rata-rata selisih kedatangan konsumen: ' + response
                //                 .selisihkedatangan + " menit");
                //             $('#SK').text('Rata-rata pelayanan dimulai dengan waktu: ' +
                //                 response.selisihpelayanankasir + " menit");
                //             $('#SKA').text('Rata-rata waktu konsumen keluar dilayani: ' +
                //                 response.selisihkeluarantrian + " menit");
                //             $('#transaksi_min').text('Waktu tercepat transaksi diselesaikan: ' +
                //                 response.selisihminkeluarantrian + " menit");
                //             $('#transaksi_max').text('Waktu terlama transaksi diselesaikan: ' +
                //                 response.selisihmaxkeluarantrian + " menit");
                //         } else {
                //             console.error('Invalid or incomplete response:', response);
                //             // Handle the case where the response is not as expected
                //         }
                //     },
                //     error: function(err) {
                //         console.error('An error occurred:', err);
                //         // Display an error message to the user if needed
                //     }
            });
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();

            if ($('#action').val() == "Add") {
                var formData = {
                    'waktu_datang': $('#waktu_datang').val(),
                    // 'selisihkedatangan': $('#selisihkedatangan').val(),
                    'awal_pelayanan': $('#awal_pelayanan').val(),
                    // 'selisihpelayanankasir': $('#selisihpelayanankasir').val(),
                    'keluar': $('#keluar').val(),
                    // 'selisihkeluarantrian': $('#selisihkeluarantrian').val(),
                };


                $.ajax({
                    url: "http://localhost/antrian-mcd/api/operasi/create.php",
                    method: "POST",
                    data: JSON.stringify(formData),
                    success: function(data) {
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">' + data
                            .message + '</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else if ($('#action').val() == "Update") {
                var formData = {
                    'id': $('#id').val(),
                    'waktu_datang': $('#waktu_datang').val(),
                    'selisihkedatangan': $('#selisihkedatangan').val(),
                    'awal_pelayanan': $('#awal_pelayanan').val(),
                    'selisihpelayanankasir': $('#selisihpelayanankasir').val(),
                    'keluar': $('#keluar').val(),
                    'selisihkeluarantrian': $('#selisihkeluarantrian').val()
                }
                $.ajax({
                    url: "http://localhost/antrian-mcd/api/operasi/update.php",
                    method: "PUT",
                    data: JSON.stringify(formData),
                    success: function(data) {
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">' + data
                            .message + '</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

        });

        function showAll() {
            $.ajax({
                type: "GET",
                contentType: "application/json",
                url: "http://localhost/antrian-mcd/api/operasi/read.php",
                success: function(response) {
                    var json = response.body;

                    var dataSet = [];
                    for (var i = 0; i < json.length; i++) {
                        var sub_array = {
                            'waktu_datang': json[i].waktu_datang,
                            'selisihkedatangan': json[i].selisihkedatangan,
                            'awal_pelayanan': json[i].awal_pelayanan,
                            'selisihpelayanankasir': json[i].selisihpelayanankasir,
                            'keluar': json[i].keluar,
                            'selisihkeluarantrian': json[i].selisihkeluarantrian,
                            'action': '<div class="btn-group" role="group">' +
                                '<button onclick="showOne(' + json[i].id +
                                ')" class="btn btn-sm btn-warning">Edit</button>' +
                                '<button onclick="deleteOne(' + json[i].id +
                                ')" class="btn btn-sm btn-danger">Delete</button>' +
                                '</div>'

                        };
                        dataSet.push(sub_array);
                    }

                    $('#sample_data').DataTable({
                        data: dataSet,
                        columns: [{
                                data: "waktu_datang"
                            },
                            {
                                data: "selisihkedatangan"
                            },
                            {
                                data: "awal_pelayanan"
                            },
                            {
                                data: "selisihpelayanankasir"
                            },
                            {
                                data: "keluar"
                            },
                            {
                                data: "selisihkeluarantrian"
                            },
                            {
                                data: "action"
                            }
                        ]
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function showOne(id) {
            $('#dynamic_modal_title').text('Edit Data');

            $('#sample_form')[0].reset();

            $('#action').val('Update');

            $('#action_button').text('Update');

            $('.text-danger').text('');

            $('#action_modal').modal('show');

            $('#selisih_datang').css('display', 'block');

            $('#selisih_pelayanan').css('display', 'block');

            $('#selisih_keluar').css('display', 'block');

            $.ajax({
                type: "GET",
                contentType: "application/json",
                url: "http://localhost/antrian-mcd/api/operasi/read.php?id=" + id,
                success: function(response) {
                    $('#id').val(response.id);
                    $('#waktu_datang').val(response.waktu_datang);
                    $('#selisihkedatangan').val(response.selisihkedatangan);
                    $('#awal_pelayanan').val(response.awal_pelayanan);
                    $('#selisihpelayanankasir').val(response.selisihpelayanankasir);
                    $('#keluar').val(response.keluar);
                    $('#selisihkeluarantrian').val(response.selisihkeluarantrian);


                },
                error: function(err) {
                    console.log(err);
                }
            });


        }

        function deleteOne(id) {
            alert('Yakin untuk hapus data ?');
            $.ajax({
                url: "http://localhost/antrian-mcd/api/operasi/delete.php",
                method: "DELETE",
                data: JSON.stringify({
                    "id": id
                }),
                success: function(data) {
                    $('#action_button').attr('disabled', false);
                    $('#message').html('<div class="alert alert-success">' + data.message + '</div>');
                    $('#action_modal').modal('hide');
                    $('#sample_data').DataTable().destroy();
                    showAll();
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    </script>
    <script>
        function updateDateTime() {
            const currentTimeElement = document.getElementById('current-time');
            const currentDateElement = document.getElementById('current-date');

            const now = new Date();

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = now.toLocaleDateString('en-US', options);

            const formattedTime = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            currentTimeElement.textContent = formattedTime;
            currentDateElement.textContent = formattedDate;
        }

        setInterval(updateDateTime, 1000);

        updateDateTime();
    </script>
</body>

</html>