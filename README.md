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

-   Quan he 1 - 1 (sub -> parent)
    return $this->belongsTo(Category::class,'category','id');
    //belongsTo(table name, khoa ngoai cua table Sub, khoa chinh )
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

- Phan trang trong trang loai
    'posts' => Category::find($category->id)->getPosts()->paginate(1)

- Hien thi phan trang
    {{ $posts->links() }}

- Neu muon su dung boostrap thi vao file AppServiceProvider
    use Illuminate\Pagination\Paginator;

    //add this to boot funtion
    Paginator::useBootstrapFive();
```

# Lam viec voi middleware

```
- tao midlleware de kiemtr a login truoc khi truy cap route (unikey bi loi)
    php artisan make:middleware kiemtraLoginGuard

- Khai bao them o file Kernel.php
    protected $routeMiddleware = [
        'kiemtraLoginGuard' => \App\Http\Middleware\kiemtraLoginGuard::class,
    ]

- CHinh sau file config\Auth.php (vi cai nay minh ko dungt oi table users cua he thong)

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ]
    ],


- Kiem tra xem da co thongt in dang nhap bang Guard admin chua
class kiemtraLoginGuard
{
    public function handle(Request $request, Closure $next)
    {
        // cai nay xu ly neu dung guard
        if(!Auth::guard('admin')->check())

        //cai nay la mac dinh dung theo table users
        // if (!Auth ::check())
        {
            return redirect('/admin/login');
        }
        return $next($request);
    }
}


- Xu ly ham check login

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            //thiet lap session
            $request->session()->regenerate();

            //info user current
            $current_user = Auth::guard('admin')->user();
            //put to session
            $request->session()->put('current_user',$current_user);

            
            return redirect('/admin/dashboard');
            //dd("thanh cong");
            // $user = Auth::guard('admin')->user();
            // dd($user);
        } else {
            return back();
        }

- Them dong nay neu nhu bi loi vao Model Admin
    use Illuminate\Foundation\Auth\User as Authenticatable;
    class Admin extends Authenticatable


- Logout

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect('/admin/login');
    }


- Xu ly phan quyen user theo roles (middleware)

    php artisan make:middleware phanquyenUser

    - them vao krenel
    protected $routeMiddleware = [
        'phanquyenUser' => \App\Http\Middleware\phanquyenUser::class,
    ];



- Quan trong
    public function handle(Request $request, Closure $next, ...$roles)
    {
        dd($roles) -> no se in ra 1 mang

        Sau do dua vao $request de tien hanh sang loc user nay co quyen han vao day khong

        return $next($request);
    }

    Roles la 1 mang, bang cach goi middleware theo cach sau
    Route::middleware('phanquyenUser:1,2')

- Vi du
    group quan ly category thiet lap MiddleWare('phanquyenUser:1')
    Vi vay khi login bang tai khoan bientap (co idGroup = 2)
    Vi in_array(2,[1]) -> false
    Nen no khong the vao day duoc -- done
    
```

# Ket noi mot luc voi nhieu database

> Khai bao them thong tin trong file .env
```
# khai bao connect thu 2 de thuc hien thong ke
DB_CONNECTION_DH=mysql
DB_HOST_DH=127.0.0.1
DB_PORT_DH=3306
DB_DATABASE_DH=laravel_dathen
DB_USERNAME_DH=root
DB_PASSWORD_DH=
```
> Khai bao them 1 connection trong file database.php
```
'mysqldh' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_DH'),
            'host' => env('DB_HOST_DH', '127.0.0.1'),
            'port' => env('DB_PORT_DH', '3306'),
            'database' => env('DB_DATABASE_DH', 'forge'),
            'username' => env('DB_USERNAME_DH', 'forge'),
            'password' => env('DB_PASSWORD_DH', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
```

> Thuc hien query voi DB
```
return DB::connection('mysqldh')->table('bstv')->get();
```