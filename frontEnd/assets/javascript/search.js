$(document).ready(function(){
    let content =  $(".content");
    let a = $("#exampleInputEmail1");
    a.keyup(function(){
        $.ajax({
            url: 'a.php',
            data: {
                keyword: a.val()
            },
            type: 'POST',
            dataType: 'json',
            success: function (result){
                let html = "";
                if (result.length > 0){
                    $.each(result, (index , item) => {
                        let imagePath = 'assignment1/backEnd/' + item['imagePath'];
                        html += `<li>
                                    <div class='search'>
                                        <img src=${imagePath}>
                                        ${item['productName']}
                                    </div>
                                </li>`;
                    })
                } else {
                    html+= 'ko tìm thấy sản phẩm';
                }
                content.html(html);
            }
        })
    });
})