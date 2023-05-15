@extends('layouts.default')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Berita</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Basic Form</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Berita</div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="post" action="{{  url('berita-update/' .$berita->id) }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" class="form-control" id="judul" value="{{ $berita->judul }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Isi Berita</label>
                                        <textarea name="body" class="form-control" >{{ $berita->body }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori_id" class="form-control">
                                            @foreach ($kategori as $row)
                                            @if ($row->id == $berita->kategori_id)
                                            <option value="{{ $row->id}}" selected='selected'>{{ $row->nama_kategori }}</option>
                                            @else
                                            <option value="{{ $row->id}}">{{ $row->nama_kategori }}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Ubah Gambar</label>
                                        <input type="file" name="gambar" class="form-control-file" id="gambar">
                                        <br>
                                        <label for="gambar">Gambar saat ini</label><br>
                                        <img src="{{ asset('uploads/' . $berita->gambar)}}" width="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" class="form-control">
                                            <option value="1" {{ $berita->is_active == '1' ? 'selected' : ''}}>Publish</option>
                                            <option value="0" {{ $berita->is_active == '0' ? 'selected' : ''}}>Draf</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button class="btn btn-danger" href="{{ route('berita.index') }}">Cancel</button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection