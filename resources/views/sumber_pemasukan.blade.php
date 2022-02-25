@extends('main.index')

@section('menu')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $menu1 }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $menu2 }}</a></li>
                    <li class="breadcrumb-item active">{{ $menu3 }}</li>
                </ol>
            </div>
            <h4 class="page-title">Sumber Masuk</h4>
        </div>
    </div>
</div>

@if (session('mitra'))

      <div class="alert alert-success" role="alert">
        <i class="mdi mdi-check-all mr-2"></i>  {{ session('mitra') }}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <a data-toggle="modal" data-target="#add-dokter" href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>Baru</a>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>
                            <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                            <button type="button" class="btn btn-light mb-2">Export</button>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                
                                <th>Pemilik/Owner</th>
                                <th>Phone</th>
                                <th>Alamat</th>
                                <th>Nama Usaha </th>
                                
                                <th style="width: 75px;">Action</th>
                            </tr>

                            <tbody>
                                @foreach ($mitra as $item)
                                <tr>
                                    <th scope="row"> {{ $loop->iteration }}</th>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->nama_usaha }}</td>
                                   
                                   
                                    
                                    <td>
                                        <div class="row">
                                            <div class="btn-group">
                                                <a data-toggle="modal" data-target="#edit_userman{{ $item->user_id }}" href="#" class="btn btn-secondary btn-sm"> <i class="fas fa-edit"></i></a>
                                                {{-- <button data-toggle="model" data-target="#edit_userman" class="btn btn-secondary btn-sm"><i class="fas fa-edit " aria-hidden="true"></i></button> --}}
                                               
                                                <form action="/del_mitra" method="post">
                                                    @csrf
                                                    {{-- @method('delete') --}}
                                                    <input hidden type="text" name="id" value="{{ $item->user_id }}">
                                                    <button onclick="return confirm('apakah Anda akan menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                
                
                                    {{-- blok edit userman --}}
                
                                    <form enctype="multipart/form-data" method="POST" action="/edit_mitra">
                                        @csrf
                                        <div id="edit_userman{{ $item->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                    
                                                        <h4 class="modal-title">Edit Mitra</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <input hidden type="text"name="mitra_id" value="{{ $item->mitra_id }}">
                                                       <input hidden type="text" name="user_id" value="{{ $item->user_id }}">
                                    
                                                       <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Nama Usaha</label>
                                                                <input type="text" value="{{ $item->nama_usaha }}" name="nama_usaha"  class="form-control" id="field-3" placeholder="Nama Lengkap">
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                             
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="field-2"  class="control-label">Owner/Pemilik</label>
                                                                <select name="user_id" required="required" class="form-control">
                                                                    <option value="">Pilih</option>
                                                                 
                                                                     @foreach ($userman as $item)
                                                                            <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                                                     @endforeach
                                
                                                                </select>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Ok, Simpan</button>
                                                </div>
                                            </div>
                                           
                                    
                                    
                            
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                    </form>
                
                                  </tr>
                                @endforeach
                              </tbody>

                        </thead>

                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>


{{-- add form model --}}

<form method="POST" action="/create_mitra" enctype="multipart/form-data">
    @csrf
    <div id="add-dokter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">


        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">New</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body p-4">


                   <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Nama Usaha</label>
                            <input type="text" name="nama_usaha"  class="form-control" id="field-3" placeholder="Nama Lengkap">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Nama Owner</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($userman as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
               

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info waves-effect waves-light">Ok, Simpan</button>
            </div>
        </div>
        



    </div>
</div>

</div>

</form>


{{-- and add --}}

@endsection
