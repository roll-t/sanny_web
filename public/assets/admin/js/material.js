function handleCategoty(){
    const btnAdd=document.querySelector('.add-catalog')
    function addCatalog(){
        const bodyCatalog=document.querySelector('.menu-category')
        btnAdd.addEventListener('click',e=>{
            const wrap=document.createElement('div')
            const content=`
            <div class="handle">
            <input class="name-catalog-add" name="nameMaterial" type="text" placeholder="Nhập tên chất liệu" />
            <div class="action">
            <button class="btn-add-catalog" name='confirmAddMaterial'>Thêm</button>
            </div>
        </div>
            `
            wrap.className='catalog-list';
            wrap.innerHTML=content;
            bodyCatalog.append(wrap);
            btnAdd.style.display='none'
            const catalogInput=document.querySelector('.name-catalog-add')
            const btnAddCatalog=document.querySelector('.btn-add-catalog')
            catalogInput.focus();
            btnAddCatalog.addEventListener('click',e=>{
                if(catalogInput.value.trim()==""){
                    alert('Nhập  tên danh mục')
                    catalogInput.focus();
                }else{
                    document.querySelector('.post-data-categoty').onsubmit=function(){
                        return true
                    }
                }
            })  
        })
    }
    addCatalog()

    function changeCatalog(){
        const listCatalog= document.querySelectorAll('.catalog-list')
        listCatalog.forEach(items=>{
            const btnChange= items.querySelector('.action .change')
            btnChange.addEventListener('click',e=>{
                const wrap=items.querySelector('.handle');
                const nameCatalog=items.querySelector('.name-catalog').innerHTML
                const idCatalog=items.querySelector('.id-catalog').value
                const content=`
                <input class="name-catalog-add" value='${nameCatalog}' name="nameMaterial" type="text" placeholder="Nhập tên chất liệu" />
                <div class="action">
                <button class="btn-add-catalog" value="${idCatalog}" name='confirmChangeMaterial'>Sửa </button>
                </div>
                `
                wrap.innerHTML=content;

                const catalogInput=document.querySelector('.name-catalog-add')

                const btnAddCatalog=document.querySelector('.btn-add-catalog')
                catalogInput.focus();
                btnAddCatalog.addEventListener('click',e=>{
                    if(catalogInput.value.trim()==""){
                        alert('Nhập  tên chất liệu')
                        catalogInput.focus();
                    }else{
                        document.querySelector('.post-data-categoty').onsubmit=function(){
                            return true
                        }
                    }
                }) 
            })
        })
    }
    changeCatalog();
    // function de
}

handleCategoty()