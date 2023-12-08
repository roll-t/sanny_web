
class AddCart{
    constructor(){
        this.body=document.querySelector('.body-cart')
        this.listProduct=document.querySelectorAll('.product-item')
        this.btnShowCart=document.querySelector('.site-header .action .cart')
        this.database=[]
        this.checkConfirm=[]
        this.setDatabase()
        this.handleDataBase()
        this.addCart()
        this.showQuantityCart()
    }
    setDatabase(){  
        let data=JSON.parse(localStorage.getItem('cartValue'))
        this.database=data?data:[]
    }
    handleDataBase(){
        const wrapProductCart=this.body.querySelector('.list-product-cart')
        const listProduct=wrapProductCart.querySelectorAll('.cart-items')
        listProduct.forEach(items=>{
            items.remove()
        })
        if(this.database.length>0){
            this.database.forEach((items)=>{
                this.renderCartItems(wrapProductCart,items)
            })
        }
        this.checkConfirm=[]
        this.handleCartItems()
        this.showQuantityCart()
    }
    getvalueProduct(wrap){
        const selectAddCart=wrap.querySelector('.select-add-cart')
        const topCart=wrap.querySelector('.top-product ')
        const contentCart=wrap.querySelector('.content-product ')
        const valueProduct={
            name:contentCart.querySelector('.name-product').innerHTML,
            price:selectAddCart.querySelector('.price-number').innerHTML,
            img:topCart.querySelector('.img-main').src,
            color:selectAddCart.querySelector(' .current-color').innerHTML,
            size:selectAddCart.querySelector('.current-size').innerHTML,
            quantity:selectAddCart.querySelector('.quantity-item.number').value,
            id:wrap.querySelector('.id-product').value
        }
        return valueProduct
    }
    addCart(){ 
        this.listProduct.forEach(items=>{
            const btn=items.querySelector('.btn-confirm')
            btn.addEventListener('click',e=>{
                const valueProduct=this.getvalueProduct(items)
                const idProduct=valueProduct.id
                let checkSame=this.checkSameProduct(idProduct)
                if(!checkSame){
                    this.database.unshift(valueProduct)
                }
                localStorage.setItem('cartValue',JSON.stringify(this.database))
                this.handleDataBase()
                this.btnShowCart.click()
      
            })
        })
    }
    renderCartItems(wrapList,value){
        const wrap=document.createElement('div')
        wrap.className='cart-items'
        const content=`
                    <div class="left-cart-items">
                        <img src="${value.img}" alt="" class="img">
                    </div>
                    <div class="right-cart-items">
                        <div class="top">
                            <div class="name-product">
                                ${value.name}
                            </div>
                            <div class="close remove-cart-items"><ion-icon name="close-outline"></ion-icon></div>
                        </div>
                        <div class="center">
                            <p>Size: </p><span>${value.size}</span>
                        </div>
                        <div class="bottom">
                            <div class="add-cart form-quantity">
                                <div class="quantity">
                                    <div class="input">
                                        <div class="prve quantity-item">-</div>
                                        <input class="number quantity-item" value="${value.quantity}" min="1" type="text">
                                        <div class="next quantity-item">+</div>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <p class="price-cart">${value.price}</p><span>VND</span>
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" class="check-confirm">
                    <input value='${value.id}' type="hidden" class="id-cart-items">
                `
        wrap.innerHTML=content
        wrapList.append(wrap)
    }
    checkSameProduct(id){
        var isTrue=false
        var temp
        this.database.forEach((items,index)=>{
            if(items.id==id){
                let quantity=Number(this.database[index].quantity)
                quantity+=1
                this.database[index].quantity=quantity
                isTrue=true
                temp=items
            }
        })
        if(isTrue){
            this.database=this.database.filter(items=> items.id!=id)
            this.database.unshift(temp)
        }
        return isTrue
    }
    getValueProductCart(value){
        if(value){
            const valueProductCart={
                price:value.querySelector('.price-cart').innerHTML,
                quantity:value.querySelector('.quantity-item.number').value
            }
            return valueProductCart
        }
    }
    handleCartItems(){
        const listProductCart=this.body.querySelectorAll('.cart-items')
        
        if(listProductCart.length>0){
            listProductCart.forEach((items,index)=>{
                const btnRemove=items.querySelector('.remove-cart-items')
                const check=items.querySelector('.check-confirm')  
                const quantity=items.querySelector('.quantity-item.number')
                const formInput=items.querySelector('.form-quantity')
                const inputQuantity=new Input_1(items);
                this.makeInput(formInput)
                const btn={
                    next:items.querySelector('.quantity-item.next'),
                    prev:items.querySelector('.quantity-item.prve')
                }
                btnRemove.addEventListener('click',e=>{ 
                   const idCart=btnRemove.parentElement.parentElement.parentElement.querySelector('.id-cart-items').value
                   this.handleRemove(idCart)
                   this.handleDataBase()
                   this.totalPrice()
                })
                check.addEventListener('change',e=>{
                    const idCart=btnRemove.parentElement.parentElement.parentElement.querySelector('.id-cart-items').value
                    let checkInput=this.handleCheck(index,check.checked,idCart)
                    if(checkInput){
                        this.makeInput(formInput,false)
                    }else{
                        this.makeInput(formInput,true)
                    }
                    this.showCheckOut()
                    this.totalPrice()
                })

                btn.next.addEventListener('click',e=>{
                    this.handleQuantity(index,quantity.value)
                })
                btn.prev.addEventListener('click',e=>{
                    this.handleQuantity(index,quantity.value)
                })
                quantity.addEventListener('change',e=>{
                    this.handleQuantity(index,quantity.value)
                })
            })
        }
    }
    makeInput(body,active=true){
        if(active){
            const wrap=document.createElement('div')
            wrap.className='make'
            body.append(wrap)
        }else{
            const make=body.querySelector('.make')
            if(make){
                make.remove()
            }
        }
    }
    handleRemove(id){
        if(id){
            this.database=this.database.filter(item=>item.id!=id)
            localStorage.setItem('cartValue',JSON.stringify(this.database))
        }
    }
    handleCheck(current,check,id){
        const cartItems=this.body.querySelectorAll('.cart-items')[current]
        var istrue=false
        if(check){
            this.checkConfirm.push(id)
            cartItems.classList.add('active')
            istrue=true
        }else{
            this.checkConfirm=this.checkConfirm.filter(item=>item!=id)
            cartItems.classList.remove('active')
            istrue=false
        }
        return istrue
    }
    handleQuantity(index,value){
        if(isNaN(value)){
            value=1;
        }
        this.database[index].quantity=value
        localStorage.setItem('cartValue',JSON.stringify(this.database))
        this.totalPrice()
    }
    totalPrice(){
        const arrValue=[]
        let total=0;
        const wrapPrice=this.body.querySelector('.headline-cart .sum-price')
        this.database.forEach(items=>{
            this.checkConfirm.forEach(value=>{
                if(items.id==value){
                    arrValue.push(items)
                }
            })
        })
        if(arrValue.length>0){
            arrValue.forEach(items=>{
                total+=(Number(items.price)*items.quantity)
            })
            wrapPrice.innerHTML=total.toLocaleString('en-US')
        }else{
            wrapPrice.innerHTML=0
        }
    }
    showCheckOut(){
        const checkOut=this.body.querySelector('.checkout')
        if(this.checkConfirm.length>0){
            checkOut.classList.add('active')
        }else{
            checkOut.classList.remove('active')
        }
    }
    showQuantityCart(){
        const quantity=this.btnShowCart.querySelector('.quantity-cart')
        if(this.database.length>0){
            quantity.classList.add('active')
            quantity.innerHTML=this.database.length
        }else{
            quantity.classList.remove('active')
        }
    }

}

const addCart= new AddCart();


