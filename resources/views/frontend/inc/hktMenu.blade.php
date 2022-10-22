<!-- <div id="hkt-menu-wrap"> -->
<div id="hktmenu_main">
    <div id="hkt_main_wrap">
        <div class="hkt_menu_top">
            <a href="#">đa khoa hồng cường</a>
        </div>
        <div class="hkt_menu_list">
            <ul>
                <li><a href="{{ URL::to('/') }}">trang chủ</a></li>
                <li><a href="{{ URL::to('/') }}">giới thiệu</a></li>
                <li>
                    <a href="{{ URL::to('/') }}">danh mục bệnh</a>
                    <div class="hkt_more_cat">
                        <em class="mm-counter">9</em>
                        <span>></span>
                    </div>
                </li>
                <li><a href="{{ URL::to('/') }}">chuyên đề</a></li>
                <li><a href="{{ URL::to('/') }}">liên hệ</a></li>
            </ul>
        </div>
    </div>


    <div id="hkt_menu_category">
        <div class="hkt_menu_top">
            <span id="hkt_back"> << </span>
                    <a href="{{ URL::to('/') }}">danh mục bệnh</a>
        </div>
        <div class="hkt_menu_list">
            <ul>
                @foreach ($categories as $cat)
                    <li><a href="/{{ $cat->slug }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- </div> -->

<!-- mask click hidden menu -->
<div id="hkt_blocker_exit"></div>


<style type="text/css">
    div#hkt_menu_category {
        position: absolute;
        top: 0;
        left: 0;
        display: none;
        width: 100%;
    }

    div.hkt_menu_list {
        background: inherit;
        border-color: inherit;
        overflow: scroll;
        overflow-x: hidden;
        overflow-y: auto;
    }

    ul,
    li {
        list-style: none;
    }

    div.hkt_menu_list a {
        overflow: hidden;
        color: inherit;
        display: block;
        padding: 10px 10px 10px 20px;
        margin: 0;
        text-transform: capitalize;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    div.hkt_menu_list>ul>li {
        position: relative;
    }

    div.hkt_menu_list>ul>li:after {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        display: block;
        right: 0;
        left: 20px;
        content: '';
        bottom: 0;
        position: absolute;
        border-color: rgb(0 0 0 / 8%);
    }

    .hkt_more_cat {
        background: rgba(3, 2, 1, 0);
        width: 90px;
        padding: 0;
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 2;
        border: 2px solid transparent;
        border-left: 2px solid rgb(170 170 170 / 30%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hkt_more_cat em,
    .hkt_more_cat span {
        font: inherit;
        font-size: 16px;
        font-style: normal;
        text-indent: 0;
        line-height: 20px;
        margin-right: 15px;
    }

    .hkt_more_cat span {
        margin: 0;
        font-weight: bold;
    }


    div.hkt_menu_top {
        border-bottom: 1px solid;
        border-color: inherit;
        text-align: center;
        line-height: 20px;
        padding: 0 40px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }

    div.hkt_menu_top a {
        display: block;
        padding: 13px;
        color: rgba(0, 0, 0, .3);
        text-transform: uppercase;
        font-size: 16px;
        width: 100%;
    }

    div#hkt_blocker_exit {
        background: rgba(3, 2, 1, 0);
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999999;
    }

    .hkt_menu_top span {
        border: none;
        position: absolute;
        width: 15%;
        left: 2%;
        height: 80%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    div#hktmenu_main {
        background: #f3f3f3;
        border-color: rgba(0, 0, 0, .1);
        color: rgba(0, 0, 0, .7);
        width: 80vw;
        min-width: 140px;
        max-width: 400px;
        margin: 0;
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 10000000;
        display: none;
        transition: transform .4s ease;
        overflow: hidden;
        background: #f3f3f3;
        border-color: rgba(0, 0, 0, .1);
        color: rgba(0, 0, 0, .7);
    }

    div#hktmenu_main:after {
        content: "";
        display: block;
        width: 20px;
        height: 120%;
        position: absolute;
        left: 100%;
        top: -10%;
        box-shadow: 0 0 10px rgb(0 0 0 / 30%);
        z-index: 100;
    }

    #website {
        transition: all .4s;
    }

    @keyframes mymove {
        from {
            transform: translateX(-100%);
        }

        to {
            transform: translateX(0);
        }
    }

    @keyframes mymove2 {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-100%);
        }
    }

    div#hktmenu_main.active,
    div#hkt_blocker_exit.active {
        display: block;
        animation: mymove .5s;
    }

    div#hktmenu_main.disable,
    div#hkt_blocker_exit.disable {
        animation: mymove2 .5s;
        /*display: none;*/
    }

    div#hkt_main_wrap.to_left {
        transform: translateX(-100%);
        transition: transform .4s ease;
    }

    div#hkt_main_wrap {
        transition: transform .4s ease;
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
    }

    div#hkt_menu_category.to_left {
        display: block;
    }

    #website.active {
        transition: all .4s;
        transform: translateX(80vw);
    }

    html.dis {
        overflow: hidden;
        position: relative;
    }

    body.dis {
        overflow: hidden;
    }
</style>

<script type="text/javascript">
    var js_btn_click_hktmenu = document.getElementById("js_btn_click_hktmenu");
    var hktmenu_main = document.getElementById("hktmenu_main");
    var hkt_main_wrap = document.getElementById("hkt_main_wrap");
    var hkt_menu_category = document.getElementById("hkt_menu_category");
    var hkt_blocker_exit = document.getElementById("hkt_blocker_exit");
    var hkt_back = document.getElementById("hkt_back");
    var website = document.getElementById("website");
    var hkt_more_cat = document.querySelectorAll('.hkt_more_cat')[0];
    var root = document.getElementsByTagName('html')[0];
    var body = document.getElementsByTagName('body')[0];


    js_btn_click_hktmenu.addEventListener('click', function(e) {
        hktmenu_main.classList.add('active');
        hkt_blocker_exit.classList.add('active');
        website.classList.add('active');
        root.classList.add('dis');
        body.classList.add('dis');
        hkt_blocker_exit.classList.remove('disable');
        hktmenu_main.classList.remove('disable');
    });

    hkt_blocker_exit.addEventListener('click', function(e) {
        this.classList.remove('active');
        this.classList.add('disable');

        // xu ly transititon truoc display none
        hktmenu_main.classList.add('disable');
        setTimeout(function() {
            hktmenu_main.classList.remove('active')
        }, 200);

        // hktmenu_main.classList.remove('active');


        website.classList.remove('active');
        hkt_menu_category.classList.remove('to_left');
        hkt_main_wrap.classList.remove('to_left');
        root.classList.remove('dis');
        body.classList.remove('dis');
    });

    hkt_more_cat.addEventListener('click', function(e) {
        hkt_main_wrap.classList.add('to_left');
        hkt_menu_category.classList.add('to_left');
    });

    hkt_back.addEventListener('click', function(e) {
        hkt_menu_category.classList.remove('to_left');
        hkt_main_wrap.classList.remove('to_left');
    });
</script>
