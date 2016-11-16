@extends('layouts.template')

@push('css')
  {{ Html::style('assets/js/gritter/css/jquery.gritter.css') }}
  {{ Html::style('assets/bower_components/datatables.net-dt/css/jquery.dataTables.css') }}
  {{ Html::style('assets/bower_components/datatables.net-select-dt/css/select.dataTables.min.css') }}
@endpush

@push('js')  
  {{ Html::script('assets/bower_components/datatables.net/js/jquery.dataTables.js') }}
  {{ Html::script('assets/bower_components/datatables.net-select/js/dataTables.select.min.js') }}
  {{ Html::script('pages/nasabah.js') }}
@endpush

@section('title', config('app.name').' - Daftar Nasabah')

@section('content')
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9">
                    
                    <h3> <i class="fa fa-users"></i> Daftar Nasabah</h3>
                    
                    <div class="row mtbox" style="margin-bottom: 10px">
                      <div class="col-sm-12">
                        <div class="btn-group pull-right">
                          <button class="btn btn-default" id="tambah">Tambah</button>
                          <button class="btn btn-default" id="ubah">Ubah</button>
                          <button class="btn btn-default" id="ganti">Ganti Kartu</button>
                          <button class="btn btn-default" id="hapus">Hapus</button>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 0px">
                      <div class="col-sm-12">
                        <div class="content-panel">
                                <section id="unseen">
                                  <table class="table table-bordered table-condensed" id="table" style="cursor: pointer">
                                    <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Status Kartu</th>
                                    </tr>
                                    </thead>
                                </table>
                                </section>
                        </div>
                      </div>
                    </div><!-- /row -->  
                  
          
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  @include('fixed.notification')
          </section>
      </section>
<!-- /MAIN CONTENT -->
@endsection