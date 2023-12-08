class Product{
    constructor(){
        this.listProduct=document.querySelectorAll('.list-product .product-item');
    }

    getProduct(index){
        return this.listProduct[index]
    }
    //ẩn hiện 1 thẻ
    toggleBody(body,show,btnClose,spaceClose,nameClass='active'){
         if(show){
             show.addEventListener('click',e=>{
                 body.classList.add(nameClass)
             })
         }
         if(btnClose){
             btnClose.addEventListener('click',e=>{
                 body.classList.remove(nameClass)
             })
         }
         if(spaceClose){
             spaceClose.addEventListener('click',e=>{
                 body.classList.remove(nameClass)
             })
         }
    }

    // hiện hiệu ứng của thẻ được chỉ định trong danh sách và ẩn các hiệu ứng thẻ còn lại
    toggleList(list,nameClass){
        if(!nameClass){
            nameClass='active'
        }
        function removeActive(){
            list.forEach(items=>{
                items.classList.remove(nameClass)
            })
        }
        function addACtive(){
            list.forEach(items=>{
                items.addEventListener('click',e=>{
                    removeActive()
                    items.classList.add(nameClass)
                })
            })
        }
        addACtive()
    }

    renderListColor(list,classTag,content){
        const arrValue=[]
        if(list.length>0){
            const tag=document.createElement('div')
            if(classTag){
                tag.className=classTag
            }
            tag.innerHTML=content
            arrValue.push(tag)
        }
        return arrValue;
    }

    changValue(wrap,value){
        wrap.innerHTML=value
    }

}