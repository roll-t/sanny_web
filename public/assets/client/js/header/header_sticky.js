class SticKyHeader{
    constructor(){
        this.stickyHeader=document.querySelector('.header .site-header')
        this.banner=document.querySelector('.banner')
        this.toTop=document.querySelector('.to-top')
        this.heightSiteHeader=86;
        this.contact=40;
        this.space=this.heightSiteHeader+this.contact
        this.handleEvent()
    }
    handleEvent(){
        window.addEventListener('scroll',e=>{
            if(window.pageYOffset >this.space){
                this.stickyIn()
            }else{  
                this.stickyOut()
            }
        })
    }
    stickyIn(){
        this.toTop.classList.add('active')
        this.stickyHeader.classList.add('sticky')
        this.banner.style.marginTop=`${this.heightSiteHeader}px`
    }
    stickyOut(){
        this.toTop.classList.remove('active')
        this.banner.style.marginTop=`0px`;
        this.stickyHeader.classList.remove('sticky')
     
    }
}

const stickyHeader=new SticKyHeader()