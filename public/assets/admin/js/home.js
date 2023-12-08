function showDropdown (){
    const listMenu=document.querySelectorAll('.menu .menu-items .title-menu')
    listMenu.forEach((items,index)=>{
        const parent=items.parentElement
        items.addEventListener('click',e=>{
            const menuActicing=document.querySelector('.menu .menu-items.active .title-menu')
            items.classList.add('active')
            parent.classList.remove('dropdown')
            parent.classList.add('active')
            if(menuActicing){
                menuActicing.classList.remove('active')
                menuActicing.parentElement.classList.add('dropdown')
                menuActicing.parentElement.classList.remove('active')
            }
        })
    })

}
showDropdown();