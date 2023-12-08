
//ham toggle nhan vao 4 doi so (nút bặt, nút tắt, khongo gian tắt, hiển thị, tên class (nếu để trống thì mặc định là 'active'))

function showCart(){
    const bodyCart=document.querySelector('.body-cart');
    const btnShow=document.querySelector('.header .site-header .action .cart')
    const close={
        btn:bodyCart.querySelector('.headline-cart ion-icon'),
        space:bodyCart.querySelector('.space-block')
    }
    const showCart=new ToggleBody(bodyCart,btnShow,close.btn,close.space);// duoc viet trong file method
    
}
showCart();