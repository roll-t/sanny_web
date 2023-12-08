function showBodyView(){
    const view= new Product();
    const listProduct=view.listProduct
    const bodyView=document.querySelector('.body-view-product')
    const close={
        btn:bodyView.querySelector('.right-container .close'),
        space:bodyView.querySelector('.close-body')
    }

    listProduct.forEach(items=>{
        const btnShow=items.querySelector('.action .view-more')
        view.toggleBody(bodyView,btnShow,close.btn,close.space)
    })
}
showBodyView()