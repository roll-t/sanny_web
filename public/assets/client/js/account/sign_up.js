
function validateFormSignUp(){
    const validate=new Validate();
    const listInput=document.querySelectorAll('.group-input .input-signup')
    const btnSignUp=document.querySelector('.confirm-sign-up')
    const formSubmit=document.querySelector('.form-value-sign-up')
    const dataAcc=JSON.parse(localStorage.getItem('account_sanny'))
    const arrAccount=dataAcc?dataAcc:[]
    const input={
        name:listInput[0],
        mail:listInput[1],
        phone:listInput[2],
        pw:listInput[3],
        cf_pw:listInput[4]
    }
    let checkForm={
        name:false,
        mail:false,
        phone:false,
        pw:false,
        cf_pw:false
    };
    listInput.forEach((items,index)=>{
        items.addEventListener('focusout',e=>{
            const check=validate.checkFill(items,'không được để trống')
            if(check){
                if(index==0){
                  checkForm.name=validate.checkLength(input.name,3,15)
                  if(checkForm.name){
                    checkForm.name=validate.fromaUserName(items)
                    if(checkForm.name){
                        checkForm.name=checkSame(items)
                    }
                  }
                }if(index==1){
                  checkForm.mail=validate.checkEmail(input.mail)
                }if(index==2){
                  checkForm.phone=validate.checkPhone(input.phone)
                }
                if(index==3 || index==4){
                    const value=validate.checkLength(input.pw,4,12)
                    checkForm.pw=value
                    if(value){
                        checkForm.cf_pw=validate.checkPassword(input.pw,input.cf_pw)
                    }
                }
            }
        })
    })

    function checkSame(input){
        const value=arrAccount.filter(items=>items.name.trim()==input.value.trim())
        if (value.length>0){
            validate.showErorr(input,'Tên đăng nhập đã tồn tại')
            return false
        }else{
            validate.showSuccess(input)
            return true
        }
    } 



    btnSignUp.addEventListener('click',e=>{
        listInput.forEach(items=>{
            validate.checkFill(items,'không được để trống')
        })
        console.log(checkForm)
        if(checkForm.name && checkForm.mail && checkForm.phone && checkForm.pw && checkForm.cf_pw){
            const accSignUp={
                name:input.name.value,
                phone:input.phone.value,
                mail:input.mail.value,
                password:input.pw.value
            }
            arrAccount.push(accSignUp)
            localStorage.setItem('account_sanny',JSON.stringify(arrAccount))
            formSubmit.onsubmit=function(){
                return true
            }
        }else{
            formSubmit.onsubmit=function(){
                return false
            }
        }
    })
}
validateFormSignUp()