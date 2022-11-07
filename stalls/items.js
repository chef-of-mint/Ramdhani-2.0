

const colCount = $('.item_grid').css('grid-template-columns').split(' ').length;
console.log('clomn ='+colCount)
$('.buy').click(function(){
    $('.bottom')[0].classList.add("clicked");
  });
  
  $('.remove').click(function(){
    $('.bottom')[0].classList.remove("clicked");
  });
