$(function($){
  $('.comments a.reply').on('click', function(e){
    $.scrollTo('#comment-form', 300, {offset:-40})
    var $this = $(this)
      , id = $this.attr('data-id')
      , author = $this.attr('data-author')
      , $form = $('#comment-form')
      , textArea = $('textarea', $form).val('回复 ' + author + ': ').focus().get(0)
    
    textArea.setSelectionRange(textArea.value.length, textArea.value.length)
    $('#parent', $form).val(id);
  })
})