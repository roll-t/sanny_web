function handleSize(){
    const cartProduct=new Product();
    const listProduct=cartProduct.listProduct
    const nameClass='.select-add-cart .list-size .size-item';
    listProduct.forEach(items=>{
        const listSize=items.querySelectorAll(nameClass);
        cartProduct.toggleList(listSize)
    })
    listProduct.forEach(items=>{
        const listSize=items.querySelectorAll(nameClass);
        listSize.forEach((value)=>{
            value.addEventListener('click',e=>{
                const parent=value.parentElement.parentElement
                const sizeTitle=parent.querySelector('.current-size')
                sizeTitle.innerHTML=value.innerHTML
            })
        })
    })
}
handleSize()