class Input_1{
    constructor(body,action=true){
        this.current=0;
        this.body=body
        this.changeClass=false
        this.action=action
        if(!this.changeClass){
            this.input={
                next:this.body.querySelector(".form-quantity .input .next"),
                prve:this.body.querySelector(".form-quantity .input .prve"),
                number:this.body.querySelector('.form-quantity .input .number')
            }
        }else{
            const valueChang=this.changeClass(btnNext,btnPrve,inputNumber)
            this.input={
                next:valueChang.btnNext,
                prve:valueChang.btnPrve,
                number:valueChang.inputNumber
            }
        }
        if(this.action){
            this.handleEvent();
        }
    }
    breakInput(){
        this.action=false
    }
    handleEvent(){
        this.input.next.addEventListener('click',e=>{
            this.current=1;
            this.increase(this.current);
            if(this.input.number.value>=100){
                this.input.number.value=100
            }
        })
        this.input.prve.addEventListener("click",e=>{
            this.current=2
            if(this.input.number.value>1){
                this.increase(this.current);
            }
            if(this.input.number.value>=100){
                this.input.number.value=100
            }
        })
        this.input.number.addEventListener('focusout',e=>{
            if(this.input.number.value==0){
                this.input.number.value=1;
            }
            if(this.input.number.value<0){
                let number= Number(this.input.number.value)
                number*=-1;
                this.input.number.value=number 
            }
            if(isNaN(this.input.number.value)){
                this.input.number.value=1;
            }
            if(this.input.number.value>=100){
                this.input.number.value=100
            }
        })
    }
    increase(current){
        if(current==1){
            let number= Number(this.input.number.value)
            number+=1
            this.input.number.value=number
        }else if(current==2){
            let number= Number(this.input.number.value)
            number-=1
            this.input.number.value=number
        }
    }
    customClass(next,prve,number){
        this.changeClass=true;
        return {
            next,
            prve,
            number
        }
    }
}
