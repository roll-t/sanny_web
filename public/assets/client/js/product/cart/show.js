// hien phần thêm vào giỏ hàng của sản phẩm
function ShowAddCartProduct(){
    const cartProduct=new Product();
    const listProduct=cartProduct.listProduct

    listProduct.forEach((items)=>{
        const body=items.querySelector('.select-add-cart')
        const btn={
            show:items.querySelector('.top-product .action .add-cart'),
            close:body.querySelector('.point-close')
        }
        cartProduct.toggleBody(body,btn.show,btn.close)
        blockElement(btn.show,body);// lay tu file method.js
    })
}
ShowAddCartProduct()

