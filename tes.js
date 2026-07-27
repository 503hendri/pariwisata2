
function lupa_p() {
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    const modal = document.getElementById("modalKustom");
    const feedbackPesan = document.getElementById('feedbackPesan');
    var nik = '1301112109910002';
    var nama = 'SUHENDRI';
    var id_peg = '4917';
    var id_opd = '39';
    //alert(nik+'/'+nama+'/'+id_peg+'/'+id_opd);
    $.ajax({
        type: 'POST',
        url: 'https://egov.sawahluntokota.go.id/tte/welcome/reset_passpharase_tte_2026',
        data: { nik: nik, nama: nama, id_peg: id_peg, id_opd: id_opd },
        beforeSend: function () {
            feedbackPesan.textContent = 'Mohon Menunggu...';
            feedbackPesan.style.color = 'green';
        },
        success: function (json) {
            try {
                var jsonx = jQuery.parseJSON(json);
                var hasil = jsonx.success;
            }
            catch (error) {
                return false;
            }
            if (hasil == 'true') {
                modal.close();
                Swal.fire({ title: 'Reset Passphrase TTE', html: `Passphrase akan di reset, mohon untuk secara berkala memeriksa no telp/wa untuk menerima link pembuatan passphrase baru dari BSrE.</b>`, icon: 'success' });
            } else {
                modal.close();
                Swal.fire({ title: 'Reset Passphrase', html: `Terjadi kesalahan Sistem.. silahkan logoff dari apllikasi.</b>`, icon: 'error' });
            }
        },
        error: function () {
            return false;
        }
    });

}


function pilih_lap(event, targetId, offset) {
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    var id_peg = '4917';
    event.preventDefault();
    const targetElement = document.getElementById(targetId);
    const targetRect = targetElement.getBoundingClientRect();
    const targetPosition = window.scrollY + targetRect.top;
    bersih2();
    var html_lap = '';
    html_lap += '<br>' +
        '<select id="tahun_2s" name="tahun_2s" style="height: 30px; width: 25%;font-size: 11px;border-radius: 4px;">' +
        '<option value="">-Pilih Tahun-</option>' +
        '<option value="2025">2025</option>' +
        '<option value="2026">2026</option>' +
        '</select>&nbsp;' +
        '<select id="bulan_2s" name="bulan_2s" style="height: 30px; width: 30%;font-size: 11px;border-radius: 4px;">' +
        '<option value="">-Pilih Bulan-</option>' +
        '<option value="01">Januari</option>' +
        '<option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>' +
        '</select>&nbsp;<a style="width:25%;height:30px;font-size:11px;" href="#" id="tampil_lap" class="btn btn-outline-primary" iconCls="icon-ok-a" onClick="lap()">Tampil</a>';
    $('#pilih_lap').html(html_lap);
    targetElement.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
        top: targetPosition - offset
    });
}

function lap() {
    const modal = document.getElementById("modalTahunBulan");
    var tahun = document.getElementById("tahun_2s").value;
    var bulan = document.getElementById("bulan_2s").value;
    var id_opd_atasan = '';
    var result = '?tahun=' + tahun + '&bulan=' + bulan;
    if (tahun == 0 || bulan == 0) {
        modal.close();
        Swal.fire({
            title: "Laporan",
            text: "Data Tahun/Bulan belum di Pilih",
            icon: "info",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK!",
            cancelButtonText: "Batal",
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                modal.showModal();
            }
        });
    } else {
        document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/lap_2026' + result;
    }
}

