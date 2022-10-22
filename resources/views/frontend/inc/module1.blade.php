<div id="hkt-footer-1" class="d-sm-none">
    <a href="">
        <img id="hkt-item-1" class="active" src="https://m.phongkhamdakhoamientay.vn/modules/hkt-footer-1/bs3.png">
        <img id="hkt-item-2" src="https://m.phongkhamdakhoamientay.vn/modules/hkt-footer-1/bs4.png">
        <img id="hkt-item-3" src="https://m.phongkhamdakhoamientay.vn/modules/hkt-footer-1/bs2.png">
        <img id="hkt-item-4" src="https://m.phongkhamdakhoamientay.vn/modules/hkt-footer-1/bs1.png">
    </a>
    <div class="hkt-footer-bottom">
        <a href="">đăng ký khám ngay</a>
        <a href="">trò chuyện với chuyên gia</a>
    </div>
</div>

<style>
    div#hkt-footer-1 {
        position: fixed;
        left: 0;
        width: 100%;
        bottom: 0;
        padding-bottom: 1rem;
        box-shadow: 0px 0px 1px green;
    }

    div#hkt-footer-1 img {
        max-width: 40vw;
        display: none
    }

    div#hkt-footer-1 img.active {
        display: inline-block;
    }

    .hkt-footer-bottom {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .hkt-footer-bottom a {
        display: inline-block;
        background: red;
        padding: 5px 10px;
        color: white;
        text-transform: capitalize;
        font-size: .8rem;
    }

    .an {
        animation: hide 1s;
    }

    .hien {
        animation: show 1s;
    }

    @keyframes hide {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(500%)
        }
    }

    @keyframes show {
        from {
            transform: translateX(-100%);
        }

        to {
            transform: translateX(0)
        }
    }
</style>


<script>
    async function asyncCall1() {
        console.log('calling');
        document.getElementById("hkt-item-" + htk).classList.remove('hien');
        document.getElementById("hkt-item-" + htk).classList.add('an');
        const result = await new Promise(resolve => {
            setTimeout(() => {
                document.getElementById("hkt-item-" + htk).classList.remove('active');
                document.getElementById("hkt-item-" + htk).classList.remove('an');
                document.getElementById("hkt-item-" + hkt).classList.add('hien');
                document.getElementById("hkt-item-" + hkt).classList.add('active');

                hkt++;
                htk == 4 ? htk = 1 : htk++
                if (hkt == 5) {
                    hkt = 1;
                    htk = 4;
                }
            }, 800);
        });
    }

    var hkt = 2;
    var htk = 1;

    setInterval(async () => {
        await asyncCall1(htk);
        // asyncCall2(hkt);
    }, 7000);
</script>
