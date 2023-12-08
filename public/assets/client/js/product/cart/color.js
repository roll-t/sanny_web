
function handleColor(){
    const cartProduct=new Product();
    const listProduct=cartProduct.listProduct
    const nameClass='.select-add-cart .list-color-product .color-item';

    const valueColor=[
        {
            colorCode:'#bdc3c7',
            colorName:'Trắng'
        },
        {
            colorCode:'#000',
            colorName:'Đen'
        },
        {
            colorCode:'rgb(86, 4, 4)',
            colorName:'Nâu'
        }
    ]


    listProduct.forEach(items=>{
        const listColor=items.querySelectorAll(nameClass);
        cartProduct.toggleList(listColor)
    })
    
    listProduct.forEach(items=>{
        const listColor=items.querySelectorAll(nameClass);
        listColor.forEach((value,index)=>{
            value.addEventListener('click',e=>{
                const parent=value.parentElement.parentElement
                const colorTitle=parent.querySelector('.current-color')
                colorTitle.innerHTML=valueColor[index].colorName
                colorTitle.style.color=valueColor[index].colorCode
            })
        })
    })
}
handleColor()