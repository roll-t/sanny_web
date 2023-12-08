function renderSale(){
    const sale=new Product();
    const listProduct=sale.listProduct
    const listIdProduct=[
        {
            id:1,
            sale:7
        },
        {
            id:3,
            sale:10
        },
        {
            id:5,
            sale:5
        },
        {
            id:2,
            sale:12
        },
        {
            id:10,
            sale:12
        }
    ];

    listIdProduct.forEach(items=>{
        if(items.id<listProduct.length){
            const wrap=document.createElement("div")
            wrap.className='sale'
            wrap.innerHTML=`${items.sale}%`
            listProduct[items.id-1].querySelector('.top-product').append(wrap)
        }
    })
}

renderSale();