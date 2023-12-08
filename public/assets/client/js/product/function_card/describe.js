function handleTag(){
    const listProduct=document.querySelectorAll('.list-product .product-item')
    const color=[
        'white',
        'black',
        'brow'
    ]
    
    const actionValue=['Xem','Thêm']
    
    listProduct.forEach(value=>{
        value.addEventListener("mouseover",()=>{
        const listColor=value.querySelectorAll(".content-product .list-color-product .color-item")
        const action=value.querySelectorAll('.action .action-item')
        const like=value.querySelector(".like")
        if(!(value.querySelector(".des_tag"))){
            renderTag(action,actionValue);
            if(listColor!=null){
                renderTag(listColor,color);
            }
            // renderTag(like,'Đăng nhập trước !');
        }
        })
    })
    function renderTag(value,color){
        let nameTag='des_tag';
        if(value.length>=0){
            value.forEach((items,index)=>{
                items.style.position="relative"
                const wrap=document.createElement("div")
                wrap.className=nameTag
                wrap.innerHTML=color[index];
                items.append(wrap);
            })
        }else{
            const wrap=document.createElement("div")
            wrap.className=nameTag
            wrap.innerHTML=color;
            value.append(wrap);
        }
    }
}
handleTag();