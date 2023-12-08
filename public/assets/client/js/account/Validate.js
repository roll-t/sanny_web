class Validate{
    constructor(){
        
    }
    showErorr(input,text){
        const parent=input.parentElement
        const erorr=parent.querySelector('.erorr')
        const line=parent.querySelector('.line')
        erorr.innerHTML=text
        line.style.background='red'
        line.style.width='100%'
    }
    showSuccess(input){
        const parent=input.parentElement
        const erorr=parent.querySelector('.erorr')
        const line=parent.querySelector('.line')
        erorr.innerHTML=''
        line.style.background='#636e72'
    }

    checkFill(input,text){
        if(input.value.trim()==""){
            this.showErorr(input,text)
            return false
        }else{
            this.showSuccess(input)
            return true
        }
    }
    fromaUserName(input){
        if(input.value.trim().indexOf(' ') >= 0){
            this.showErorr(input,'Tên đăng nhập không chứa dấu "cách" ')
            return false
        }else{
            this.showSuccess(input)
            return true
        }
    }
    checkLength(input,min,max){
        if(input.value.length<min){
            this.showErorr(input,`Phải có ít nhất ${min} ký tự`);
            return false
        }else if(input.value.length>max){
            this.showErorr(input,`Tối đa ${max} ký tự`);
            return false
        }else{
            this.showSuccess(input)
            return true;
        }
    }
    checkEmail(input){
        const regex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if(!regex.test(input.value.trim())){
            this.showErorr(input,`Sai định dạng mail`);  
            return false
        }else{
            this.showSuccess(input)
            return true
        }
    }
    checkPhone(input){
        const regex=/(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
        if(!regex.test(input.value.trim())){
            this.showErorr(input,'Sai định dạng số điện thoại')
            return false
        }else{
            this.showSuccess(input)
            return true
        }
    }
    checkPassword(input_1,input_2){
        if(input_1.value.trim()!=input_2.value.trim()){
            this.showErorr(input_2,'Mật khẩu không trùng khớp');
            return false
        }else{
            this.showSuccess(input_2)
            return true
        }
    }
    

}