$(function($){
  $('.navigation li a').click(function(e){
    e.preventDefault()
    var id = this.href.replace(/^.*#/, '#')
    $.scrollTo(id, 300, {offset:-40})
    //$(this).parents('.navigation').find('li').removeClass('active')
    //$(this).parent('li').addClass('active')
    //console.dir($(id))
  })
  $(window).scrollspy({offset:50, target:'.navigation'})
})
