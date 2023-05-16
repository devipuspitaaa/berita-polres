@extends('layouts.default')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Berita</h4>
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
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Datatables</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Berita</h4>
                            <a class="btn btn-primary btn-round ml-auto" href="/createBerita"><i class="fa fa-plus"></i> Tambah Berita</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Slug</th>
                                        <th>Author</th>
                                        <th>Gambar</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($berita as $b)
                                    <tr>
                                        <td>{{ $no++}}</td>
                                        <td>{{ $b->judul}}</td>
                                        <td>{{ $b->kategori->nama_kategori}}</td>
                                        <td>{{ $b->slug}}</td>
                                        <td>{{ $b->user->name}}</td>
                                        <td> 
                                            <img src=" {{ asset('uploads/' . $b->gambar) }} " width="100"> 
                                        </td>
                                        <td>
                                        <form action="{{ route('berita.destroy',$b->id) }}" method="POST">
                                                <a href="{{ url('berita/update/'. $b->id) }}">
                                                    <button class="btn btn-link btn-primary btn-lg" type="button" rel="tooltip">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link btn-danger" type="submit" rel="tooltip">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection