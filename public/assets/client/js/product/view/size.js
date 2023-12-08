function handleSizeView(){
    const size=new Product();
    const bodyView=document.querySelector('.body-view-product')
    const nameClass='.list-size .size-item';

    const listSize=bodyView.querySelectorAll(nameClass)
    size.toggleList(listSize)
    listSize.forEach(items=>{
        items.addEventListener('click',e=>{
            const parent=items.parentElement.parentElement
            const sizeTitle=parent.querySelector('.current-size')
            size.changValue(sizeTitle,items.innerHTML)
        })
    })
    

}
handleSizeView()