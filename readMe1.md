# Laravel 9

- ### Link theme
http://preview.themeforest.net/item/medicare-medical-health-theme/full_screen_preview/14444927?_ga=2.122418063.583191128.1666164878-369493133.1666164878

- ### Cài đặt
```
composer create-project laravel/laravel Tên_Project
-> chạy trên warm nên vô trong thư mục www để chạy
```

- ### Một vài hàm cần ghi nhớ
```
{{ assets() }} => Dường dẫn thư mục public (có dấu / cuối)
{{ URL::to('/') }} => thường gắn vô các đường dẫn về trang chủ

// Kiểm tra sự tồn tại của session 
@if(Session::has('sessionName')) 
    {{Session::get('sessionName')}}
@endif
```

- ### Một số thiêt lập khác
```
// thiết lập thời gian trong file config/app.php

'timezone' => 'Asia/Ho_Chi_Minh',

```

- ### Blade
```
Nên tạo 1 cái file template.blade.php (mục đích là tất cả các router đều có phần giao diện chung như header, footer, vv)

    - Thông qua ví dụ cụ thể
    
    - Giả sử tồn tại 1 file template template.blade.php, nội dung của nó kiểu như

    <header></hearder>
    <div id='content'>
        yield(content)
    </div>
    <footer></footer>

    - Tuy nhiên khi dọi view ra thì mình khong gọi file template này, mà gọi tới 1 file khác có tên là content.blade.php
    - Nội dung của file content.blade.php có thể sẽ như này

    @extends('backend.template')
    @section('content')
        "Noi dung html nam trong nay"
    @endsection()

    - Cách hoạt động nó như thế nào
        . nó sẽ lấy toàn bộ html của file template.blade.php trong thu mục resource/views/backend
        . nó sẽ lấy cái nội dung trong section content, chèn vào cái khai báo yield trong file template
    
    - Lý do làm vậy
        . Bởi vì phần content này có thể sẽ khác nhau nếu như chúng ta đang ở trang chủ, trang chi tiết, trang danh mục
    
    - Có thể khai báo section cho phần css, hoặc javascript 
   
```

- ### Multi database

```
    - Trong dự án này, có thêm một cái kết nối để thống kê bên hệ thống đặt hẹn, nên phải thiết lập thêm bằng cách như sau

    - Vào file .env thêm một số thông tin 
        DB_CONNECTION_DH=mysql
        DB_HOST_DH=127.0.0.1
        DB_PORT_DH=3306
        DB_DATABASE_DH=tên_database_thứ2
        DB_USERNAME_DH=user
        DB_PASSWORD_DH=password

    - Vào file database.php trong thư mục config , thêm một cái mới trong biến $connections

        'ten_connect' => [
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

    - Thực hiện query bulder bằng cách
        DB::connection('ten_connect')->table('table_name')->get();
```

- ### Backend

> Phần login
> 
>> Ở đây không dùng table users cho sẵn login, mà dùng 1 table khác nên phải thiết lập 1 số cái 
>```
>Khai báo thêm 1 cái Guards trong file config/Auth.php \
>
>   'guards' => [
>              .....
>       'admin' => [
>           'driver' => 'session',
>           'model' => 'admin'
>       ]       
>    ]
>Thêm 1 providers 
>
>'providers' => [
>         ----------
>         'admin' => [
>             'driver' => 'eloquent',
>             'model' => App\Models\Admin::class, // model admin
>         ]
>     ],
>
>```
>> Khởi tạo 1 cái middleware để quản lý việc login này
>```
>php artisan make:middleware kiemtraLoginGuard
>```
>
>> chỉnh sửa file app/http/kernel.php
 >```
 > $routeMiddleware = [
 >      ............
 >      'kiemtraLoginGuard' => \App\Http\Middleware\kiemtraLoginGuard::class,
 >  ]
 >```
 >> Chỉnh sửa hàm hande trong file kiemtraLoginGuard.php (trong thu muc app/http/middleware)
  >```
  >function handle(){
  >     //nếu như kiểm tra đăng nhập thất bại
  >     if(!Auth:guard('admin)->check()){
  >
  >         //trỏ về trang đăng nhập
  >         return redirect('/admin/login');
  >     }
  >     return $next($request);
  >}
  >```
  >> Hàm xử lý login
   >```
   > $credentials = $request->validate([
   >    'username' => ['required'],
   >    'password' => ['required']    
   >]);
   >
   >if(Auth::guard('admin')->attempt($credentials)){
   >    //Login thành công
   >} else{
   >    // login thất bại
   >}
   >
   >Nhớ thêm dòng này vào chỗ model Admin
   >    use Illuminate\Foundation\Auth\User as Authenticatable;
   >    class Admin extends Authenticatable
   >```
   >> xử lý logout
