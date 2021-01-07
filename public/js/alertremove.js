$('body').find('.alert').click(function(e){
  $(e.target).parent().remove();
})