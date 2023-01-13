<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopCheckout.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <main>
        <div class="col-8">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">Tên người dùng</label>
                        <input type="text" class="form-control" id="username" placeholder="Nhập tên">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập Email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" class="form-control" id="phone" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="street">Địa chỉ</label>
                        <input type="text" class="form-control" id="street" placeholder="Nhập tên đường">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">Tỉnh/Thành phố</label>
                        <select class="form-control province" name="" id="city">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="district">Quận/Huyện</label>
                        <select class="form-control district" name="" id="district">
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ward">Phường/Xã</label>
                        <select class="form-control ward" name="" id="ward">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipCode">Zip code</label>
                        <input type="text" class="form-control" id="zipCode" placeholder="Mã zip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Đặt hàng</button>
            </form>
        </div>
        <div class="col-4">
            <div class="card">
                <h3>Đơn hàng</h3>
                <?php 
                    $sum = 0;
                    foreach($_SESSION['cart'] as $product){
                        $sum +=  $product['price'];
                ?>
                <div class="product-section">
                    <img class="product-thumnail" src="<?php echo '../backEnd/'.$product['imagePath']?>" alt="">
                    <div class="product-info">
                        <span><?php echo $product['productName']?></span>
                        <div class="quantity">Số lượng: 1</div>
                    </div>
                </div>
                <?php } ?>
                <div class="right-section">
                    <p>Tổng tiền</p>
                    <p><?php echo $sum ?></p>
                </div>
                <div class="right-section">
                    <p>Vận chuyển</p>
                    <p>Miễn phí</p>
                </div>
            </div>
            </div>
    </main>
    <?php include 'assets/include/footer.php'?>
    <script>
        let province = $('.province');
        let district = $('.district');
        let ward = $('.ward');

        $(document).ready(async function(){

            let provinceList = await showAllProvince();
            renderData(province, provinceList);

            province.change(async function(){
                let b = await getDistricts(province.val());
                renderData(district, b.districts);
            })

            district.change(async function(){
                let b = await getWards(district.val());
                renderData(ward, b.wards);
            })
        })

        function renderData(select, array){
            select.html('');
            let html = '<option disable value="">Chọn</option>';
            $.each(array, (index, item) => {
                html += `<option value="${item.code}">${item.name}</option>`;
            })
            select.append(html);
        }

        function showAllProvince(){
            return fetch('https://provinces.open-api.vn/api/p/').then(respone => respone.json());
        }

        function getDistricts(code){
            return fetch(`https://provinces.open-api.vn/api/p/${code}?depth=2`).then(respone => respone.json());
        }
     
        function getWards(code){
            return fetch(`https://provinces.open-api.vn/api/d/${code}?depth=2`).then(respone => respone.json());
        }

    </script>
</body>
</html>