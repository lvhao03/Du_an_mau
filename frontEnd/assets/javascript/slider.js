const nextBtn = document.querySelector('.next');
const preBtn = document.querySelector('.pre');
const mainImg = document.querySelector('.mainImage');
const dots = document.querySelectorAll('.dot');
const images = ['https://img.freepik.com/premium-vector/summer-sale-green-white-background-professional-banner-multipurpose-design-free-vector_1340-20165.jpg?w=2000', './assets/images/images.jpg' , './assets/images/images2.jpg', './assets/images/banner.png']
let i = 0;
nextBtn.addEventListener('click', changeToNextImage)
preBtn.addEventListener('click', changeToPreImage)

function checkImages(){
    if (i >= images.length) return i = 0;
    if (i < 0) return i = images.length - 1; 
}

function changeToPreImage(){
    --i;
    checkImages();
    changeDot(i);
    const path = images[i];
    mainImg.setAttribute('src', path);
}

function changeToNextImage(){
    ++i;
    checkImages();
    changeDot(i);
    const path = images[i];
    mainImg.setAttribute('src', path);
}

function changeImageByDot(id, ele){
    changeDot(ele);
    i = id
    const path = images[i];
    mainImg.setAttribute('src', path);
}

function changeDot(ele){
    dots.forEach(dot => {
        if(dot.classList.contains('dot-active'))
            dot.classList.remove('dot-active');
    })
    if (isNaN(ele)) return  ele.classList.add('dot-active');
    return dots[i].classList.add('dot-active');
}