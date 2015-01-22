"use strict";

$(document).foundation();



$(document).ready(function() {
  
  ////////////////////////
  // file browser
  ////////////////////////
  $.fn.filebrowser = function(args) {

    args = typeof args !== 'undefined' ? args : {};

    return this.each(function() {

      if("refresh" in args && args.refresh)
      {
        var url = $(this).data("url");
        $.ajax({
          dataType: "json",
          url: url,
          //data: data,
          context: $(this).children(".files"),
          success: function(data) {
            if(data.length == 0) $(this).html('<p>No uploads yet!</p>');
            else
            {
              $(this).html('<ul class="small-block-grid-3 medium-block-grid-4 large-block-grid-5">');
              var $fileList = $(this).children('ul');
              var path = $(this).parents(".filesystem").data("file-root");
              for(var i = 0; i < data.length; i++)
              {
                $fileList.append('<li><img src="' + path + 'thumbnail/' + data[i] + '" /></li>');
              }
            }
            
          }
        });
      }      
    });

  };


  $(".filesystem").filebrowser({"refresh" : 1});


  ////////////////////////
  // file upload
  ////////////////////////

  $('.file-field').fileupload({
    dataType: 'json',
    dropZone: $(this).parents(".file-upload").find(".input-wrapper"),
    add: function (e, data) {
      data.context = $('<p/>').html('<div data-alert class="alert-box secondary">Uploading...</div>').appendTo($(this).parents(".file-upload").find(".results"));
      data.submit();
    },
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $(this).parents(".file-upload").find(".progress .meter").css(
        'width',
        progress + '%'
      );
    },
    done: function (e, data) {
      $.each(data.result.files, function (index, file) {
        data.context.parents(".file-browser").children(".filesystem").filebrowser({"refresh" : 1})
        data.context.html('<div data-alert class="alert-box success radius">Finished!</div>');
        setTimeout(function(){
          data.context.fadeOut();
        }, 3000);
      });
    }
  });

  ////////////////////////
  // dashboard
  ////////////////////////

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