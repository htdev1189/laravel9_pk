# Add ckfinder 5

> Add ckeditor via CDN
```
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
```
> Download ckfinder, paste to public folder
```
<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
```

>add to id (textarea element)
```
<script>
        ClassicEditor
        .create( document.querySelector( '#description' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
        } )
        .catch( function( error ) {
            console.error( error );
        } );
    </script>
```

> edit ckfinder/config.php
```
$config['authentication'] = function () {
    return true;
    //session here
};
'baseUrl'      => 'http://laravel.htdev/public/upload/',
```