>```
>public function logout(Request $request)
>     {
>         Auth::guard('admin')->logout();
>         $request->session()->invalidate();
>         return redirect('/admin/login');
>     }
>```
>> Xử lý phân quyền user theo roles
>```
>   - Tạo middleware
>       php artisan make:middleware phanquyenUser
>   - Chỉnh sửa file kernel.php
>       protected $routeMiddleware = [
>           'phanquyenUser' => \App\Http\Middleware\phanquyenUser::class,
>        ];
>
>   - CHỉnh sửa file phanquyenUser.php trong middleware
>
>   function handle(Request $request, Closure $next, ...$roles){
>       if (!in_array(\Session::get('current_user')->group,$roles)) {
>           return redirect('/admin/dashboard');
>           return $next($request);
>   }
>
>   - Sử dụng vào route
>       - Route::middleware('phanquyenUser:1,2')
>       - Group quan ly category thiet lap MiddleWare('phanquyenUser:1')
>       - Vi vay khi login bang tai khoan bientap (co idGroup = 2)
>       - Vi in_array(2,[1]) -> false
>       - Nen no khong the vao day duoc -- done
>```
   >> Hàm xử lý session 
>```
>//get current admin
>   $current_user = Auth::guard('admin')->user();
>//put to session
>   $request->session()->put('current_user', $current_user);
>//Get from session
>   {{ Session::get('current_user')->image }}
>```

> Ckfinder - Ckeditor
>> Trong dự án này, dùng ckeditor 5, ckfinder 3
>```
>// Add script to router user upload file
>   <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
>// Download ckfinder 3 bỏ vào trong thư mục public 
>   <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
>
>   <script>
>       ClassicEditor
>           .create( document.querySelector( '#description' ), {
>             ckfinder: {
>                 uploadUrl: '/ckfinder/core/connector/php/connector.php?commandQuickUpload&type=Files&responseType=json'
>             },
>             toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold',
>'italic', '|', 'undo', 'redo' ]
>         } )
>         .catch( function( error ) {
>             console.error( error );
>         } );
>   </script>
>
>// Chỉnh sửa file config.php
>$config['authentication'] = function () {
>   return true;
>};
>'baseUrl'      => 'http://laravel.htdev/upload/',
> (lúc đầu để là http://laravel.htdev/public/upload/ -- nhưng bị lỗi thư mục vì thư mục public này đã dùng trong warm server để tạo Alias domain) 
>```
>


> Xử lý data đưa vào
>> validate data
>```
> 2 phương pháp
>   pp1 : sử dụng $request->validate, ví dụ
>
>   $request->validate([
>            'name' => [
>                'required',
>                Rule::unique('categories', 'name')->ignore($data['id']),
>            ]
>        ], [
>            'name.required' => 'Danh mục không được để trống',
>            'name.unique' => 'Danh mục đã tồn tại'
>        ]);
>
>Chú ý đoạn Rule::unique('categories', 'name')->ignore($data['id']),
>   Này nó sẽ kiểm tra cái trường name này đồng thời thỏa mãn 2 điều kiện, đó là
>   - Không được trùng với field 'name' trong table 'categories'
>   - Nếu nó trùng với 'name' của category có id = $data['id'] thì nó vẫn thông qua
>   - Này sử dụng trong trường hợp chỉnh sửa category
>
>Ví dụ 2 : 
>   'name' => unique:App\Models\Category,name
>   - Không được trùng với name khác
>
>> Phương pháp 2 (sử dụng Request)
>```

> Xử lý quan hệ Models trong dự án này 
>> Quan hệ 1-1
>```
>   Ví dụ 1 : Quan hệ của table posts và categories (là quan hê 1 - 1 đứng từ table posts)
>
>   use App\Models\Category;
>   public function get_category()
>     {
>         return $this->belongsTo(Category::class);
>     }
>
>   Ví dụ 2: (Mói quan hệ 1 -1 giữa parent var sub ) (user va phone model)
>   use App\Models\User;
>   public function get_phone()
>     {
>         return $this->hasOne(Phone::class);
>     }
>
>   Muốn những dòng code trên chạy thì phải đảm bảo 1 nguyên tắc, đó là : 
>   - Khóa chính của table luôn luôn là id
>   - Khóa ngoại cảu 1 table phải được đặt tương ứng với table liên kết, ví dụ 
>   - Có sự liên kết giữa table phones và users
>   - thì 2 table này có khóa ngoại tương ứng ở table đối phương là phone_id và user_id
>```
>> Quan hệ 1 - nhiều
>```
>   Trong model category  
>   use App\Models\Post
>   function getPost(){
>       return $this->hasMany(Post::class);
>       // (model, khóa ngoại, tên khóa chính)
>   }
>```
>> Cách sử dụng
>```
>// Lấy tên của danh mục từ id post
>   App\Models\Post::find(id_post)->getCategory->name;
>// Lấy danh sách post từ category
>   App\Models\Category::find(id_cat)->getPost->get();
>```
>

