<?php $this->load->view('admin/header') ?>
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') ?>">
<!-- PAGE CONTENT-->
<div class="page-content--bgf7" id="app">
    <!-- WELCOME-->
    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-5">Data Geolokasi
                    </h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- STATISTIC CHART-->
    <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <strong>Map</strong>
                            <small> Form</small>
                        </div>
                        <div class="card-body">
                            <!-- MAP-->
                            <div id="map" style="height: 650px; position: relative; overflow: hidden;"></div>
                            <!-- END MAP -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <strong>Detail</strong>
                            <small> Form</small>
                        </div>
                        <div class="card-body card-block">
                            <div class="table-data__tool">
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--blue2 au-btn--small" @click="tambahRumah" :disabled="!btnTambah || rumahAktif" id="btnTambah">
                                        <i class="zmdi zmdi-plus"></i>Tambah</button>
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" :disabled="!rumahAktif" @click="ubahRumah">
                                        <i class="zmdi zmdi-edit"></i>Ubah</button>
                                    <button class="au-btn au-btn-icon au-btn--red au-btn--small" @click="hapusRumah" :disabled="!rumahAktif">
                                        <i class="zmdi zmdi-delete"></i>Hapus</button>
                                    <button v-show="rumahAktif || onSimpan" class="au-btn au-btn-icon au-btn--orange au-btn--small" @click="batalKlik">
                                        <i class="zmdi zmdi-block"></i>Batal</button>
                                </div>
                            </div>
                            <form id="formKK" onsubmit="return false">
                                <div class="form-group">
                                    <label for="kk" class=" form-control-label">Nomor KK</label>
                                    <select class="selectpicker show-tick form-control" data-style="btn-outline-secondary" data-live-search="true" id="kk" title="- Pilih Nomor KK" v-on:change="changeSelectKK(event.target.value)">
                                    </select>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="table" data-toggle="table" data-unique-id="id">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th data-field="kategori">#</th>
                                            <th data-field="nama">Nama</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC CHART-->

    <?php $this->load->view('admin/footer') ?>
    <!-- <script src="<?= base_url('/assets/vendor/vue/js/vue-dev.js') ?>"></script> -->
    <script src="<?= base_url('/assets/vendor/vue/js/vue.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-table/bootstrap-table-id-ID.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/jquery-serializeObject.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-select/js/defaults-id_ID.min.js') ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7B9RynI4hQM_Y4BG9GYxsTLWwYkGASRo&libraries=places&language=id"></script>

    <script>
        new Vue({
            el: '#app',
            data: function() {
                return {
                    gmarkers: {},
                    rumahAktif: false,
                    onSimpan: false,
                    onUpdate: false,
                    btnTambah: false,
                    prefKK: null
                }
            },
            mounted: function() {
                this.initMap()
            },
            created: function() {
                this.loadGeolokasi()
                this.loadDataKK()
            },
            methods: {
                initMap: function() {
                    this.map = new google.maps.Map(document.getElementById('map'), {
                        mapTypeId: 'roadmap',
                        minZoom: 13,
                    });

                    this.infowindow = new google.maps.InfoWindow();

                    new google.maps.KmlLayer({
                        url: 'www.malproperty.id/assets/malimpung.kmz', //malimpung.kml
                        map: this.map
                    });
                },
                makeMarker: function(position, draggable = false) {
                    const self = this

                    const marker = new google.maps.Marker({
                        kk: this.kk,
                        draggable,
                        animation: google.maps.Animation.DROP,
                        position,
                        map: this.map,
                        icon: '<?= base_url('/assets/images/marker.png') ?>',
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        if (self.onSimpan || self.prefKK === this.kk) return
                        self.changeSelectKK(this.kk)
                        self.prefKK = this.kk
                    });

                    this.gmarkers[this.kk] = marker
                },
                loadGeolokasi: function() {
                    $.ajax('<?= base_url('api/geolokasi') ?>').then(res => {
                        for (const item of res) {
                            const position = new google.maps.LatLng(item.latitude, item.longitude)
                            this.kk = item.kk
                            this.makeMarker(position)
                        }
                    })
                },
                loadDataKK: function() {
                    $.ajax('<?= base_url('api/kk') ?>', {
                        data: {
                            get: 'kk_only'
                        }
                    }).then(res => {
                        const _createOpt = (list) => {
                            let opt = [];

                            list.map(v => {
                                opt.push(`<option value="${v.kk}">${v.kk}</option>`)
                            })

                            return opt
                        }

                        $('#kk').append(_createOpt(res).join('')).selectpicker('refresh')
                    })
                },
                changeSelectKK: function(val) {
                    if (this.marker) {
                        this.batalKlik()
                    }

                    this.marker = this.gmarkers[val]

                    if (this.marker) {
                        this.marker.setOptions({
                            icon: '<?= base_url('/assets/images/marker-active.png') ?>'
                        })

                        this.prevPosition = this.marker.getPosition()
                        this.map.panTo(this.marker.getPosition())
                        this.map.setZoom(17);

                        // $('#kk').attr('disabled', true).selectpicker('refresh')
                        $('#kk').attr('disabled', true).val(val).selectpicker('refresh')
                    }


                    $('#table').bootstrapTable('showLoading');

                    $.ajax('<?= base_url('api/kk') ?>', {
                        data: {
                            get: 'all',
                            kk: val
                        }
                    }).then(res => {
                        const {
                            nama_kepala,
                            nama_istri,
                            anak
                        } = res[0]

                        const data = [{
                            kategori: '<b>Kepala Keluarga</b>',
                            nama: nama_kepala
                        }, {
                            kategori: '<b>Istri</b>',
                            nama: nama_istri
                        }]

                        const dataAnak = anak.map((v, i) => {
                            return {
                                kategori: `<b>Anak ke-${i+1}</b>`,
                                nama: v.nama
                            }
                        })
                        $('#table').bootstrapTable('hideLoading');
                        $('#table').bootstrapTable("load", [...data, ...dataAnak]);
                    })


                    this.kk = val
                    this.prefKK = val
                    // cek Data KK
                    $.ajax('<?= base_url('api/validator') ?>', {
                        data: {
                            validator: 'geolokasi',
                            kk: this.kk
                        }
                    }).then(res => {
                        this.btnTambah = res.valid
                        this.rumahAktif = !res.valid
                    })
                },
                setAksi: function(aksi) {
                    let url = '<?= base_url('api/') ?>';

                    switch (aksi) {
                        case 'simpan':
                            url += 'geolokasi'
                            this.onUpdate = true
                            break;
                        case 'update':
                            url += 'updateGeolokasi'
                            this.onUpdate = true
                            break;
                        case 'hapus':
                            url += 'deleteGeolokasi'
                            this.onUpdate = false
                            break;
                    }

                    swal({
                            text: `Lokasi akan di${aksi}?`,
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
                        .then(send => {
                            if (send == null) return

                            const data = {
                                kk: this.kk,
                                latitude: this.marker.getPosition().lat(),
                                longitude: this.marker.getPosition().lng()
                            }

                            $.ajax(url, {
                                method: 'post',
                                data
                            }).then(res => {
                                swal(res.message, {
                                    icon: res.error ? 'error' : 'success',
                                    buttons: false,
                                    timer: 1000,
                                });

                                if (res.error) return

                                this.prevPosition = this.marker.getPosition()
                                this.batalKlik()
                            })
                        })
                },
                tambahRumah: function() {
                    if (!this.onSimpan) {
                        this.makeMarker(this.map.getCenter(), true)
                        this.marker = this.gmarkers[this.kk]
                        this.infowindow.setContent("Silangkan geser marker");
                        this.infowindow.open(this.map, this.marker);

                        this.onSimpan = true
                        this.onUpdate = false
                        $('#btnTambah').html('<i class="zmdi zmdi-save"></i>Simpan')
                        $('#kk').attr('disabled', true).selectpicker('refresh')
                        return
                    }

                    const aksi = this.onUpdate ? 'update' : 'simpan';
                    this.setAksi(aksi)
                },
                ubahRumah: function() {
                    const marker = this.gmarkers[this.kk]
                    marker.setOptions({
                        draggable: true
                    })
                    this.infowindow.setContent("Silangkan geser marker");
                    this.infowindow.open(this.map, marker);

                    this.onUpdate = true
                    this.btnTambah = true
                    this.onSimpan = true
                    this.rumahAktif = !true
                    $('#btnTambah').html('<i class="zmdi zmdi-save"></i>Simpan')

                },
                hapusRumah: function() {
                    this.onSimpan = true
                    this.setAksi('hapus')
                },
                batalKlik: function() {
                    this.rumahAktif = false

                    const target = typeof event === 'object' ? event.target.localName : true
                    if (target != 'img' && target != 'select') {
                        $('#kk').attr('disabled', false).val('').selectpicker('refresh')
                        $('#table').bootstrapTable('removeAll')
                    }

                    const marker = this.gmarkers[this.kk]

                    if (marker) {
                        marker.setOptions({
                            draggable: false,
                            icon: '<?= base_url('/assets/images/marker.png') ?>',
                            position: this.prevPosition
                        })

                        this.infowindow.close()

                        if (!this.onUpdate) {
                            this.map.setZoom(13);
                        }
                    }

                    this.marker = null
                    this.prefKK = null
                    if (this.onSimpan) {
                        this.onSimpan = false
                        this.btnTambah = false
                        $('#btnTambah').html('<i class="zmdi zmdi-plus"></i>Tambah')
                        if (!this.onUpdate) {
                            marker.setMap(null)
                            this.gmarkers[this.kk] = null
                        }
                    }
                },

            }
        })
    </script>

    </body>

    </html>
    <!-- end document-->