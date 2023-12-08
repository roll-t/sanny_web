
class Search{
    constructor(){
        this.ttl=0;
        this.eventAction=0;
        this.wrapSearch=document.querySelector('.headline .action .search')
        this.search={
            input:this.wrapSearch.querySelector('input'),
            btn:this.wrapSearch.querySelector('button')
        }
        this.handleEvent()
    }
    handleEvent(){
        const wrapSearch=this.wrapSearch
        const searchInput=this.search.input
        wrapSearch.addEventListener('click',e=>{
            this.eventAction=1;
            this.handleInput(this.eventAction)
        })
        searchInput.addEventListener('focusout',e=>{
            this.eventAction=2;
            this.handleInput(this.eventAction)
        })
    }

    handleInput(eventAction){
        const searchInput=this.search.input
        if(eventAction==1){
            searchInput.classList.add('active')
            setTimeout(()=>{
                searchInput.placeholder='Tìm kiếm ...'
            },300)
            searchInput.focus()
        }
        if(eventAction==2){
            if(searchInput.value.trim()==''){
                searchInput.classList.remove('active')
                setTimeout(()=>{
                    searchInput.placeholder=''
                },300)
                searchInput.blur()
            }
        }
    }
}
const search=new Search();