> Một số lưu ý khác trong backend
>```
>Phân trang
>   // lấy data truyền vào router
>      'posts' => Category::find($category->id)->getPosts()->paginate(post_per_page)
>   // Hiển thị phân trang
>       {{ $posts->links() }}
>   // thiết lập để phần css hỗ trợ bootstrap
>       use Illuminate\Pagination\Paginator;
>       function boot(){
>           Paginator::useBootstrapFive();
>       }
>```

- ### Pusher 
```
Quy trình xử lý
    > tạo dự án pusher trên website của nó
        - Nó sẽ có 1 bài hướng dẫn từng bước 1
        - Nó sẽ hướng dẫn thêm 1 cái event trong đó luôn
            php artisan make:event NoticeEvent
        - Ở frontEnd(Nơi sẽ hiển thị - khai báo thư viện)
            <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
            <script>
                  var pusher = new Pusher('2b2bd1717f2e1aa0a6e9', {
                    cluster: 'ap2'
                  });
            </script>
        - Backend
            . Cài đặt : composer require pusher/pusher-php-server
            . Thiết lệp thông số trong .evn
                PUSHER_APP_ID=?
                PUSHER_APP_KEY=?
                PUSHER_APP_SECRET=?
                PUSHER_APP_CLUSTER=ap2
         - Cách sử dụng
            use App\Events\NoticeEvent;
            event(new NoticeEvent('hello world'));
```

- ### SendMail

```
> Thiết lập thông số trong .env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=email gui
    MAIL_PASSWORD= pass app tao tu google
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="email dung de gui"

> php artisan make:mail hkt2Mail

> Sử dụng
    Mail::to("To-Email")->send(new hkt2Mail($data['title'],$data['content']));
    
    // này nó sẽ lấy propeties content của object hkt2Mail để làm nội dung của file gửi
    // Này có thế dùng cả css, html
    // với điều kiện nội dung file content.blade.php {!! $content !!} 
    public function content()
    {
        return new Content(
            view: 'backend.mail.content',
            with: [
               'content' => $this->content
            ]
        );
    }

> Một số lỗi gặp phải
    error:1416F086:SSL routines:tls_process_server_certificate:certificate
    
    .Khắc phục
    - add MAIL_ENCRYPTION=null trong file .env
    - Chỉnh sửa file config/mail.php
        'smtp' => [
             ...
            'auth_mode'  => null,
            'verify_peer'       => false,
         ],

``` 


- ### Token API
```
Ở đây sử dụng Sanctum, các bước thực hiện
    > composer require laravel/sanctum
    > php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    > CHỉnh sửa file kernel.php
        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    > Thêm vào model admin (dùng để login) 
        use HasApiTokens, HasFactory, Notifiable;
    > Mọi thực hiện đếu nằm trong file api.php

    Route::middleware('auth:sanctum')->prefix('phone')->group(function () {
        Route::get('list',[ApiPhoneController::class,'list']);
        Route::post('add',[ApiPhoneController::class,'store']);
    });
    
    // get token
    Route::post('getToken',[AdminController::class,'authenticate']);

> Định hướng code
    - Tạo hẳn 1 route quản lý token trong phần admin 
    - Lưu token này vào database
    - Mỗi lần có người muốn thêm sdt thông qua API thì chỉ cần gửi token này
    - Có 3 trường hợp xảy ra
        - token người gửi không trùng với token trong database (thong báo lỗi)
        - token người gửi trùng nhưng hết hạn (Lỗi)
        - còn lại thì ok
    - thiết lập thời hạn token trong file config/sanctum.php
        'expiration' => 1, // đơn vị phút
        Nếu mà hết hạn thì nó sẽ gửi 1 thông báo phải xác thực, lúc này thì cần liên hệ Admin để refresh token trong phần quản trị
```


