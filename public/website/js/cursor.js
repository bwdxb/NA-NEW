const cursor=document.querySelector(".cursor"),cursorInner=document.querySelector(".cursor-move-inner"),cursorOuter=document.querySelector(".cursor-move-outer"),trigger=document.querySelector("button");let mouseX=0,mouseY=0,mouseA=0,innerX=0,innerY=0,outerX=0,outerY=0,loop=null;function render(){loop=null,innerX=lerp(innerX,mouseX,.15),innerY=lerp(innerY,mouseY,.15),outerX=lerp(outerX,mouseX,.13),outerY=lerp(outerY,mouseY,.13);const angle=180*Math.atan2(mouseY-outerY,mouseX-outerX)/Math.PI,normalX=Math.min(Math.floor(Math.abs(mouseX-outerX)/outerX*1e3)/1e3,1),normalY=Math.min(Math.floor(Math.abs(mouseY-outerY)/outerY*1e3)/1e3,1),normal=normalX+.5*normalY,skwish=.7*normal;cursorInner.style.transform=`translate3d(px, px, 0)`,cursorOuter.style.transform=`translate3d(px, px, 0) rotate(deg) scale(${1+skwish}, ${1-skwish})`,0!==normal&&(loop=window.requestAnimationFrame(render))}function lerp(s,e,t){return(1-t)*s+t*e}function appear(index){anime({targets:`.section:nth-child() h1`,opacity:[0,1],duration:anime.random(300,600),easing:"easeInOutQuad"})}function disappear(){anime({targets:"h1",opacity:[1,0],duration:anime.random(200,400),easing:"easeInOutQuad"})}document.addEventListener("mousemove",e=>{mouseX=e.clientX,mouseY=e.clientY,loop||(loop=window.requestAnimationFrame(render))}),trigger.addEventListener("mouseenter",()=>{cursor.classList.add("cursor--hover")}),trigger.addEventListener("mouseleave",()=>{cursor.classList.remove("cursor--hover")}),animejsPlugins.scrollContainer({sectionSelector:".section",wrapperSelector:".sections",duration:1e3,easing:"easeInOutQuad",onBegin:(index,anime)=>{disappear()},onComplete:(index,anime)=>{appear(index)}});