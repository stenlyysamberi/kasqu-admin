@extends('main.index')
@section('menu')
     <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $menu1 }}</a></li>
                    <li class="breadcrumb-item active">{{ $menu2 }}</li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

@if (session('masuk'))
<div class="alert alert-success" role="alert">
    <i class="mdi mdi-check-all mr-2"></i>  {{ session('masuk') }}
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-8">
                    <form method="POST" class="form-inline" action="#">
                        <div class="form-group">
                            <label for="inputPassword2" class="sr-only">Search</label>
                            <input type="search" name="keyword" class="form-control" id="inputPassword2" placeholder="Search...">
                        </div>
                        <div class="form-group mx-sm-3">
                            <label for="status-select" class="mr-2">Sort By</label>
                            <select class="custom-select" id="status-select">
                                <option selected="">Semua</option>
                               
                                
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="text-lg-right mt-3 mt-lg-0">
                        <button type="button" class="btn btn-success waves-effect waves-light mr-1"><i class="mdi mdi-cog"></i></button>

                        <a data-toggle="modal" data-target="#AddMoney" href="#" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i>Bayar Kas</a>
                    </div>
                </div><!-- end col-->
            </div> <!-- end row -->
        </div> <!-- end card-box -->
    </div> <!-- end col-->
</div>

<div class="row">
    <div class="col-12">
       <div class="card-box">
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Petugas</th>
                  <th scope="col">Jumlah Bayar</th>
                  <th scope="col">Waktu Bayar</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($keluar as $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration }}</th>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jumlah_keluar }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->catatan }}</td>

                    <td>
                        <div class="row">
                            <div class="btn-group">
                                <a data-toggle="modal" data-target="#edit_kasmasuk{{ $item->pengeluaran_id }}" href="#" class="btn btn-secondary btn-sm"> <i class="fas fa-edit"></i></a>
                                <form action="/del_pengeluaran" method="post">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->pengeluaran_id }}">
                                    <button onclick="return confirm('apakah Anda akan menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>

                    <form enctype="multipart/form-data" method="POST" action="/edit_kaskeluar">
                        @csrf
                        <div id="edit_kasmasuk{{ $item->pengeluaran_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                    
                                        <h4 class="modal-title">Edit Kas Keluar</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body p-4">
                    
                                       <input hidden type="text" name="pengeluaran_id" value="{{ $item->pengeluaran_id }}">
                    
                                       <div class="row">
                                       
                                    </div>
                
                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Jumlah Bayar</label>
                                            <input type="text" value="{{ $item->jumlah_keluar }}" name="jumlah_keluar" required="required" class="form-control" id="field-3" placeholder="Juml Bayar">
                                        </div>
                                    </div>
                                </div>
                               
                                
                                
                
                            
                
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="field-7" class="control-label">Keterangan</label>
                                            <textarea name="catatan" required="required" class="form-control" id="field-7" placeholder="Enter Text">{{ $item->catatan }}</textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="col-md-12">
                
                                         <h4 class="header-title">Image Profil</h4>
                                        <p class="sub-header">
                                           Set your Profil Image.
                                        </p>
                
                                        <input disabled type="file" name="image" class="form-control" width="100" />
                                        
                                    </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Ok, Simpan</button>
                            </div>
                    
                    
            
                        </div>
                    
                           
                    
                    
                    </form>
               
                        @endforeach
              </tbody>
        </table>
       </div>
    </div>

</div>


{{-- Section Modal add --}}
<form method="POST" action="/tamba_kaskeluar" enctype="multipart/form-data">
    @csrf
    <div id="AddMoney" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input hidden type="text" value="{{ auth()->user()->user_id }}" name="user_id">
                    <h4 class="modal-title">Tamba Kas Keluar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Jumlah Keluar</label>
                            <input type="text" name="jumlah_keluar" required="required" class="form-control" id="field-3" placeholder="Juml Keluar">
                        </div>
                    </div>
                </div>
               
                
                

            

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Keterangan</label>
                            <textarea name="catatan" required="required" class="form-control" id="field-7" placeholder="Enter Text"></textarea>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                         <h4 class="header-title">Image Profil</h4>
                        <p class="sub-header">
                           Set your Profil Image.
                        </p>

                        <input type="file" name="image" disabled class="form-control" width="100" />
                        
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info waves-effect waves-light">Ok, Simpan</button>
        </div>



    </div>


</form>
@endsection