function lap_at() {
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    const modal = document.getElementById("modalAtasan");
    const feedbackPesan = document.getElementById('feedbackPesanAtasan');
    var tahun = '2026';
    var bulan = '07';
    var id_at2 = document.getElementById("id_at").value;
    var id_at_plt = document.getElementById("id_at_plt").value;
    event.preventDefault();
    if (id_at2 == '' && id_at_plt == '') {
        feedbackPesan.textContent = 'Atasan Belum di Pilih!!.';
        feedbackPesan.style.color = 'red';
        return;
    }
    if (id_at2 != '' && id_at_plt != '') {
        feedbackPesan.textContent = 'Atasan Harus di Pilih Salah Satu!!.';
        feedbackPesan.style.color = 'red';
        return;
    }
    if (id_at2 == '') { var id_at = id_at_plt; var plt = '1'; }
    else if (id_at2 != '') { var id_at = id_at2; var plt = '0'; }
    else { var id_at = id_at2; var plt = '0'; }
    var id_opd_atasan = '';
    //alert(id_at);
    $.ajax({
        type: 'POST',
        url: 'https://egov.sawahluntokota.go.id/tte/welcome/lap_at2',
        data: { tahun: tahun, bulan: bulan, id_at: id_at, id_opd_atasan: id_opd_atasan, plt: plt },
        beforeSend: function () {
            Swal.fire({
                title: "PDF...",
                text: "Mohon tunggu",
                imageUrl: "https://egov.sawahluntokota.go.id/tte/images/edit.gif",
                imageWidth: 60,
                imageHeight: 60,
                showConfirmButton: false,
                allowOutsideClick: false,
                timerProgressBar: true,
                timer: 7000,
                toast: true
            });
        },
        success: function (json) {
            try {
                var jsonx = jQuery.parseJSON(json);
                var hasil = jsonx.success;
            }
            catch (error) {
                return false;
            }
            if (hasil == 'ok') {
                modal.close();
                Swal.fire({ title: 'Pilih Atasan', html: `Atasan Telah Dipilih</b>`, icon: 'success' });
                atasan_edit(tahun, bulan);
                //$('#atasan').modal('hide');
            } else if (hasil == 'tidak') {
                Swal.fire({ title: 'Error!', html: `Data Tidak Ada!!</b>`, icon: 'error' });
            } else if (hasil == 'update') {
                modal.close();
                Swal.fire({ title: 'Pilih Atasan', html: `Data Atasan Telah Diupdate</b>`, icon: 'success' });
                atasan_edit(tahun, bulan);
                //$('#atasan').modal('hide');
            }
        }
    });
}

function cetak_laporan_update_2026(tahun, bulan, id_app_api, tgl_cetak, id_peg, id_opd, m_atas, m_bawah, ver, plt, jab_s) {
    var dat = '&tahun=' + tahun + '&bulan=' + bulan;
    $.ajax({
        type: 'POST',
        //url:  'https://egov.sawahluntokota.go.id/tte/welcome/cetak_laporan_update_5',
        //url:  'https://egov.sawahluntokota.go.id/tte/welcome/cetak_laporan_update_5_2026',
        url: 'https://egov.sawahluntokota.go.id/tte/welcome/cetak_laporan_update_5_2026_update',
        data: { tahun: tahun, bulan: bulan, id_app_api: id_app_api, tgl_cetak: tgl_cetak, id_peg: id_peg, id_opd: id_opd, m_atas: m_atas, m_bawah: m_bawah, ver: 1, plt: plt, jab_s: jab_s },
        success: function (json) {
            try {
                var jsonx = jQuery.parseJSON(json);
                var hasil = jsonx.success;
            }
            catch (error) {
                return false;
            }
            if (hasil == 'noatasan') {
                feedbackPesanPDF.textContent = 'Atasan Belum di Pilih!!.';
                feedbackPesanPDF.style.color = 'red';
                aturTimerHilang2('feedbackPesanLap2', 5);
            } else if (hasil == 'errorpdf') {
                feedbackPesanPDF.textContent = 'Gagal Membuat PDF, silahkah ulangi login/hub Kominfo!.';
                feedbackPesanPDF.style.color = 'red';
                aturTimerHilang2('feedbackPesanLap2', 5);
            } else if (hasil == 'true') {
                feedbackPesanPDF.textContent = 'Laporan PDF telah di buat.';
                feedbackPesanPDF.style.color = 'green';
                aturTimerHilang2('feedbackPesanLap2', 5);
            } else if (hasil == 'error_lap_tte') {
                feedbackPesanPDF.textContent = 'Error Lap.!.';
                feedbackPesanPDF.style.color = 'red';
                aturTimerHilang2('feedbackPesanLap2', 5);
            } else {
                feedbackPesanPDF.textContent = 'Cek Koneksi Jaringan atau ulangi Login..!!';
                feedbackPesanPDF.style.color = 'red';
                aturTimerHilang2('feedbackPesanLap2', 5);
            }
        }
    });
}

