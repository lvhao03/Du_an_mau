const addToCartBtn = document.querySelector('.add-to-btn');
// lấy dữ liệu > lưu vào local storage 

addToCartBtn.addEventListener('click', ()=> {
    let numberOfProduct = getNumberOfProduct();
    let product = getProductDataInJson();
    updateNumberOfProductInCart(numberOfProduct);
    showNumberProductInCart();
    saveProductInLocalStorage(numberOfProduct, product);
})


function showNumberProductInCart(){
    const number = document.querySelector('.number-product-in-cart')
    number.classList.remove('destop-hide');
    console.log(getNumberOfProduct());
    number.textContent = getNumberOfProduct();
}

function getProductDataInJson(){
    const quantity = document.querySelector('.quantity-bar :nth-child(2)').textContent;
    const title = document.querySelector('.main-right :nth-child(1)').textContent;
    const price = document.querySelector('.price').textContent;
    const image = document.querySelector('.mainImage')
    const imageSrc = image.getAttribute('src')
    let id = getNumberOfProduct();

    return JSON.stringify({id,title,price,quantity,imageSrc});
}

function saveProductInLocalStorage(productIndex, product){
    localStorage.setItem(productIndex, product);
}

function updateNumberOfProductInCart(numberOfProduct){
    let a = numberOfProduct + 1;
    return localStorage.setItem('numberOfProductInCart', a.toString());
}

function getNumberOfProduct(){
    if (localStorage.numberOfProductInCart) {
        return Number(localStorage.getItem('numberOfProductInCart'));
    }
    localStorage.setItem('numberOfProductInCart', '0');
    return 0;
}

function getAllProductFromLocalStorage(){
    var values = [];
    let numberOfProduct = Object.keys(localStorage);    
    let index = numberOfProduct.length;

    while ( index-- ) {
        values.push(JSON.parse(localStorage.getItem(numberOfProduct[index])));
    }
    return values.reverse();
}

const increaseBtns = document.querySelectorAll('.increaseBtn');
const decreaseBtns = document.querySelectorAll('.decreaseBtn');
function increaseNum(ele){
    let num = ele.previousElementSibling.textContent;
    Number(num++);
    ele.previousElementSibling.textContent = num;
}

function decreaseNum(ele){
    let num = ele.nextSibling.textContent;
    if (num <= 0) return;
    Number(num--);
    ele.nextSibling.textContent = num;
}

showNumberProductInCart();