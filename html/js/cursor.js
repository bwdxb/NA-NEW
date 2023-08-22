// Stats
// const stats = new Stats(); stats.showPanel(0); document.body.appendChild(stats.dom);

const cursor = document.querySelector('.cursor');
const cursorInner = document.querySelector('.cursor-move-inner');
const cursorOuter = document.querySelector('.cursor-move-outer');

const trigger = document.querySelector('button');

let mouseX = 0;
let mouseY = 0;
let mouseA = 0;

let innerX = 0;
let innerY = 0;

let outerX = 0;
let outerY = 0;

let loop = null;

document.addEventListener('mousemove', (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
  
  if (!loop) {
    loop = window.requestAnimationFrame(render);
  }
});

trigger.addEventListener('mouseenter', () => {
  cursor.classList.add('cursor--hover');
});

trigger.addEventListener('mouseleave', () => {
  cursor.classList.remove('cursor--hover');
});

function render() {
  // stats.begin();

  loop = null;
  
  innerX = lerp(innerX, mouseX, 0.15);
  innerY = lerp(innerY, mouseY, 0.15);
  
  outerX = lerp(outerX, mouseX, 0.13);
  outerY = lerp(outerY, mouseY, 0.13);
  
  const angle = Math.atan2(mouseY - outerY, mouseX - outerX) * 180 / Math.PI;
  
  const normalX = Math.min(Math.floor((Math.abs(mouseX - outerX) / outerX) * 1000) / 1000, 1);
  const normalY = Math.min(Math.floor((Math.abs(mouseY - outerY) / outerY) * 1000) / 1000, 1);
  const normal  = normalX + normalY * .5;
  const skwish  = normal * .7;
    
  cursorInner.style.transform = `translate3d(${innerX}px, ${innerY}px, 0)`;
  cursorOuter.style.transform = `translate3d(${outerX}px, ${outerY}px, 0) rotate(${angle}deg) scale(${1 + skwish}, ${1 - skwish})`;
  
  // stats.end();
  
  // Stop loop if interpolation is done.
  if (normal !== 0) {
    loop = window.requestAnimationFrame(render);
  }
}

function lerp(s, e, t) {
  return (1 - t) * s + t * e;
}



animejsPlugins.scrollContainer({
  sectionSelector: '.section',
  wrapperSelector: '.sections',
  duration: 1000,
  easing: 'easeInOutQuad',
  onBegin: (index, anime) => {
    disappear()
  },
  onComplete: (index, anime) => {
    appear(index);
  } 
})

function appear(index) {
  anime({
    targets: `.section:nth-child(${index}) h1`,
    opacity: [0, 1],
    duration: anime.random(300, 600),
    easing: 'easeInOutQuad'
  })
}

function disappear() {
  anime({
    targets: `h1`,
    opacity: [1, 0],
    duration: anime.random(200, 400),
    easing: 'easeInOutQuad'
  })
}