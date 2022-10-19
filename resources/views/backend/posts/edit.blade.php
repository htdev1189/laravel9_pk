@extends('backend.template')

@section('css')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">

    <style>
        #description-out .ck-editor__editable {
            min-height: 200px;
        }
        #content-out .ck-editor__editable {
            min-height: 500px;
        }

        .ck-editor__editable p {
            margin: .2rem 0;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">

        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Post</h3>
                            </div>

                            @if ($errors->any())
                                <div class="callout callout-danger">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-danger">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="/admin/posts/update">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ $post->title }}"
                                            placeholder="Enter title">
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2" style="width: 100%;" name="category" >
                                            @foreach ($categories as $cat)
                                                <option @if ($cat->id == $post->category)
                                                    selected
                                                @endif value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="description-out">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="10" placeholder="Enter description here">{{ $post->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="image" name="image" value="{{ $post->image }}">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info btn-flat"
                                                    id="open_ckfinder">Choise</button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <img id="Thumbnail" src="{{ $post->image }}" style="width: 400px">
                                    </div>

                                    <div class="form-group" id="content-out">
                                        <label>Content</label>
                                        <textarea class="form-control" name="content" id="content" rows="20" placeholder="Enter content here">{{ $post->content }}</textarea>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
    <!-- jQuery -->
    <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin_assets/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
            $('.select2').select2();
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo']
            })
            .catch(function(error) {
                console.error(error);
            });


            ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo']
            })
            .catch(function(error) {
                console.error(error);
            });
    </script>

    <script>
        let open_ckfinder = document.getElementById('open_ckfinder');
        open_ckfinder.addEventListener('click', function() {
            CKFinder.popup({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function(finder) {
                    //event choise file
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        var output = document.getElementById('image');
                        output.value = file.getUrl();
                        var thumbnail = document.getElementById('Thumbnail');
                        thumbnail.setAttribute('src', file.getUrl());
                    });
                }
            });
        });
    </script>
@endsection