function cetak_laporan_update_5(tahun, bulan, id_app_api, tgl_cetak, id_peg, id_opd, m_atas, m_bawah, ver) {
    //alert("test");
    var dat = '&tahun=' + tahun + '&bulan=' + bulan;
    $.ajax({
        type: 'POST',
        url: 'https://egov.sawahluntokota.go.id/tte/welcome/cetak_laporan_update_5',
        data: { tahun: tahun, bulan: bulan, id_app_api: id_app_api, tgl_cetak: tgl_cetak, id_peg: id_peg, id_opd: id_opd, m_atas: m_atas, m_bawah: m_bawah, ver: 1 },
        beforeSend: function () {
            Swal.fire({
                title: "PDF...",
                text: "Mohon tunggu",
                imageUrl: "https://egov.sawahluntokota.go.id/tte/images/edit.gif",
                imageWidth: 60,
                imageHeight: 60,
                showConfirmButton: false,
                allowOutsideClick: false,
                timerProgressBar: true,
                timer: 7000,
                toast: true
            });
        },
        success: function (json) {
            try {
                var jsonx = jQuery.parseJSON(json);
                var hasil = jsonx.success;
            }
            catch (error) {
                return false;
            }
            if (hasil == 'noatasan') {
                Swal.fire({ title: 'Pilih Atasan', html: `Atasan belum di pilih..!!</b>`, icon: 'info' });
            } else if (hasil == 'errorpdf') {
                Swal.fire({ title: 'PDF..', html: `Gagal Membuat PDF, silahkah ulangi login/hub Kominfo..!!</b>`, icon: 'error' });
            } else if (hasil == 'true') {
                Swal.fire({ title: 'PDF..', html: `Dokumen PDF telah dibuat..!!</b>`, icon: 'success' });
                //document.location.href = "https://egov.sawahluntokota.go.id/tte/welcome/lap?data=1"+dat;
            } else if (hasil == 'error_lap_tte') {
                Swal.fire({ title: 'PDF..', html: `Gagal Membuat PDF, error lap PDF..!!</b>`, icon: 'error' });
                //document.location.href = "https://egov.sawahluntokota.go.id/tte/welcome/lap?data=2"+dat;
            } else {
                Swal.fire({ title: 'PDF..', html: `Cek Koneksi Jaringan atau ulangi Login..!!</b>`, icon: 'error' });
            }
        }
    });
}
function aturTimerHilang2(idElement, waktuDetik) {
    const elemenDiv = document.getElementById(idElement);
    const waktuMilidetik = waktuDetik * 1000;
    //document.getElementById('status').textContent = `Timer dimulai. Menghilang dalam ${waktuDetik} detik.`;
    const timer = setTimeout(function () {
        if (elemenDiv) {
            //elemenDiv.style.display = 'none';
            var html_p = '';
            $('#feedbackPesanPDF').html(html_p);
        }
        clearTimeout(timer);
    }, waktuMilidetik); // Waktu di sini (misalnya, 5000ms = 5 detik)
}
function cetak_api_2026() {
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    const feedbackPesan = document.getElementById('feedbackPesanPDF');
    var tahun = '2026';
    var bulan = '07';
    var tgl_cetak = document.getElementById("tgl_c").value;
    //var id_app_api=document.getElementById("id_app").value;
    var id_app_api2 = document.getElementById("id_app").value;
    var m_atas = document.getElementById("m_atas").value;
    var m_bawah = document.getElementById("m_bawah").value;
    var id_peg = '4917';
    var id_opd = '39';
    var jab_s = document.getElementById("jab_s").value;
    //if(id_app_api=='' || tgl_cetak=='') {
    if (tgl_cetak == '') {
        feedbackPesan.textContent = 'Data Belum Lengkap (Atasan/Tanggal).';
        feedbackPesan.style.color = 'red';
        aturTimerHilang2('feedbackPesanPDF', 5);
    } else {
        var id_app_plt = document.getElementById("id_app_plt").value;
        event.preventDefault();
        if (id_app_api2 == '' && id_app_plt == '') {
            feedbackPesan.textContent = 'Atasan Pejabat Penilai Belum di Pilih!!.';
            feedbackPesan.style.color = 'red';
            return;
        }
        if (id_app_api2 != '' && id_app_plt != '') {
            feedbackPesan.textContent = 'Atasan Pejabat Penilai Harus di Pilih Salah Satu!!.';
            feedbackPesan.style.color = 'red';
            return;
        }
        if (id_app_api2 == '') { var id_app_api = id_app_plt; var plt = '1'; }
        else if (id_app_api2 != '') { var id_app_api = id_app_api2; var plt = '0'; }
        else { var id_app_api = id_app_api2; var plt = '0'; }
        $.ajax({
            type: 'POST',
            url: 'https://egov.sawahluntokota.go.id/tte/welcome/cek_laporan',
            data: { tahun: tahun, bulan: bulan, id_peg: id_peg, id_opd: id_opd },
            success: function (json) {
                try {
                    var jsonx = jQuery.parseJSON(json);
                    var hasil = jsonx.success;
                }
                catch (error) {
                    return false;
                }
                if (hasil == 'sudah') {
                    var data = '?tahun=' + tahun + '&bulan=' + bulan + '&id_app=' + id_app_api + '&tgl_cetak=' + tgl_cetak + '&id_peg=' + id_peg + '&id_opd=' + id_opd + '&m_atas=' + m_atas + '&m_bawah=' + m_bawah + '&ver=1';
                    var ver = '1';
                    cetak_laporan_update_2026(tahun, bulan, id_app_api, tgl_cetak, id_peg, id_opd, m_atas, m_bawah, ver, plt, jab_s);
                } else if (hasil == 'belum') {
                    var data = '?tahun=' + tahun + '&bulan=' + bulan + '&id_app=' + id_app_api + '&tgl_cetak=' + tgl_cetak + '&id_peg=' + id_peg + '&id_opd=' + id_opd + '&m_atas=' + m_atas + '&m_bawah=' + m_bawah + '&ver=0';
                    var ver = '0';
                    cetak_laporan_update_2026(tahun, bulan, id_app_api, tgl_cetak, id_peg, id_opd, m_atas, m_bawah, ver, plt, jab_s);
                } else if (hasil == 'atasan') {
                    feedbackPesanPDF.textContent = 'Atasan Belum di Pilih!!.';
                    feedbackPesanPDF.style.color = 'red';
                    aturTimerHilang2('feedbackPesanLap2', 5);
                } else if (hasil == 'tte') {
                    var data = '?tahun=' + tahun + '&bulan=' + bulan + '&id_peg=' + id_peg + '&id_opd=' + id_opd;
                    document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/download_lap' + data;
                    feedbackPesanPDF.textContent = 'File Telah di Download!!.';
                    feedbackPesanPDF.style.color = 'red';
                    aturTimerHilang2('feedbackPesanLap2', 5);
                }
            }
        });
    }
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('sandi');
    const toggleIcon = document.querySelector('.toggle-password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.textContent = '🔒'; // Ganti ikon menjadi terkunci
    } else {
        passwordInput.type = 'password';
        toggleIcon.textContent = '👁️'; // Ganti ikon menjadi mata
    }
}
function sign_laporan_2(tahun, bulan, id_peg, id_opd, nik, id_atasan_penilai, ptte) {
    var dat = '&tahun=' + tahun + '&bulan=' + bulan;
    const modal = document.getElementById("modalKustom");
    const tombolTutup = document.getElementById("tutupModal");
    const setuju = document.getElementById("verifsetuju");
    const feedbackPesan = document.getElementById('feedbackPesan');
    document.getElementById("sandi").value = ptte;
    modal.showModal();
    tombolTutup.addEventListener("click", () => {
        feedbackPesan.textContent = '';
        modal.close();
    });

    setuju.addEventListener("click", () => {
        const sandi = document.getElementById("sandi").value;
        feedbackPesan.textContent = 'Mohon MENUNGGU!!!';
        feedbackPesan.style.color = 'Red';
        if (sandi == '') {
            feedbackPesan.textContent = 'Password belum di isi!!!';
            feedbackPesan.style.color = 'Red';
        } else {
            //alert(sandi);
            $.ajax({
                type: 'POST',
                url: 'https://egov.sawahluntokota.go.id/tte/welcome/sign_lapkin_2026',
                data: { tahun: tahun, bulan: bulan, id_peg: id_peg, id_opd: id_opd, nik: nik, pass: sandi, id_atasan_penilai: id_atasan_penilai },
                beforeSend: function () {
                    Swal.fire({
                        title: "Sign...",
                        text: "Mohon tunggu",
                        imageUrl: "https://egov.sawahluntokota.go.id/tte/images/edit.gif",
                        imageWidth: 60,
                        imageHeight: 60,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timerProgressBar: true,
                        timer: 7000,
                        toast: true
                    });
                },
                success: function (json) {
                    try {
                        var jsonx = jQuery.parseJSON(json);
                        var hasil = jsonx.success;
                    }
                    catch (error) {
                        return false;
                    }
                    if (hasil == 'ok') {
                        modal.close();
                        tte_ok();
                    } else if (hasil == 'nopdf') {
                        modal.close();
                        Swal.fire({
                            title: "TTE",
                            text: "Dokumen PDF Laporan tidak ditemukan, hub. Kominfo!",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "TUTUP!",
                            cancelButtonText: "Batal",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/lap_lkh';
                            }
                        });
                    } else if (hasil == 'noimg') {
                        modal.close();
                        Swal.fire({
                            title: "TTE",
                            text: "Visualisasi tidak ditemukan, hub. Kominfo!",
                            icon: "info",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "TUTUP!",
                            cancelButtonText: "Batal",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/lap_lkh';
                            }
                        });
                    } else if (hasil == 'server_error') {
                        modal.close();
                        Swal.fire({
                            title: "TTE",
                            text: "SERVER TIDAK MERESPON, hub. Kominfo!",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "TUTUP!",
                            cancelButtonText: "Batal",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/lap_lkh';
                            }
                        });
                    } else if (hasil == 'nowa') {
                        modal.close();
                        no_wa();
                        //document.location.href = "https://egov.sawahluntokota.go.id/tte/welcome/lap?data=4"+dat;
                    } else {
                        modal.close();
                        Swal.fire({ title: 'Error!', html: `Kesalahan : <b>${jsonx}</b>`, icon: 'error' });
                    }
                },
                error: function () {
                    return false;
                }
            });
        }
    });

}
function reset_all() {
    var id_peg = '4917';
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    var tahun = '2026';
    var bulan = '07';
    var dat = '?tahun=' + tahun + '&bulan=' + bulan;
    //alert(id_peg+tahun+bulan);
    Swal.fire({
        title: "Reset",
        text: "Laporan akan di reset seluruhnya? (silahkan dipilih ulang nama atasan serta verifikasi ulang laporan)",
        icon: "info",
        showCancelButton: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK!",
        cancelButtonText: "Batal",
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'https://egov.sawahluntokota.go.id/tte/welcome/reset_all_lap',
                data: { tahun: tahun, bulan: bulan, id_peg: id_peg },
                success: function (json) {
                    try {
                        var jsonx = jQuery.parseJSON(json);
                        var hasil = jsonx.success;
                    }
                    catch (error) {
                        return false;
                    }
                    if (hasil == 'true') {
                        Swal.fire({
                            title: "Reset",
                            text: "Dokumen telah di Reset, silahkan ulangi pilih atasan dan verifikasi!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK!",
                            cancelButtonText: "Batal",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/lap_2026' + dat;
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            html: `Cek Koneksi Jaringan atau ulangi Login...`,
                            icon: 'error'
                        });
                    }
                }
            });
        }
    });
}
function sign_2() {
    var id_peg = '4917';
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    const url = 'https://egov.sawahluntokota.go.id/tte/welcome/cekpass?id_peg=' + id_peg;
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Jaringan bermasalah atau gagal memuat data.');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            var ptte = data.passtte;
            sign_2_update(ptte);
            //alert(ptte);//
        })
        .catch(error => {
            console.error('Ada kesalahan saat fetch data:', error);
        });
}
//function sign_2() {
function sign_2_update(ptte) {
    var id_peg = '4917';
    //if(id_peg=='') { document.location.href='https://egov.sawahluntokota.go.id/tte/welcome/logout' }
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    var tahun = '2026';
    var bulan = '07';
    var tgl = '2026-07%';
    var id_opd = '39';
    var nik = '1301112109910002';
    var id_atasan_penilai = '0';
    $.ajax({
        type: 'POST',
        url: 'https://egov.sawahluntokota.go.id/tte/welcome/cek_status_laporan',
        data: { tahun: tahun, bulan: bulan, id_peg: id_peg, id_opd: id_opd, id_atasan_penilai: id_atasan_penilai },
        success: function (json) {
            try {
                var jsonx = jQuery.parseJSON(json);
                var hasil = jsonx.success;
            }
            catch (error) {
                return false;
            }
            if (hasil == 'atasan') {
                Swal.fire({ title: 'Pilih Atasan', html: `Atasan Belum di Pilih!!</b>`, icon: 'info' });
            } else if (hasil == 'verif') {
                Swal.fire({ title: 'Pilih Atasan', html: `Laporan Belum di Verifikasi Atasan!!</b>`, icon: 'info' });
            } else if (hasil == 'nopdf') {
                Swal.fire({ title: 'Pilih Atasan', html: `Laporan telah di TTE/PDF tidak ditemukan!!</b>`, icon: 'info' });
            } else if (hasil == 'ok') {
                sign_laporan_2(tahun, bulan, id_peg, id_opd, nik, id_atasan_penilai, ptte);
            } else {
                Swal.fire({ title: 'Error!', html: `Cek Koneksi Jaringan atau ulangi Login!!</b>`, icon: 'error' });
            }
        }
    });
}

