@extends('main.index')
@section('menu')
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

@if (session('user'))
<div class="alert alert-success" role="alert">
    <i class="mdi mdi-check-all mr-2"></i>  {{ session('user') }}
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

                        <a data-toggle="modal" data-target="#add-user" href="#" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> New</a>
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
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">Profil</th>
                  <th scope="col">NIP</th>
                  <th scope="col">No.Hp</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($userman as $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration }}</th>
                    <td>{{ $item->nama }}</td>
                    <td class="table-user">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="table-user" class="mr-2 rounded-circle">
                    </td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->level }}</td>
                    <td>
                        <div class="row">
                            <div class="btn-group">
                                <a data-toggle="modal" data-target="#edit_userman{{ $item->user_id }}" href="#" class="btn btn-secondary btn-sm"> <i class="fas fa-edit"></i></a>
                                {{-- <button data-toggle="model" data-target="#edit_userman" class="btn btn-secondary btn-sm"><i class="fas fa-edit " aria-hidden="true"></i></button> --}}
                               
                                <form action="/del_userman" method="post">
                                    @csrf
                                    {{-- @method('delete') --}}
                                    <input hidden name="oldimage" type="text" value="{{ $item->gambar }}">
                                    <input hidden type="text" name="id" value="{{ $item->user_id }}">
                                    <button onclick="return confirm('apakah Anda akan menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>


                    {{-- blok edit userman --}}

                    <form enctype="multipart/form-data" method="POST" action="/edit_userman">
                        @csrf
                        <div id="edit_userman{{ $item->user_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                    
                                        <h4 class="modal-title">Edit Userman</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body p-4">
                    
                                       <input hidden type="text" name="user_id" value="{{ $item->user_id }}">
                    
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Nama Lengkap</label>
                                                <input type="text" value="{{ $item->nama }}" name="nama"  class="form-control" id="field-3" placeholder="Nama Lengkap">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Password</label>
                                                <input type="password" value="{{Hash::check($item->password)}}" name="nama"  class="form-control" id="field-3" placeholder="Nama Lengkap">
                                            </div>
                                        </div> --}}
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">NIP</label>
                                                <input type="text" value="{{ $item->nip }}" name="nip" required="required" class="form-control" id="field-3" placeholder="NIP">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="field-2"  class="control-label">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" required="required" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanitar</option>
                
                                                </select>
                                        </div>
                                    </div>
                                   
                    
                                   
                                    
                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Phone</label>
                                                <input value="{{ $item->phone }}" type="text" maxlength="12" name="phone" class="form-control" id="field-1" required="required" placeholder="+62">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-2"  class="control-label">Level</label>
                                                <select name="level" required="required" class="form-control">
                                                    <option value="">Pilih</option>
                                                    
                                                    <option value="stafadmin">Staff Admin</option>
                                                    <option value="kabag">Kepala Bagian</option>
                                                    <option value="dosen">Dosen</option>
                                                    <option value="owner">Owner Mitra</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                    
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group no-margin">
                                                <label for="field-7" class="control-label">Alamat Rumah</label>
                                                <textarea name="alamat" required="required" class="form-control" id="field-7" placeholder="Enter Text">{{ $item->alamat }}</textarea>
                                            </div>
                                            
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md-12">

                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" alt="" srcset="">
                    
                                            {{-- <h4 class="header-title">Image Profil</h4>
                                            <p class="sub-header">
                                               Set your Profil Image.
                                            </p> --}}
                                            <input name="imageOld" hidden type="" value="{{ $item->gambar }}">
                                            <input type="file"  name="gambar" class="form-control" width="100" />
                                            
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
                    
                    </form>

                    {{-- End Blok Edit Userman --}}








                  </tr>
                @endforeach
              </tbody>
        </table>
       </div>
    </div>

</div>


{{-- Section Modal add --}}
<form method="POST" action="/add_userman" enctype="multipart/form-data">
    @csrf
    <div id="add-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">


                   <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Nama Lengkap</label>
                            <input type="text" required name="nama"  class="form-control" id="field-3" placeholder="Nama Lengkap">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">NIP</label>
                            <input type="text" name="nip" required="required" class="form-control" id="field-3" placeholder="No. Pegawai">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Password</label>
                            <input type="password" name="password" required="required" class="form-control" id="field-3" placeholder="Password">
                        </div>
                    </div>
                </div>
               
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="field-3"  class="control-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required="required" class="form-control">
                            <option value="">Pilih</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                </div>
                </div>
                

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Phone</label>
                            <input type="text" maxlength="12" name="phone" class="form-control" id="field-1" required="required" placeholder="+62">
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2"  class="control-label">Level</label>
                            <select name="level" required="required" class="form-control">
                                <option value="">Pilih</option>
                                <option value="stafadmin">Staff Admin</option>
                                <option value="kabag">Kepala Bagian</option>
                                <option value="dosen">Dosen</option>
                                <option value="owner">Owner Mitra</option>
                               
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Alamat Rumah</label>
                            <textarea name="alamat" required="required" class="form-control" id="field-7" placeholder="Enter Text"></textarea>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                         <h4 class="header-title">Image Profil</h4>
                        <p class="sub-header">
                           Set your Profil Image.
                        </p>

                        <input type="file" name="gambar" class="form-control" width="100" />
                        
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