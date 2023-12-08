function categoryItems(){
    const catalogList=document.querySelectorAll('.catalog-list')
    
    catalogList.forEach(items=>{
        const btn=items.querySelector('.add-category-items')
        const body=items.querySelector('.category-list')
        const idCatalog=items.querySelector('.id-catalog').value

        btn.addEventListener('click',e=>{
            const wrap=document.createElement('div')
            const content=`
            <input class="input-category-items" name="dm_ten"  placeholder="nhap vao ten danh muc" />
            <input type="hidden" name="ndm_id" value="${idCatalog}" />
            <div class="action">
            <button class="btn-category-items">Thêm danh mục</button>
            </div>
            `
            wrap.className='category-items'
            wrap.innerHTML=content
            body.appendChild(wrap)
            btn.style.display="none";
            const btnAdd=document.querySelector('.btn-category-items')
            const inputAdd=document.querySelector('.input-category-items')
            inputAdd.focus();
        })
    })

}
categoryItems()