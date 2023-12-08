function login(){
    const validate=new Validate()    
    const listInput=document.querySelectorAll('.group-input input')
    const btnLogin=document.querySelector('.btn-login')
    const formLogin=document.querySelector('.form-login')
    const database=JSON.parse(localStorage.getItem('account_sanny'))
    const listAccount=database?database:[]
    const remember=document.querySelector('.remember input');
    const checkAccountLogin=document.querySelector('.handle-value')
    let checkDatabase='';
    const checkLogin={
        name:'',
        pw:''
    }

    const accRemember=JSON.parse(localStorage.getItem('acountSanny_r'))

    if(accRemember){
        listInput[0].value=accRemember.name
        listInput[1].value=accRemember.pw
    }

    $(".handle-value").click(function(){
        let nameLogin = listInput[0].value;
        let url = `./php/account/login.php?nameLogin=${nameLogin}`;
        $(".check-login").load(url, function(response, status, xhr){
            if (status === "success") {
                 checkDatabase = response;
            } else {
                console.log("Đã xảy ra lỗi khi tải dữ liệu");
            }
        });
    
        return false;
    });

    listInput.forEach((items,index)=>{
        items.addEventListener('focusout',e=>{
           const check= validate.checkFill(items,'Không được để trống')
           if(index==0 && check){
                checkAccountLogin.click()
                checkAccout(items)
            }
        })
    })

    function checkAccout(input){
        const acc=listAccount.filter(items=>items.name.trim()==input.value.trim())
        if(acc.length==0){
            if(checkDatabase!='1'){
                validate.showErorr(input,'Tên đăng nhập không tồn tại')
                return false
            }
        }else{
            checkLogin.name=acc[0].name
            validate.showSuccess(input)
            return true
        }
    }

    function checkPassword(input){
        const value=listAccount.filter(items=>items.name.trim()==checkLogin.name.trim())
        if(value.length>0){
            if(input.value.trim()==value[0].password && input.value.trim()==checkDatabase){
                checkLogin.pw=input.value.trim()
                console.log(checkDatabase)
                validate.showSuccess(input)
                return true
            }else{
                validate.showErorr(input,'Sai mật khẩu')
                return false
            }
        }else{
            return false
        }
    }

    btnLogin.addEventListener('click',e=>{
        const login=checkPassword(listInput[1])
        if(!login){
            formLogin.onsubmit=function(){
                return false
            }
        }else{
            if(remember.checked){
                localStorage.setItem('acountSanny_r',JSON.stringify(checkLogin))
            }
            formLogin.onsubmit=function(){
                return true
            }
        }
    })
}
login()