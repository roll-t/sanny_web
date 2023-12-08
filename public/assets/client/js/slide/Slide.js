class Slide{
    constructor(){
    }
    
    getClassName(value){
        let check=value.className.split(' ')
        let nameClass = check.length>1?check[0]:value.className
        return nameClass
    }

    slideSlip(wrap,list,next,prev,dots){
        let current=0;
        let lengthList=list.length
        let nameActiveDot=this.getClassName(dots[0])
        let nameClassParent=this.getClassName(wrap)

        function handleEvent(){
            next.addEventListener('click',e=>{
                let size=list[0].offsetWidth
                if(current>lengthList-2)
                {
                    current=0
                }else{
                    current+=1;
                }
                handleDots(dots,current)
                slideAction(size,current)
            })
            prev.addEventListener('click',e=>{
                let size=list[0].offsetWidth
                if(current>0){
                    current-=1;
                    handleDots(dots,current)
                    slideAction(size,current)
                }
            })
        }   
        dots.forEach((items,index)=>{
            items.addEventListener('click',e=>{
                let size=list[0].offsetWidth
                handleDots(dots,index)
                slideAction(size,index)
            })
        })

        function handleDots(dots,current){
            let dotActive=document.querySelector(`.${nameClassParent} .${nameActiveDot}.active`)
            dotActive.classList.remove('active')
            dots[current].classList.add('active')
        }

        function slideAction(size,current){
            let spaceLeft=size*current;
            list[0].style.marginLeft=`${-spaceLeft}px`
        }

        handleEvent()
    }

    slideCurrent(wrap,list,btnNext,btnPrve,auto=false,time=3000){
        let current=0;
        const nameClassWrap=this.getClassName(wrap)
        const nameClassSlideItems=this.getClassName(list[0])
        btnNext.addEventListener("click",e=>{
            current=1;
            slide(current)
        })
        btnPrve.addEventListener("click",e=>{
            current=2;
            slide(current)
        })

        if(auto){
            var autoSlide=setInterval(()=>{btnNext.click()},time)
        }
       function slide(current){
            if(auto){
                clearInterval(autoSlide)
                autoSlide=setInterval(()=>{btnNext.click()},time)
            }
            if(current==1){
                const list=document.querySelectorAll(`.${nameClassWrap} .${nameClassSlideItems}`)
                wrap.appendChild(list[0])
            }
            if(current==2){
                const list=document.querySelectorAll(`.${nameClassWrap} .${nameClassSlideItems}`)
                wrap.prepend(list[list.length-1])
            }
        }
    }
}