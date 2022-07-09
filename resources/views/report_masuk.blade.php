@extends('main.index')

@section('menu')

<div class="row">
        <div class="col-12">
            <div class="page-title-box">
            <div class="page-title-right">
            <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">AJaya</a></li>
            <li class="breadcrumb-item"><a href="javascript: void(0);">Owner</a></li>
            <li class="breadcrumb-item active">Laporan</li>
            </ol>
            </div>
            <h4 class="page-title">Report</h4>
            </div>
        </div>
</div>

<div class="row">
    <div class="col-12">
    <div class="card-box">
    <div class="row">
    <div class="col-lg-8">
    <form  id="form-cari" class="form-inline" action="/report_masuk" method="GET">
        @csrf
        <div class="form-group">
            <label for="inputPassword2" class="sr-only"></label>
            <input id="from"  type="date" name="from" class="form-control" required="required">
        </div>
        <div class="form-group mx-sm-3">
            <label for="status-select" class="mr-2">To</label>
            <input id="to" type="date" name="to" class="form-control" required="required">
        </div>
  
    </div>
    <div class="col-lg-4">
    <div class="text-lg-right mt-3 mt-lg-0">
        
        <button type="submit" class="btn btn-danger waves-effect waves-light">Cari</button>
    
        {{-- <a id="cari" href="#" class="btn btn-danger waves-effect waves-light"><i class=" mdi-search mr-1"></i> Cari</a> --}}
    </div>
</form>
    </div><!-- end col-->
    </div> <!-- end row -->
    </div> <!-- end card-box -->
    </div> <!-- end col-->
    </div>
    
    
    <div class="row">
    <div class="col-12">
    <div class="card">
    <div class="card-body" >
    <div id="cetak">
    
    
    <center>
        <div class="row">
            <div class="col-12">
                <h3>LAPORAN KEUANGAN DANA MASUK</h3>
                {{-- <h4>UNIVERSITAS OTTOW GEISSLER PAPUA</h4> --}}
                {{-- <div><p id="tanggal">Tanggal: {{  }} :  - To : </p> </div> --}}
            </div>
        </div>
    
    
    </center><br>
    <div class="row">
        <div class="col-lg-12">
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Mitra Usaha</th>
                        <th scope="col">Jumlah Bayar</th>
                        <th scope="col">Petugas</th>
                        <th scope="col">Tanggal Bayar</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>

                 @foreach ($dana as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_usaha }}</td>
                        <td>{{ $item->jumlah_pemasukan }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->tanggal_masuk }}</td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
          

        </div>
    
    </div> <!-- end row -->
    </div>
    <!-- action buttons-->
    <div class="row mt-4">
    <div class="col-sm-6">
        <a href="ecommerce-products.html" class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
    
            <a onclick="printContent('cetak')" href="#" class="btn btn-success"><i class="mdi mdi-printer mr-1"></i> Print </a>
        </a>
    </div> <!-- end col -->
    <div class="col-sm-6">
                                                <!-- <div class="text-sm-right">
                                                    <a href="ecommerce-checkout.html" class="btn btn-danger"><i class="mdi mdi-cart-plus mr-1"></i> Checkout </a>
                                                </div> -->
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
    
                        <script>
                            function printContent(el){
                              var restorepage = document.body.innerHTML;
                              var printcontent = document.getElementById(el).innerHTML;
                              document.body.innerHTML = printcontent;
                              window.print();
                              document.body.innerHTML = restorepage;
                          }
    
                          function cari_laporan(){
    
                              var data = $('#form-cari').serialize();
                              $.ajax({
                                typo  : 'POST',
                                url   : 'owner/report/tampil.php',
                                data  : data,
                                cache : false,
                                success : function(data){
                                 // $('#tampilkan-laporan').load("owner/report/tampil.php");
                                 $("#tampilkan-laporan").html(data);
                               
    
    
                              }
                          });
    
                          }

                          
    
                      </script>
    
    
@endsection