<script>
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
                    $('#waktu_kedatangan_modal').text(response.waktu_datang + response.max_waktu_datang);

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
    });
</script>