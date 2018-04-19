(function(){
  var $content = $('#user-options').detach();   // Remove modal from page

  $('#user').on('click', function() {           // Click handler to open modal
    modal.open({content: $content, width:320});
  });
}());