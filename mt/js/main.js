"use strict";

$(document).foundation();



$(document).ready(function() {
  
  ////////////////////////
  // file browser
  ////////////////////////
  console.log("one global file browser/uploader");

   $.fn.filebrowser = function(args) {

    args = typeof args !== 'undefined' ? args : {"init" : true};

    return this.each(function() {

      if(("init" in args && args.init) || ("refresh" in args && args.refresh))
      {
        var url = $(this).data("url");

        $.ajax({
          dataType: "json",
          url: url,
          context: $(this).children(".files"),
          success: function(data) {
            if(data.length == 0) $(this).html('<p>No uploads yet!</p>');
            else
            {
              $(this).html('<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5"></ul>');
              var $fileList = $(this).children('ul');
              var path = $(this).parents(".filesystem").data("file-root");

              data.sort(function(a,b) {
                return a.isdir ? -1 : 1;
              });

              for(var i = 0; i < data.length; i++)
              {
                if(data[i].isdir)
                {
                  $fileList.append('<li class="icon"><a><i class="fa fa-folder-open"></i><br />' + data[i].name + '</a></li>');
                }

                else 
                {
                  var ext = data[i].name.toLowerCase().match(/\.\w+$/);

                  if(!ext) $fileList.append('<li class="icon"><a><i class="fa fa-question"></i></a></li>');
                  else
                  {
                    ext = ext[0].replace('.', '');

                    if(ext.match(/(png)|(gif)|(jpg)|(jpeg)/))
                      $fileList.append('<li><a><img src="' + path + 'thumbnail/' + data[i].name + '" /><br />' + data[i].name + '</a></li>');  
                    else if(ext.match(/(doc)|(docx)/))
                      $fileList.append('<li class="icon"><a><i class="fa fa-file-word-o"></i></a></li>');
                    else if(ext.match(/(xls)|(xlsx)/))
                      $fileList.append('<li class="icon"><a><i class="fa fa-file-excel-o"></i></a></li>');
                    else if(ext.match(/pdf/))
                      $fileList.append('<li class="icon"><a><i class="fa fa-file-pdf-o"></i></a></li>');
                    else if(ext.match(/zip/))
                      $fileList.append('<li class="icon"><a><i class="fa fa-file-archive-o"></i></a></li>');
                    else if(ext.match(/txt/))
                      $fileList.append('<li class="icon"><a><i class="fa fa-file-text-o"></i></a></li>');
                  }
                }
              }

              sizeFSIcons();

            }
          }
        });
      } 
    });
  };


  $(".filesystem").filebrowser();


  function sizeFSIcons()
  {
    var gridHeight = $(".filesystem .files li").not(".icon").height();
    var fontSize = Math.floor(.7 * gridHeight); 
    $(".filesystem .files li.icon").css({fontSize : gridHeight + 'px'});
  }


  ////////////////////////
  // file upload
  ////////////////////////

  var uploadCount = 0;

  $('.file-field').fileupload({
    dataType: 'json',
    dropZone: $(this).parents(".file-upload").find(".input-wrapper"),
    drop: function (e, data) {
      uploadCount = data.files.length;
    },
    change: function (e, data) {
      uploadCount = data.files.length;
      $(this).siblings('h3').html('<i class="fa fa-circle-o-notch fa-spin"></i>').addClass("loading");
    },
    add: function (e, data) {
      data.context = $('<span class="secondary label">' + data.files[0].name + '</span>').appendTo($(this).parents(".file-upload").find(".results"));
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
        data.context.html(file.name).removeClass('secondary').addClass('success'); 
      });
    },
    fail: function(e, data) {
      $.each(data.result.files, function (index, file) {
        data.context.html(file.name).removeClass('secondary').addClass('alert'); 
      });
    },
    always: function(e, data) {
      $.each(data.result.files, function (index, file) {
        uploadCount--;
        if(uploadCount == 0) 
        {
          var rand = Math.floor(Math.random() * 1000000);
          data.context.parents(".file-browser").children(".filesystem").filebrowser({"refresh" : 1});
          data.context.parents(".results").siblings(".input-wrapper").find("h3").html('Got any more files?').removeClass("loading");
          data.context.parents(".results").append('<p>&nbsp;</p><p><a class="button secondary" id="tmp' + rand + '">Clear Results</a></p>');
          $("#tmp" + rand).click(function(){
            $(this).parents(".results").children().fadeOut(function(){
              $(this).remove();
            });
          });
        }
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