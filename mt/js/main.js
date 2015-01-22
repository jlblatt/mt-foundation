$(document).foundation();



$(document).ready(function() {

  //$("form").find('input[type="file"]').val('');

  $(document).on('submit', 'form.ajax-form-standard', function() {
    $.ajax({
      url     : $(this).attr('action'),
      type    : $(this).attr('method'),
      dataType: 'json',
      data    : $(this).serialize(),
      processData: false,
      contentType: false,
      success : function(data) {
        if(data.success) $(this).reset();

        $(this).find('.form-result').empty().append(
          '<div data-alert class="alert-box ' + data.status + '">' + data.msg + '<a href="#" class="close">&times;</a></div>'
        );
      },
      error   : function() {
        $(this).find('.form-result').empty().append(
          '<div data-alert class="alert-box alert">Error: 500 ISE - Sorry :(<a href="#" class="close">&times;</a></div>'
        );
      }
    });    
    return false;
  });

  $(".dashboard .columns").sortable({
    items: '.panel',
    cursor: "grabbing",
    handle: ".title",
    connectWith: '.dashboard .columns',
    start: function()
    {

    },
    stop: function()
    {
      //cookie user here
    }
  });

});



$(window).load(function(){

});