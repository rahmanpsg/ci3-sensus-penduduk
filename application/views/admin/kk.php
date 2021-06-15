<?php $this->load->view('admin/header') ?>
<link href="<?= base_url('/assets/vendor/perfect-scrollbar/perfect-scrollbar.css') ?>" rel="stylesheet" media="all">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-validator/bootstrapValidator.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') ?>">
<style>

</style>
<!-- PAGE CONTENT-->
<div class="page-content--bgf7" id="app">

    <!-- STATISTIC CHART-->
    <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Data Kartu Keluarga</h3>
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
                        <table id="myTable" class="table table-data3 table-borderless" data-toggle="table" data-url='<?= $TBL_URL ?>' data-toolbar="#toolbar" data-pagination="true" data-search="true" data-click-to-select="true" data-detail-view="true" data-detail-formatter="detailFormatter" data-unique-id="kk">
                            <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="true"></th>
                                    <th data-field="no" data-formatter="indexFormatter" class="text-center">#</th>
                                    <th data-field="kk" data-sortable="true">Nomor Kartu Keluarga</th>
                                    <th data-field="nama_kepala">Nama Kepala Keluarga</th>
                                    <th data-field="nama_istri">Nama Istri</th>
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
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="kk" class=" form-control-label">Nomor KK</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="kk" id="kk" placeholder="Masukkan Nomor KK" class="form-control" data-bv-notempty="true">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="kepala_keluarga" class=" form-control-label">Kepala Keluarga</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select class="selectpicker show-tick form-control" data-style="btn-outline-secondary" data-live-search="true" id="kepala_keluarga" name="kepala_keluarga" title="- Pilih Kepala Keluarga">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="istri" class=" form-control-label">Istri</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select class="selectpicker show-tick form-control" data-style="btn-outline-secondary" data-live-search="true" id="istri" name="istri" title="- Pilih Istri">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="anak" class=" form-control-label">Anak</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select class="selectpicker show-tick form-control" data-style="btn-outline-secondary" data-live-search="true" id="anak" name="anak" title="- Pilih Anak" multiple>
                                                </select>
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
    <script src="<?= base_url('/assets/vendor/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-select/js/defaults-id_ID.min.js') ?>"></script>

    <script>
        let $table = $('#myTable')
        let $form = $('#myForm')
        let $modal = $('#myModal')
        let $modalLabel = $('#myModalLabel');

        const getDataSelection = (field) => {
            if (field == 'anak') {
                return $table.bootstrapTable('getSelections').length > 0 ? $table.bootstrapTable('getSelections')[0][field].map(v => v.nik) : undefined
            }

            return $table.bootstrapTable('getSelections').length > 0 ? $table.bootstrapTable('getSelections')[0][field] : undefined
        }

        $(document).ready(() => {
            $form.bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'fa fa-exclamation-circle',
                    validating: 'fa fa-spin fa-spinner'
                },
                excluded: ':disabled',
                fields: {
                    kk: {
                        message: 'Nomor KK Harus Angka',
                        validators: {
                            notEmpty: {
                                message: 'Nomor KK tidak boleh kosong'
                            },
                            callback: {
                                callback: function(value, validator, $fields) {
                                    if (value == '') {
                                        return true;
                                    }

                                    if (isNaN(value)) {
                                        return false;
                                    }

                                    if (value.length != 16) {
                                        return {
                                            valid: false,
                                            message: `Nomor KK harus 16 angka (-${16 - value.length})`
                                        }

                                    }
                                    return true;
                                }
                            },
                            remote: {
                                url: '<?= base_url('api/validator') ?>',
                                delay: 1000,
                                data: function(validator) {
                                    return {
                                        validator: 'kk',
                                        default: getDataSelection('kk')
                                    };
                                },
                                message: 'Nomor KK telah digunakan'
                            },
                        }
                    },
                    kepala_keluarga: {
                        validators: {
                            notEmpty: {
                                message: 'Kepala keluarga belum dipilih'
                            },
                            remote: {
                                url: '<?= base_url('api/validator') ?>',
                                delay: 1000,
                                data: function(validator) {
                                    return {
                                        validator: 'kepala_keluarga',
                                        default: getDataSelection('kepala_keluarga')
                                    };
                                },
                                message: 'NIK telah terdaftar di KK yang lain'
                            },
                        }
                    },
                    istri: {
                        validators: {
                            notEmpty: {
                                message: 'Istri belum dipilih'
                            },
                            remote: {
                                url: '<?= base_url('api/validator') ?>',
                                delay: 1000,
                                data: function(validator) {
                                    return {
                                        validator: 'istri',
                                        default: getDataSelection('istri')
                                    };
                                },
                                message: 'NIK telah terdaftar di KK yang lain'
                            },
                        }
                    },
                    anak: {
                        validators: {
                            remote: {
                                url: '<?= base_url('api/validator') ?>',
                                delay: 1000,
                                data: function(validator) {
                                    return {
                                        validator: 'anak',
                                        default: getDataSelection('anak'),
                                        kk: getDataSelection('kk')
                                    };
                                },
                                message: 'NIK telah terdaftar di KK yang lain'
                            },
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

            $.ajax('<?= base_url('api/nik') ?>').then(res => {
                const _createOpt = (list) => {
                    let opt = [];

                    list.map(v => {
                        opt.push(`<option value="${v.nik}" data-subtext="${v.nama}" title="${v.nama}">${v.nik}</option>`)
                    })

                    return opt
                }

                $('#kepala_keluarga').append(_createOpt(res.dataSuami).join('')).selectpicker('refresh')
                $('#istri').append(_createOpt(res.dataIstri).join('')).selectpicker('refresh')
                $('#anak').append(_createOpt(res.dataAnak).join('')).selectpicker('refresh')
            })
        })

        function tambahData() {
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
            $modal.modal('toggle')
            $modalLabel.text('Form Tambah Data Kartu Keluarga')

            $('.selectpicker').val('').selectpicker('refresh')

            $table.bootstrapTable('uncheckAll')
            $('#btnUbah').prop('disabled', true);
        }

        function editData() {
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
            $modal.modal('toggle')
            $modalLabel.text('Form Ubah Data Kartu Keluarga')

            const data = $table.bootstrapTable('getSelections')[0];

            $.each(data, function(i, val) {
                $('#' + i).val(val);
            });

            $('#anak').val(data.anak.map(v => v.nik))

            $('.selectpicker').selectpicker('refresh')

            $form.data('bootstrapValidator').validate();
        }

        function hapusData() {
            const listKK = $table.bootstrapTable('getSelections').map(v => v.kk)

            swal({
                    text: `${listKK.length} data KK akan dihapus?`,
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

                    $.ajax('<?= base_url('api/deleteKK') ?>', {
                        method: 'post',
                        data: {
                            listKK
                        }
                    }).then(res => {
                        swal(res.message, {
                            icon: res.error ? 'error' : 'success',
                            buttons: false,
                            timer: 2000,
                        });

                        if (res.error) return

                        listKK.forEach(nik => {
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

            data['anak'] = JSON.stringify($('#anak').val())

            if (aksi == 'Tambah') {
                $.ajax('<?= base_url('api/kk') ?>', {
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

                    res.data['nama_kepala'] = $('button[data-id=kepala_keluarga').text()
                    res.data['nama_istri'] = $('button[data-id=istri').text()

                    $table.bootstrapTable('append', res.data);
                })
            } else {
                data['where'] = $table.bootstrapTable('getSelections')[0].kk

                $.ajax('<?= base_url('api/updateKK') ?>', {
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

                    res.data['nama_kepala'] = $('button[data-id=kepala_keluarga').text()
                    res.data['nama_istri'] = $('button[data-id=istri').text()

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

        function detailFormatter(index, row) {
            let tbl = `<h4 class="m-b-35">Data Anak</h4>
            <div class="table-responsive">
                        <table class="table">
                        <thead>
                                <tr>
                                    <th style="height:15px; padding: 10px; color: white;">#</th>
                                    <th style="height:15px; padding: 10px; color: white;">Nomor Induk Kependudukan</th>
                                    <th style="height:15px; padding: 10px; color: white;">Nama</th>
                                </tr>
                            <tbody>`
            if (row.anak.length == 0) tbl += `<tr><td colspan="3" class="text-center">Belum ada data</td></tr>`

            let no = 1;
            for (const item of row.anak) {
                tbl += `<tr>
                            <td>Anak ke-${no++}</td>
                            <td>${item.nik}</td>
                            <td>${item.nama}</td>
                        </tr>`
            }

            tbl += `</tbody>                   
                </table>
            </div>`

            return tbl
        }
    </script>
    </body>

    </html>
    <!-- end document-->