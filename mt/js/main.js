"use strict";

$(document).foundation();





///////////////////////////
////////////////////////
// DOM ready
////////////////////////
///////////////////////////

$(document).ready(function() {

  ////////////////////////
  // file browser & upload init
  ////////////////////////

  $("#filesystem").filebrowser();

  var uploadCount = 0;

  $('.file-field').fileupload({
    dataType: 'json',
    dropZone: $("#file-upload .input-wrapper"),
    drop: function (e, data) {
      uploadCount = data.files.length;
    },
    change: function (e, data) {
      uploadCount = data.files.length;
      $(this).siblings('h3').html('<i class="fa fa-circle-o-notch fa-spin"></i>').addClass("loading");
    },
    add: function (e, data) {
      data.context = $('<span class="secondary label">' + data.files[0].name + '</span>').appendTo($("#file-upload .results"));
      data.submit();
    },
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $("#file-upload .progress .meter").css(
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
          $("#filesystem").filebrowser({"refresh" : 1});
          $("#file-upload .input-wrapper h3").html('Got any more files?').removeClass("loading");
          $("#file-upload .results").append('<p>&nbsp;</p><p><a class="button secondary" id="tmp' + rand + '">Clear Results</a></p>');
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
  // ui
  ////////////////////////

  $("#settings-menu").hover(function(){
    $(this).find('.fa').addClass('fa-spin');
  }, function() {
    $(this).find('.fa').removeClass('fa-spin');
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






///////////////////////////
////////////////////////
// Window loaded
////////////////////////
///////////////////////////

$(window).load(function(){

});





///////////////////////////
////////////////////////
// file browser plugin
////////////////////////
///////////////////////////

$.fn.filebrowser = function(args) {

  console.log('implement callback and make into more proper plugin');

  $(window).resize(sizeFSIcons);

  args = typeof args !== 'undefined' ? args : {"init" : true};

  return this.each(function() {

    if(("init" in args && args.init) || ("refresh" in args && args.refresh))
    {
      var url = $(this).data("url");

      $.ajax({
        dataType: "json",
        url: url,
        context: $(this).children(".files"),
        success: displayFilesystem 
      });
    } 
  });

  //class functions

  function displayFilesystem(data)
  {
    if(data.length == 0) $(this).html('<p>No uploads yet!</p>');
    else
    {
      $(this).html('<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5"></ul>');
      var $fileList = $(this).children('ul');
      var path = $("#filesystem").data("file-root");

      data.sort(function(a,b) {
        return a.isdir ? -1 : 1;
      });

      var spacer = '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />';

      for(var i = 0; i < data.length; i++)
      {
        if(data[i].isdir)
        {
          $fileList.append('<li class="icon"><a>' + spacer + '<i class="fa fa-folder-open"></i><span class="filename">' + data[i].name + '<span></a></li>');
        }

        else 
        {
          var ext = data[i].name.toLowerCase().match(/\.\w+$/);

          if(!ext) $fileList.append('<li class="icon"><a><i class="fa fa-question"></i></a></li>');
          else
          {
            ext = ext[0].replace('.', '');

            if(ext.match(/(png)|(gif)|(jpg)|(jpeg)/))
              $fileList.append('<li><a><img src="' + path + 'thumbnail/' + data[i].name + '" title="' + data[i].name + '" /><span class="filename">' + data[i].name + '</span></a></li>');  
            else if(ext.match(/(doc)|(docx)/))
              $fileList.append('<li class="icon"><a>' + spacer + '<i class="fa fa-file-word-o"></i></a></li>');
            else if(ext.match(/(xls)|(xlsx)/))
              $fileList.append('<li class="icon"><a>' + spacer + '<i class="fa fa-file-excel-o"></i></a></li>');
            else if(ext.match(/pdf/))
              $fileList.append('<li class="icon"><a>' + spacer + '<i class="fa fa-file-pdf-o"></i></a></li>');
            else if(ext.match(/zip/))
              $fileList.append('<li class="icon"><a>' + spacer + '<i class="fa fa-file-archive-o"></i></a></li>');
            else if(ext.match(/txt/))
              $fileList.append('<li class="icon"><a>' + spacer + '<i class="fa fa-file-text-o"></i></a></li>');
          }
        }
      }

      sizeFSIcons();

    } 
  }


  function sizeFSIcons()
  {
    var gridHeight = $("#filesystem .files li").not(".icon").height();
    var fontSize = Math.floor(.5 * gridHeight);
    var marginSize = fontSize / 2;
    
    if(gridHeight > 20)
      $("#filesystem .files li.icon i").css({fontSize : fontSize + 'px' , marginLeft : '-' + marginSize + 'px'});
  }

};