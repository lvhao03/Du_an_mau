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
            <!-- <div class="grid-item large">

                <img src="data:image/jpeg;base64,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" alt="">
                <div class="large-content">
                    <div class="large-header">
                        <h2>Gray shirt</h2>
                        <p class="price">120$</p>
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
                            This is just a regular shirt from china
                        </div>
                        <a href="">
                            <button class="btn large-btn mobile-hide">Buy now</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="grid-item large">

                <img src="data:image/jpeg;base64,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" alt="">
                <div class="large-content">
                    <div class="large-header">
                        <h2>Gray shirt</h2>
                        <p class="price">120$</p>
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
                            This is just a regular shirt from china
                        </div>
                        <a href="">
                            <button class="btn large-btn mobile-hide">Buy now</button>
                        </a>
                    </div>
                </div>
            </div>
            

            <div class="grid-item large">
                <img src="data:image/jpeg;base64,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" alt="">
                <div class="large-content">
                    <div class="large-header">
                        <h2>T-shirt</h2>
                        <p class="price">120$</p>
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
                            This is just a regular shirt from china
                        </div>
                        <a href="">
                            <button class="btn large-btn  mobile-hide">Buy more</button>
                        </a>
                    </div>
                </div>
            </div> -->
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
                    $imagePath = 'http://localhost:8080/PHP_1/assignment1/backEnd/' .$product['imagePath'] ;
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
                    $imagePath = 'http://localhost:8080/PHP_1/assignment1/backEnd/' .$product['imagePath'] ;
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