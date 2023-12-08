
function handleColorView(){
    const color=new Product();
    const bodyView=document.querySelector('.body-view-product')
    const nameClass='.list-color-product .color-item';
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
    const listColor=bodyView.querySelectorAll(nameClass);
    color.toggleList(listColor)
    listColor.forEach((items,index)=>{
        items.addEventListener('click',e=>{
            const parent=items.parentElement.parentElement
            const colorTitle=parent.querySelector('.current-color')
            colorTitle.innerHTML=valueColor[index].colorName
            colorTitle.style.color=valueColor[index].colorCode
        })
    })
}
handleColorView()