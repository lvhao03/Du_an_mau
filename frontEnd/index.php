<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopHome.css">
    <link rel="stylesheet" href="assets/MoblieCss/mobileHome.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <!-- Banner -->
    <div class="banner">
        <div class="slider">
            <img class='mainImage' src="https://img.freepik.com/premium-vector/summer-sale-green-white-background-professional-banner-multipurpose-design-free-vector_1340-20165.jpg?w=2000" alt="">
            <div class="double-btn mobile-hide">
                <button class="pre"><i class="fas fa-arrow-left"></i></button>
                <button class="next"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="dots">
            <div class="dot dot-active" onclick="changeImageByDot(0, this)"></div>
            <div class="dot" onclick="changeImageByDot(1, this)"></div>
            <div class="dot" onclick="changeImageByDot(2, this)"></div>
            <div class="dot" onclick="changeImageByDot(3, this)"></div>
        </div>
    </div>



    <!-- New arrivals section -->
    <div class="arrivals-section">
        <h2>Sản phẩm mới nhất</h2>
        <div class="grid">
            <?php 
                include '../backEnd/db.php';
                $result_1 = $conn->query('SELECT * FROM product LIMIT 4 OFFSET 3')->fetchAll();
                foreach($result_1 as $product){
                    $imagePath = '../backEnd/' . $product['imagePath'];
            ?>
            <div class="grid-item large">
                <img src="<?php echo $imagePath?>" alt="">
                <div class="large-content">
                    <div class="large-header">
                        <h2><?php echo $product['productName']?></h2>
                        <p class="price"><?php echo $product['price']?></p>
                    </div>
                    <div class="large-body">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star not-checked"></span>
                            <span class="fa fa-star not-checked"></span>
                        </div>
                        <div class="large-des mobile-hide">
                            <?php echo $product['des']?>
                        </div>
                        <a href="./product-detail.php?id=<?php echo $product['id']?>">
                            <button class="btn large-btn mobile-hide">Mua ngay</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
    <!-- Page info section -->
    <div class="page-info-background">
        <div class="page-info">
            <div class="page-detail">
                <h2>Fashion style</h2>
                <p>Vì sao nên lựa chọn chúng tôi</p>
                <ul class="page-detail-list">
                    <li>
                        <b>Miễn phí vận chuyển</b>
                        Miễn phí khi dưới 5km
                    </li>
                    <li>
                        <b>Chất lượng sản phẩm</b>
                        Chất lượng sản phẩm luôn tốt nhất
                    </li>
                    <li>
                        <b>Dịch vụ hỗ trợ</b>
                        Chúng tôi có nhiều chính sách hỗ trợ cho khách hàng
                    </li>
                </ul>
                <a href="" class="btn-link">
                    <button class="btn">Tìm hiểu thêm</button>
                </a>
            </div>
            <img src="https://thumbs.dreamstime.com/b/portrait-young-asian-woman-beautiful-girl-wear-yellow-t-shirt-background-copy-space-studio-pretty-asia-female-get-197383087.jpg" alt="">
        </div>
    </div>

    <!-- Best seller section -->
    <div class="best-seller-section">
        <h2>Best seller của tháng</h2>
        <div class="row">
            <?php 
                $result = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
                foreach($result as $product){
                    $imagePath = '../backEnd/' .$product['imagePath'] ;
                    $price = $product['price'] . ' đ';
                    echo '<div class="col col-3 sm-2">'.'
                                <div class="card">'.
                                    '<img src="'. $imagePath.'" alt="">
                                    <h2 class="product-title">'.$product['productName'].'</h2>
                                    <div class="product-words">
                                        <p class="product-des">'.$product['des'].'</p>
                                        <p class="product-price">'.$price.'</p>
                                    </div>
                                    <div class="stars">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star not-checked"></span>
                                        <span class="fa fa-star not-checked"></span>
                                    </div>
                                    <a href="./product-detail.php?id='.$product['id'].'" class="btn-link">
                                        <button class="btn">Mua ngay</button>
                                    </a>
                                </div>
                        </div>';
                }
            ?>
        </div>
    </div>


    <!-- Reviews section  -->
    <div class="review-section">
        <div class="review-bg">
            <div class="review-header">
                <h2>Khách hàng nói gì về chúng tôi</h2>
                <p>Reviews của khách hàng</p>
            </div>
            <div class="review-content">
                <div class="row">
                    <div class="col col-4 sm-4">
                        <div class="review-card ">
                            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBUVFRgVFRUYGBgYGBgYGBgYGBgYGBgSGBgZGRgYGBgcIS4lHB4rHxgYJjgmKy8xNTU1GiQ7QDszPy40NTEBDAwMEA8QHhISHDQjJCw2NDQ0NDQ0MTE0NDQxNDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQxNDQ0NDQ0NDQxNDQ0Nf/AABEIALcBEwMBIgACEQEDEQH/xAAcAAACAwEBAQEAAAAAAAAAAAACAwABBAUGBwj/xAA/EAACAQIEAwUFBgUDAwUAAAABAgADEQQSITEFQVEiYXGBkQYyobHwE0JSwdHhI2JygvEHFZIUosIWJDNDsv/EABoBAAIDAQEAAAAAAAAAAAAAAAABAgMEBQb/xAAoEQACAgIBBAAGAwEAAAAAAAAAAQIRAyESBDFBUQUiMmFxkTOBoRP/2gAMAwEAAhEDEQA/APJoscqwUWaESTAipGqkJUjUSAC1SGqRoSGqQABUhBI1UhhIAKCRgSMCQ1SACgkYqRgSGFgAoJLCRtpZFtToOuwAgAsLIFmYY8O2Wmhf+a+VfI6k+kc5rKM32aMOgc3t/wAZBzivJYsUmroeFhBJjw3Ekc5WujfhfS/g2x+c6IWNO+xFprTAVJYWMyy8skIWVgMsaRKKwAQyQGSaCIJWAGRkgFJpKyisBGUpBanNRSCUgBianFMk3skU6QAwNTinSbWSKZIAYHSJZZvdIh0gIyZZcbllQAKms1IsTTWakEBhokaqy0EYogBSpGKsJVhqsQFBIapDVYxVjABUhBIwLDVIDFhYQWGFhZYAJdgoLMbAakzkGqa52sgOi9bc26n4CbeOUWKIdchY372AFh8YXDKAFtNJmyzfZGvBiX1M0YPCG2gmp8M1tL6zp4ZFPX66ax1Wmo3BPjaUUaeX2PE8VwQtqPHSYsBxJ6PZa7oOV+0o/lvuO75T0/E6Q5Ajx09Z5fGYe15OEmiM4KSPUYaqrqHQ3UjQ/Wx7o3LPH8CxrUXyv7jnW/3SdA4+R/aeytNcZWjnzjxYspBKxxglYyIkiAwjisAiMBRWVljLSisAFFYNo4iCRAQgrAdY9hAYQAyukzuk2usS6wAxMkS6TayTOywAx5ZI3LLgIqms0IICLHosBjEWPVYCLNCLAClWMRZarGKsBkVYwLIBCUQAirGASAQ1EQFWhKlzbroJYWauHpeogP4gfTX8oMDL7XUgiUUHIt66axXDsOSAdbdIz2xxqI6Bu0e0VUakk2HkNJxKXEMe4JwyIUtcMQEFr8i73Yd4FjMklykboS4wPb0sMRzIsPhHfZqdz6c54vhPEsdTa2KXsPs4ykA22upI3ndxOJZERx0cDxvdbyD0ySTasdjeHqeg5zzXFOH7lWBO5APxmKpwh6p+1xGICKRzubp3i4AG/P1mPF4bDIxOHro7jXssuex31U/C3mN5LivYKbWmOw2HDaMNBoe4nu6aCelwQITKdSulzuV+6fTTynF4RULdom7dbWLLb73hO9QYG2liTbTY2F/leWweyjMiyJREeVgFZeZxJEEiNYQCICF2lGGRKMYCiIJWNIgkQAWVi2WOMW0BCGEUyzQ0U0AEsszOs1ssQ4gBkySRuWVACqYmhFi6YmlFgAaLHqspFjlWAERYxVlKI0CAwQIYEsLDVYgIohqJFEYogBSia+HC1RT4/wD5MzqIj/c0SstM+9lDEcwhbJmFxYgHfXTzEjJ0hxTb0cr2yTNWc2LZaaKF63u2W3n8ZwaX+41VX7KoEzAhqei/ZgEFWOl2uoIN/Qbj2mPQHEOfAf8AEATfhqKC1gLzLzpvRu4XFbOSmEdFcF86NYqH98FbEkmwBG/f3mNxjZsKl76W06/Vpp4sCBYC5OnlpNOLwp+xFhpb8pBu9lipJHKpYJKnadc5yFAGsUCNfNYEGzG9iw10AnBrewtEAhRlBIN8xZxbbKTtaejwFNqbrnIyvsOjHYTrYhAdtBGpNLTIyhFyto8kML9kFCXsu1yCT1N5qbE5VVzsGU+Vx2QPxEm3nNXESFU39ZzOK1Wp4VCoJdnugtftKCy37swU+UlBuxZkqR1cBj0rZ8h1R8jDo1gbHToeXzuJoZZzPZjAinTOpLMVz33zqipfzyzruJpi7RinGpUIYQCscwgkSZAQRBIjWEAiAC7QSIwiDaMBREFhGsIswEIdYsiPYRTCACWEQ4ml4lhABGSSMyyQAGms0oIukJpRYgGIscqyIsaojGUqxiiQCGBEBAsISwJYEBkURirKVYYWICwJh4pgw4DgHOnuEAE3bskG5Fwb7ToAQ1uCCACQb2OokJK0Tg6kjk46qRiLm13VHtyuy6i/PW86uGfYWnLx1Esq1CLMmZdrDs21A3AMKljQFFjYtftE+6gF7/ETLJbs2wdxr0ZfaTiFVagp0soZ0ARqmbIrKxzXKg62K26zmHE45kNM5M/umorjIvVnUgMNLm1v0m9+JalEYAA9pybDLbr1PnzmKriKAYku5LX91FYZWXKdzc6bE7SUV7Qm34Yj/bcQEFsUXYsudnbKigG/YRVJ9SAdJ6tOIsq9pCw6rqwHW3PwGs8jiceAL/Y18tst2uCR11GnkekxcL4tWZ2Co5TS7MpUqeVw2+nTvjcWw5JaZ6jiFYMVI7SPazDlfTXp+Rg4x/4SWGqXyaXs9wASL7Du3gLohzWuaoFupK0na391z6zVh0Zh2SAxbsk+7exIuOYuNe4wivBHI06Z08Mb5jlAuQNOeVQLmNaXQVgi5gA1hcKSwB52JAJHlIwl6VJIySlcmxTLFkR5EBlkyIlhFkRzCA4jEJIg2jCJREAFERbCOaLIjAUREtHsIphAQhophHsIphABUkkkAGUlmtFiKImtBAYxFjVEFBGqIgIFhqJAIYgBLS1EsCEBEMsCGBKAhARAWBCWUBDUQGJqUnZXzsGzE5QFyhVN7Dc31O881WZsuhsRf/usQPDRR6z1wE8TxEN9qye6HvbW2xzj0II03lM49qL8c9OzLh+BZ7OxZ9yUL9i+w0A1850f+sr0rU6eGUA2XMzqq79E16bTRgbFVIPcetxfe87OEQNY294W1GliNyfKQt2X6UdHl1OJqt/E+zXoANbcsuYm201LhgqlFte2Y66k336kjSdbitJL3uTvqCQBbTKDsT+Q7pxsT2Fyrdb66A30IUWJO4sBf/AbtsXL5Tn065zgFtAWfobsAg7PLQt6TuJiSiZrajOwHM5V0066CeddgrALcnkbjmQb2HnCw+Pz1Mim4HYBGx17RHdv5SXGtlLly0fQgwIBHMX8jAaBgHui92npt8LRhlqdooap0LIlEQyIJEYhRWLZY+0WwjASwgERzCARGISRBYRrCLIjASwi2EcRFsICM7iKcTQwinWAGeSXaSAGikJqSZaYmpIhj0jFi1jFgMMQhBENREAaiGBKWMAiAoCEokAhAQAsCFaQQxEMgnk/anELSqrm7IcXD7gMNCGXe3f3z1gnA9uOGGphg9tmIB+uVxIgjh4Otk1Hulhe1rKAL3NiRc22HLWaH44lNRZs1hY5tBYDc3sSSCDp3zwX/VVKQyMSBYhTuMp3Ug7iKxGOVx20APVCQDbuJNvK0OKey1SktM9VifawMSQFJt6E2JItqDaw75kxHGWe7aImg5AG19ANNdb7fe5TyAqdBCdnfe53sOQvvbptBRSE5NnYXiLuzBPecZe5VO58Z6jg/DfskzH3vkJyvZThP/2MNtZ7EJ2dv2ErnLwi/FCtsLhvFzRdLqro1w6sNmutmB5aX7rCe0qYRKqCrQ2YEgagGxsRY6g3BE+aYgkECxIudN9wRp6z6h7MEHDoRqCW220Yi47tIQk+xXmils41oNpwfbnjtXCY0qmVqb00cow2Yl1OUjUXyX9Yzg/tPRrr2j9m40KudPFX0BHjYzU8clFS8GeL5S4rudgiA4jrQCJABBEEiPZYsrGISwiiJocRBEYCmEWwj2EUwjAQwiWmhxEvARnkhWlwAcgj0EBBHqIhhpGqItRHJAYQENYKiNUSIBKIYEoCMyxAUBGASgIYEBlASwINesiLndgqjmTYTynHParsMtC63uM50awGuQcvHx2kbSLceCeTste/B1OMe0CUmFJCHrMQgX7qMxAGc9dRpv4T0/tLh1GFK75cgB7xpfxP5z4ZwqsTiaDE3/8AcUSSdSf4qE3+M+8e09EvhqoX3gA4tvmRg4H/AGy/PBQSSKcbt2fJcbwkPfS/OebfhIV8hva+nhPoVBDzFvH63g43haVFuBZgQb/lMSk0bpQUtnmDwZFp5rC/1bURlLg17aDyEe+CZWtlJ169ned3DUbqARb4WHPWDkxqK9DeHYQIgA0FhfqfKaXTTb9b85rRdOe1tukthcSFkzg4pADfTQg62t8Z9D9maeXC0Ra10z2/rJf/AMp4bE4Nqrph03qHtW2WmPfY25W7P94n0qlTCgKNlAUeAFpbjWjNne6PjP8Aqs98eR+GjTXzu7f+U8ngbl7dxne/1BrZ+IYg8lZEH9qID8bzj8OTtX7vzE6OR8cH9FXRrl1MfydDA8UrUj2HYC/u7r/xOk9Nw32vRrLXXIfxrcr5ruPK88hTGrDvkdJzVNo7+TpceVbW/Z9UpVFcBkYMp2INwfOQifNOG8SqUGzI2nNTqp8RPa8L9oaVYAE5H/Cx0J/lPOWxkmcnP0U8e47R0nEQwmtxM7iWIwsQwi2jmEW8kBneIcTS0S4gIz2kjJIAaEEeoi0EcoiGEojkEBRGoImMJY1RBUQ1EQBKI0CUohOwUZmIAG5JsB5xDSstVnC437SpRuiAO/P8Cnv6nuE5XH/agtenQNl2Z9i39PQfGeTzXMqlL0dXpegv5sn6NmNx9Ws2ao5boNgPADQCZ37SEdxHrf8AWEogp7p/qX4sJXe7Oq4JR4paOIlRkIdfeQhl/qXUfKfpdGWom11dAbHmrC/yM/NxSfbP9/TCcMw+JqAn+BhwFHvO7KgAHxY9ynQ7TpdSrUWeTgvmaOXxDsYipTZszBswY2uVYBhfvGaMRfr/ADPEtxR6lU1y2ZnIJOliFFgthyA0tPZcKxK1EzJ/cvNW6GcyXc7EsEscFe/uZcXh9bgfr5cxFUQVN/Tn8TOvXo35GZalADa+3w6cpEgjRRIIB/z8ZoIVULsbBVLHYe6CTv4SYCmCN/1754f/AFC9qFIOFotex/iMDoTpZNr3BvfWOMbZHzR6X2I9oMNUxTqX/jMoVc1grLckol9yLX79d59FQT8y8P4Uzdt2KnQqQbMCNj3Wn1Dhn+oBTDumKVjVWmwSqgutU5bKXt7jbXPunfTaaI1fFFObpsiXNLR884vivta9Wre4eo7j+lnZl+FpfDR757h+Z/ITIBoLai246d06PDk7LHrf4C3zvN3V6xV+CHwyN9Qn6TZYFnbyMJhLt279VB+vWU05R6ZLQsLANIXA8z3COG8q+p8vzjsTjo7nC+PvSAQ9tBsCdQO4z0WC4pTre6bN+FtD5dZ4K8KnVKkEG0nGbRiz9Fjy7Wn9j6KyxDic3g/GM9kc9rkfxdx7/nOnUmiMlJWjhZsMsUqaM7RTxrxLmSKgJUG8kBG6nHpEKI+nEMcojFEBRHLIjCWMUQFEz8Uxf2SEj3joP1kZOkTxwc5qK7sVxTjCUeyO0/TkPGeF4zxF6z3djtsL5R4CTFYgsxMyVBfXp8pQ5Ns9Fh6WGKPa37E2jEWMVOcMU+cVl6oEIRr6yH3SR0v5jX8o9VgMtieh+fMREpbRx3YAeO1tSdOQ5z0eO4pUxK4dHXJTw9JFSmTctUVApqtbS+hyjkL8yZzsFhVCqQBdgLnc205nlNI/f9Jpz9R/00lSOX0vw9Y5c5u3/hxcdgqiMXpMRc3INtT56GbOEe0lbDuGdD0awNmXoR+YOk3OlxARD+0z8tbRsl0+3Umk/HdH0fhvEqWIpipSa4O45o3RgNjG1ML2Sb629Z85wGJfD1M9Jbc3GysOhHXnflY9Z6//ANUI6ErRfOAOxlN87Ds5dLMt7gtew05G8jV9jBmwvDJeUcr2o4s9BPsqZs9QWBG6JsTpseQPj0nkcFwpQczdpt9dr9e+dKrUepVarUILkZbDYW5L3Qo7pUjoYOniopyWwCBIYZgkQNDMdXCITe1upU5Tfvtv5zRhkCqFHLr38zCYdfA/rLH7ecbk2qvRCGOEZclFJ+xSrqPAj0OnylZYbDX+4H10+cIDSItozhdZLRoGkTVP11MBPsAzftKJktbfeUYyDHUKtjPa8Pxf2iAn3hofHrPBkz0Ps5ie3l/EPiNRJwdSMHXYlPE35WzvPEsJocRLCajgCLSS5ICNqx6xKx6xDGpHrErHrIjGIJ5L2mxd3I5DQeX7z1TvlUt0BPoJ864nWux/zKcj8HU+GwuTn60Yi8l4MsSs7KHp8IaxdJuUaYgS8kVtfj+UmKNkY/yk+dj+kWx7Q8D+svF//G39LfKA39LDRbKB0AHlChSrQCi1lWliUZEnWg53+EY1xh6iLcLTUuSFGxP3jufvActPTh4dM7KlwMxAuToLm2pjsdhMjAX1y3tcggEldQORtfXukoutmfqIRypY296f6MiLaQyI2/cbfAH01+EkiaCQflClQAE/XhK+vMSyfr5yvr00MkFFP17r+YMp27PibepltM1Wraw/mB+vOJIbdIe5+EzD8Xp+sJ6nZ123PhyEWzkcu0dh0HU90aRCTRbDlzgE8pRbWwNz95uQ/fughhsPX63kqIuRbGb+EVsrqejD0vOc5jcC+sZRk3o+hPEPHNFNNR5hme0kO0kYjWkchkkiGPWPSSSRGK4g1qTn+Uz5riWuxlySifc7Xw7+N/kUBCHTY8pUkgdCXYsHW3Ma/oYZeSSAr0UNbGPri6kdx+UqSJlsew4/XhK+vr4SSSI2WBLMkkCUe5F6Qwm/fv47flJJAKRWW0q0kkBoqUZJIDA+vr4yrfXzlyQEgWnJxzkEeX5EfnJJJx7lWb6SU69wDbuReRI+8x7rbS2uNybtuRuR3dB8ZUkl5Kou+4Yp8jt+EbeZ5wiJJIixLQpzDwO8uSS8Gefc+ich4RbySTSjzUu4q8kkkYj/2Q==" alt="">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star not-checked"></span>
                                <span class="fa fa-star not-checked"></span>
                            </div>
                            <h2 class="customer-review">"I love it, good product"</h2>
                            <p class="customer-name">The rock</p>
                        </div>
                    </div>
                    <div class="col col-4 sm-4">
                        <div class="review-card ">
                            <img src="data:image/jpeg;base64,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" alt="">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star not-checked"></span>
                                <span class="fa fa-star not-checked"></span>
                            </div>
                            <h2 class="customer-review">"I love it, good product"</h2>
                            <p class="customer-name">The rock</p>
                        </div>
                    </div>
                    <div class="col col-4 sm-4">
                        <div class="review-card ">
                            <img src="data:image/jpeg;base64,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" alt="">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star not-checked"></span>
                                <span class="fa fa-star not-checked"></span>
                            </div>
                            <h2 class="customer-review">"I love it, good product"</h2>
                            <p class="customer-name">The rock</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product section -->

    <div class="product-section">
        <h2>Sản phẩm</h2>
        <ul class="product-type-links">
            <li><a class= 'active' href="">Tất cả</a></li>
            <li><a href="">Áo thun</a></li>
            <li><a href="">Quần</a></li>
            <li><a href="">Giày thể thao</a></li>
        </ul>
        <div class="row">
             <?php 
                $result = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
                foreach($result as $product){
                    $imagePath = '../backEnd/' .$product['imagePath'] ;
                    $price = $product['price'] . ' đ';
                    echo '<div class="col col-3 sm-2">'.'
                                <div class="card">'.
                                    '<img src="'. $imagePath.'" alt="">
                                    <h2 class="product-title">'.$product['productName'].'</h2>
                                    <div class="product-words">
                                        <p class="product-des">'.$product['des'].'</p>
                                        <p class="product-price">'.$price.'</p>
                                    </div>
                                    <div class="stars">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star not-checked"></span>
                                        <span class="fa fa-star not-checked"></span>
                                    </div>
                                    <a href="./product-detail.php?id='.$product['id'].'" class="btn-link">
                                        <button class="btn">Mua ngay</button>
                                    </a>
                                </div>
                        </div>';
                }
                ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'assets/include/footer.php'?>
</body>
</html>