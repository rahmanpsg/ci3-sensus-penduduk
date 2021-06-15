<?php $this->load->view('admin/header') ?>
<link href="<?= base_url('/assets/vendor/perfect-scrollbar/perfect-scrollbar.css') ?>" rel="stylesheet" media="all">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-validator/bootstrapValidator.min.css') ?>">
<!-- PAGE CONTENT-->
<div class="page-content--bgf7" id="app">

    <!-- STATISTIC CHART-->
    <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Data Penduduk</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div id="toolbar" class="table-data__tool">
                        <div class="table-data__tool-left">
                            <button class="au-btn au-btn-icon au-btn--blue2 au-btn--small" onclick="tambahData()">
                                <i class="zmdi zmdi-plus"></i>Tambah Data</button>
                            <button id="btnUbah" disabled class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="editData()">
                                <i class="zmdi zmdi-edit"></i>Ubah Data</button>
                            <button id="btnHapus" disabled class="au-btn au-btn-icon au-btn--red au-btn--small" onclick="hapusData()">
                                <i class="zmdi zmdi-delete"></i>Hapus Data</button>
                        </div>

                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table id="myTable" class="table table-data3 table-borderless" data-toggle="table" data-url='<?= $TBL_URL ?>' data-toolbar="#toolbar" data-pagination="true" data-search="true" data-click-to-select="true" data-unique-id="nik">
                            <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="true"></th>
                                    <th data-field="no" data-formatter="indexFormatter" class="text-center">#</th>
                                    <th data-field="nik" data-sortable="true">NIK</th>
                                    <th data-field="nama">Nama</th>
                                    <th data-field="alamat">Alamat</th>
                                    <th data-field="jenis_kelamin" data-sortable="true">Jenis Kelamin</th>
                                    <th data-field="tempat_lahir">Tempat Lahir</th>
                                    <th data-field="tanggal_lahir" data-formatter="tglFormatter" data-sortable="true">Tanggal Lahir</th>
                                    <th data-field="agama" data-sortable="true">Agama</th>
                                    <th data-field="pendidikan" data-sortable="true">Pendidikan</th>
                                    <th data-field="pekerjaan" data-sortable="true">Pekerjaan</th>
                                    <th data-field="status" data-sortable="true">Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                    <!-- MODAL -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Medium Modal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="myForm" onsubmit="return false" class="form-horizontal">
                                    <div class="modal-body row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="nik" class=" form-control-label">NIK</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="nik" id="nik" placeholder="Masukkan NIK" class="form-control" data-bv-notempty="true" data-bv-notempty-message="NIK tidak boleh kosong" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="nama" class=" form-control-label">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Nama tidak boleh kosong">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="alamat" class=" form-control-label">Alamat</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Alamat tidak boleh kosong"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="jenis_kelamin" class=" form-control-label">Jenis kelamin</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" data-bv-notempty="true" data-bv-notempty-message="Jenis kelamin belum dipilih">
                                                        <option value="" selected disabled>- Pilih Jenis Kelamin -</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="tempat_lahir" class=" form-control-label">Tempat lahir</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Tempat lahir tidak boleh kosong"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="tanggal_lahir" class=" form-control-label">Tanggal lahir</label>
                                                </div>
                                                <div class="col-12 col-md-9 inpDate">
                                                    <input type="date" data-date-format="DD MMMM YYYY" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan tanggal lahir" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Tanggal lahir tidak boleh kosong">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="agama" class=" form-control-label">Agama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select class="form-control" name="agama" id="agama" data-bv-notempty="true" data-bv-notempty-message="Agama belum dipilih">
                                                        <option value="" selected disabled>- Pilih Agama -</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Protestan">Protestan</option>
                                                        <option value="Katolik">Katolik</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Buddha">Buddha</option>
                                                        <option value="Khonghucu">Khonghucu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="pendidikan" class=" form-control-label">Pendidikan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select class="form-control" name="pendidikan" id="pendidikan" data-bv-notempty="true" data-bv-notempty-message="Pendidikan belum dipilih">
                                                        <option value="" selected disabled>- Pilih Pendidikan -</option>
                                                        <option value="Belum Sekolah">Belum Sekolah</option>
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA/SMK">SMA/SMK</option>
                                                        <option value="Diploma">Diploma</option>
                                                        <option value="S1">S1</option>
                                                        <option value="S2 keatas">S2 keatas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="pekerjaan" class=" form-control-label">Pekerjaan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Pekerjaan tidak boleh kosong">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="status" class=" form-control-label">Status</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select class="form-control" name="status" id="status" data-bv-notempty="true" data-bv-notempty-message="Status belum dipilih">
                                                        <option value="" selected disabled>- Pilih Status -</option>
                                                        <option value="Belum Kawin">Belum Kawin</option>
                                                        <option value="Kawin">Kawin</option>
                                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                                        <option value="Cerai Mati">Cerai Mati</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnSubmit" class="btn btn-link text-white">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC CHART-->

    <?php $this->load->view('admin/footer') ?>
    <script src="<?= base_url('/assets/vendor/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table-id-ID.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-validator/bootstrapValidator.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-validator/id_ID.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/jquery-serializeObject.js') ?>"></script>

    <script>
        let $table = $('#myTable')
        let $form = $('#myForm')
        let $modal = $('#myModal')
        let $modalLabel = $('#myModalLabel');

        $(document).ready(() => {
            $form.bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'fa fa-exclamation-circle',
                    validating: 'fa fa-spin fa-refresh'
                },
                excluded: ':disabled',
                fields: {
                    nik: {
                        message: 'NIK Harus Angka',
                        validators: {
                            callback: {
                                callback: function(value, validator, $fields) {
                                    if (value == '') return true;

                                    if (isNaN(value)) return false;

                                    if (value.length != 16) {
                                        return {
                                            valid: false,
                                            message: `NIK harus 16 angka (-${16 - value.length})`
                                        }

                                    }
                                    return true;
                                }
                            }
                        }
                    }
                }
            })

            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function() {
                $('#btnHapus').prop('disabled', !$table.bootstrapTable('getSelections').length);
            });

            $table.on('check.bs.table uncheck.bs.table', function() {
                if ($table.bootstrapTable('getSelections').length == 1) {
                    $('#btnUbah').prop('disabled', !$table.bootstrapTable('getSelections').length);
                } else {
                    $('#btnUbah').prop('disabled', true);
                }

            });
        })

        function tambahData() {
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
            $modal.modal('toggle')
            $modalLabel.text('Form Tambah Data Penduduk')
        }

        function editData() {
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
            $modal.modal('toggle')
            $modalLabel.text('Form Ubah Data Penduduk')

            const data = $table.bootstrapTable('getSelections')[0];

            $.each(data, function(i, val) {
                $('#' + i).val(val);
            });
        }

        function hapusData() {
            const listNIK = $table.bootstrapTable('getSelections').map(v => v.nik)

            swal({
                    text: `${listNIK.length} data penduduk akan dihapus?`,
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Batal",
                            value: null,
                            visible: true
                        },
                        confirm: {
                            text: "OK",
                            closeModal: false
                        }
                    }
                })
                .then(hapus => {
                    if (hapus === null) return

                    $.ajax('<?= base_url('api/deletePenduduk') ?>', {
                        method: 'post',
                        data: {
                            listNIK
                        }
                    }).then(res => {
                        swal(res.message, {
                            icon: res.error ? 'error' : 'success',
                            buttons: false,
                            timer: 2000,
                        });

                        if (res.error) return

                        listNIK.forEach(nik => {
                            $table.bootstrapTable('removeByUniqueId', nik);
                        });

                        $('#btnHapus').prop('disabled', true)
                        $('#btnUbah').prop('disabled', true);
                    }).catch(err => {
                        console.log(err);
                        if (err) {
                            swal("Terjadi masalah di server", "The AJAX request failed!", "error");
                        } else {
                            swal.stopLoading();
                            swal.close();
                        }
                    })
                })
        }

        $('#btnSubmit').on('click', (e) => {
            e.preventDefault();

            $form.data('bootstrapValidator').validate();

            const hasErr = $form.find(".has-error").length;

            if (hasErr > 0) return

            const aksi = $modalLabel.text().split(' ')[1]

            const data = $form.serializeObject()

            if (aksi == 'Tambah') {
                $.ajax('<?= base_url('api/penduduk') ?>', {
                    method: 'post',
                    data
                }).then(res => {
                    swal(res.message, {
                        icon: res.error ? 'error' : 'success',
                        buttons: false,
                        timer: 2000,
                    });

                    if (res.error) return

                    $modal.modal('toggle');

                    $table.bootstrapTable('append', res.data);
                })
            } else {
                data['where'] = $table.bootstrapTable('getSelections')[0].nik

                $.ajax('<?= base_url('api/updatePenduduk') ?>', {
                    method: 'post',
                    data
                }).then(res => {
                    swal(res.message, {
                        icon: res.error ? 'error' : 'success',
                        buttons: false,
                        timer: 2000,
                    });

                    if (res.error) return

                    $modal.modal('toggle');

                    $table.bootstrapTable('updateByUniqueId', {
                        id: data['where'],
                        row: res.data
                    });
                })
            }
        })

        function indexFormatter(val, row, index) {
            return index + 1;
        }

        function tglFormatter(val) {
            moment.locale('id')
            return moment(val).format('D MMMM YYYY')
        }
    </script>
    </body>

    </html>
    <!-- end document-->