function download_lap_tte() {
    var tahun = '2026';
    var bulan = '07';
    var tgl = '2026-07%';
    var id_peg = '4917';
    var id_opd = '39';
    //alert(id_opd);
    var data = '?tahun=' + tahun + '&bulan=' + bulan + '&id_peg=' + id_peg + '&id_opd=' + id_opd;
    document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/download_lap' + data;
    Swal.fire({ title: 'Download', html: `File Telah di Download!!</b>`, icon: 'success' });

}

function download_lap_2026() {
    checkCIsession().then(dataHasil => { if (dataHasil != '1') { window.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/logout'; } });
    var tahun = '2026';
    var bulan = '07';
    var tgl = tahun + '-' + bulan + '%';
    var id_peg = '4917';
    var id_opd = '39';
    var data = '?tahun=' + tahun + '&bulan=' + bulan + '&id_peg=' + id_peg + '&id_opd=' + id_opd;
    const feedbackPesan = document.getElementById('feedbackPesanPDF');
    $.ajax({
        type: 'POST',
        url: 'https://egov.sawahluntokota.go.id/tte/welcome/download_lap_update',
        data: { tahun: tahun, bulan: bulan, id_peg: id_peg, id_opd: id_opd },
        success: function (json) {
            try {
                var jsonx = jQuery.parseJSON(json);
                var hasil = jsonx.success;
            }
            catch (error) {
                return false;
            }
            if (hasil == 'true') {
                document.location.href = 'https://egov.sawahluntokota.go.id/tte/welcome/download_lap' + data;
                feedbackPesan.textContent = 'File Telah di Download.';
                feedbackPesan.style.color = 'green';
                aturTimerHilang2('feedbackPesan', 5);
            } else if (hasil == 'false') {
                feedbackPesan.textContent = 'Ulangi cetak PDF';
                feedbackPesan.style.color = 'red';
                aturTimerHilang2('feedbackPesan', 5);
            }
        }
    });

}


