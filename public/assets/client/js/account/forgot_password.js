function forgotPassword(){
    const validate=new Validate()    
    const listInput=document.querySelectorAll('.group-input input')
    const getPassword=document.querySelector('.get-password')
    const formForgot=document.querySelector('.from-forgot-password')
    const database=JSON.parse(localStorage.getItem('account_sanny'))
    const passwordHidden=document.querySelector('.get-password-hidden')
    const listAccount=database?database:[]
    let check=false

    listInput.forEach((items,index)=>{
        items.addEventListener('focusout',e=>{
            if(index==0){
                checkAccout(items)
            }
        })
    })

    function checkAccout(input){
        const acc=listAccount.filter(items=>items.name==input.value.trim())
        if(acc.length>0){
            validate.showSuccess(input)
            check=acc[0].name
            return true
        }else{
            validate.showErorr(input,'Tài khoản không tồn tại')
            return false
        }
    }

    getPassword.addEventListener('click',e=>{
        if(check){
            const confirm=listAccount.filter(items=>items.name.trim()==check.trim())
            if(listInput[1].value==confirm[0].mail || listInput[1].value==confirm[0].phone){
                validate.showSuccess(listInput[1])
                passwordHidden.value=confirm[0].password
                formForgot.onsubmit=function(){
                    return true
                }
            }else{
                validate.showErorr(listInput[1],'sai thông tin')
                formForgot.onsubmit=function(){
                    return false
                }
            }
        }
    })

}
forgotPassword()