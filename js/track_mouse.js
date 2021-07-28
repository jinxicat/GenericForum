var x = null;
var y = null;

document.addEventListener('click', onMouseUpdate, false);
document.addEventListener('mouseenter', onMouseUpdate, false);

function onMouseUpdate(e) {
  x = e.pageX;
  y = e.pageY;
  console.log(x, y);
  sessionStorage.removeItem('ypos');
  sessionStorage.setItem('ypos', y);
}
