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



# Mot so luu y them

> fix findOrFail by try catch
```
 @php
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    try {
        $data = App\Models\Category::findOrFail($category->parent);
        echo $data->name;
    } catch (ModelNotFoundException $e) {
        echo "No parent";
        }
    @endphp
```

> create request (validate data before insert, delete, update to database)
```
- create request
php artisan make:request addCategoryRequest

- edit file app\http\request\ten_request.php
public function authorize(){return true;}
    // kiem tra nam o day
    public function rules()
    {
        return [
            'name' => 'required|unique:App\Models\Category,name'
        ];
    }
    //thay doi thong bao
    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên Danh Mục',
            'name.unique' => 'Danh mục đã tồn tại'
        ];
    }

- call request from controller
use App\Http\Requests\Ten_Request;

- change params 
public function store(addCatRequest $request){
        $validated = $request->validated();
        //code if success validate
    }
```

> validate edit category
```
- neu nhu ten danh muc trong, va ten danh muc trung voi ten danh muc trong database (khac voi ten danh muc hien tai) thi bao loi
use Illuminate\Validation\Rule;
$data = $request->input();
$request->validate([
	'name' => [
		'required',
         Rule::unique('categories','name')->ignore($data['id']),
         //categories : table name
         //name : colum name
         //id: primary key
	]
	],
    [
    	'name.required' => 'Danh mục không được để trống',
        'name.unique' => 'Danh mục đã tồn tại'
]);
```

> Xu ly quan he Models
```
- Quan he 1 - 1 (vi du : post -> category)
    public function getCategory()
    {
        return $this->hasOne(Category::class,'id','category');
        //id -> primary key (categories table)
        //category -> foreign key (posts table)
    }
    // goi ra
    {{ App\Models\Post::find($post->id)->getCategory->name }}

1 Quan he 1 - Nhieu (Cat -> Post)
    public function getPosts()
    {
        return $this->hasMany(Post::class,'category','id');
        //hasMany('table','khoa ngoai tai table huong toi','khoa chinh')
    }
```

> config app.php (update time)
```
'timezone' => 'Asia/Ho_Chi_Minh',
```

> theme frontend
```
http://preview.themeforest.net/item/medicare-medical-health-theme/full_screen_preview/14444927?_ga=2.122418063.583191128.1666164878-369493133.1666164878
```

> sua loi baseUrl ckfinder
```
- vi warmserver đã tạo ra laravel.htdev từ thu mục public nên ko cần public trong baseUrl nữa
    'baseUrl'      => 'http://laravel.htdev/upload/',
```

> Mot so luu y voi Model
```
- Xu ly route(Dua .html len tren)
    Route::get('/{slug}.html',[frontendController::class,'post']);
    Route::get('/{slug}',[frontendController::class,'category']);

- Xu ly link cua NAV
    luon luon goi ve trang chu
        {{ URL::to('/') }}

- Xu ly content (Khong co HTML)
    {!! $new->content !!}
```