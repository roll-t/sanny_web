function slideHeader(){
    const slide = new Slide();
    const wrap= document.querySelector('.banner .slide')
    const list= wrap.querySelectorAll('.slide-items')
    const btn={
        prev:document.querySelector('.banner .ctrl-1 .btn-prev'),
        next:document.querySelector('.banner .ctrl-1 .btn-next')
    }
    slide.slideCurrent(wrap,list,btn.prev,btn.next,true,5000);
}

slideHeader()