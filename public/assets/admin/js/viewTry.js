function viewTry() {
    const formInfo = document.querySelector('.wrap-form');
    const body = document.querySelector('.view-try');
    const btnView = document.querySelector('.btn-view');
    const img_1 = document.querySelectorAll('.group-input.img input')[0];
    const img_2 = document.querySelectorAll('.group-input.img input')[1];
    const imgView_1=document.querySelector('.wrap-form .product-item .top-product .img-main') 
    const imgView_2=document.querySelector('.wrap-form .product-item .top-product .img-zoom')
    const nameView=document.querySelector('.wrap-form .product-item .content-product .name-product') 
    const priceView=document.querySelector('.wrap-form .product-item .content-product .price-product .price') 
    
    let linkImg_1;

    img_1.addEventListener("change", e => {
        const file = e.target.files[0];
        linkImg_1 = URL.createObjectURL(file);
    });

    let linkImg_2;
    img_2.addEventListener("change", e => {
        const file = e.target.files[0];
        linkImg_2 = URL.createObjectURL(file);
    });

    btnView.addEventListener('click', e => {
        const nameProduct = formInfo.querySelector('#productName').value;
        const priceProduct = formInfo.querySelector('#productPrice').value;
        imgView_1.src=linkImg_1;
        imgView_2.src=linkImg_2;
        nameView.innerHTML=nameProduct
        priceView.innerHTML=priceProduct

    });
}

viewTry();
