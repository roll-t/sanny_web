function blockElement(btn,body){
    const bodyWindow=document.querySelector('.container-body')
    bodyWindow.addEventListener('click',e=>{
        const tag=e.target
        if(!btn.contains(tag) && !body.contains(tag)){
            body.classList.remove('active')
        }
    })
}

//############### method ###########################
// an cac element dang hien khi click ra khoi element
function blockElement(btn,body){
    const bodyWindow=document.querySelector('.container-body')
    bodyWindow.addEventListener('click',e=>{
        const tag=e.target
        if(!btn.contains(tag) && !body.contains(tag)){
            body.classList.remove('active')
        }
    })
}


// ############### class #######################

class ToggleBody{
    constructor(body,show,btnClose,spaceClose,nameClass){
        this.btnShow=show
        this.body=body
        this.btnClose={
            btn:btnClose,
            space:spaceClose
        }
        if(nameClass){
            this.nameClass=nameClass
        }else{
            this.nameClass='active'
        }
        this.handleEvent()
    }
    handleEvent(){
        if(this.btnShow){
            this.btnShow.addEventListener('click',e=>{
                this.body.classList.add(this.nameClass)
            })
        }
        if(this.btnClose.btn){
            this.btnClose.btn.addEventListener('click',e=>{
                this.body.classList.remove(this.nameClass)
            })
        }
        if(this.btnClose.space){
            this.btnClose.space.addEventListener('click',e=>{
                this.body.classList.remove(this.nameClass)
            })
        }
    }
  
}

class ToggleIList{
    constructor(list){
        this.list=list
        this.toggleList();
        this.valueChange=valueChange
    }
    removeActive(){
        this.list.forEach(value=>{
            value.classList.remove('active')
        })
    }
    toggleList(){
        if(this.list.length>0){
            this.list.forEach((items)=>{
                items.addEventListener('click',e=>{
                    this.removeActive();
                    items.classList.toggle('active')
                })
            })
        }
    }
}