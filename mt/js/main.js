"use strict";

var foo;

////////////////////////
// file browser
////////////////////////

function mtSelectFile(iid)
{
  if(iid) $("#file-browser").data('current-iid', iid);
  iid = $("#file-browser").data('current-iid');

  $("#filesystem .files ul").empty();
  $("#filesystem .files").prepend('<p class="loading"><i class="fa fa-circle-o-notch fa-spin"></i></p>');

  $.ajax({
    dataType: "json",
    url: $("#filesystem").data("url"),
    data: {path : $("#filesystem").data("curr-directory")},
    success: function(data) {

      //create breadcrumb
      var currDir = $("#filesystem").data("curr-directory");
      $("#filesystem .breadcrumbs").html('<li><a data-name="uploads">uploads</a></li>');
      if(currDir != "/")
      {
        var dirs = currDir.split("/");

        for(var i = 0; i < dirs.length; i++)
        {
          if(dirs[i] != "")
          {
            $("#filesystem .breadcrumbs").append('<li><a data-name="' + dirs[i] + '">' + dirs[i] + '</a></li>');
          }
        }
      }

      $("#filesystem .breadcrumbs li:last-child").addClass("current");

      $("#filesystem .breadcrumbs li a").click(function(){
        var newDir = '/';
        $(this).parent().prevAll(":not(:first-child)").each(function(){
          newDir += $(this).find('a').data('name') + '/';
        });
        if($(this).parent().is(":not(:first-child)")) newDir += $(this).data("name") + '/';

        $("#filesystem").data("curr-directory", newDir);

        if(iid) mtSelectFile(iid);
        else mtSelectFile();
      });

      //update url for file uploads
      var currURL = $('#file-upload input[type="file"]').data("url");
      var newURL = currURL.replace(/\?path\=.*/, "") + "?path=" + $("#filesystem").data("curr-directory");
      $('#file-upload input[type="file"]').data("url", newURL);
      $('#file-upload input[type="file"]').fileupload('option', 'url', newURL);

      //build filesystem display

      var spacer = '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />';

      var $fileList = $("#filesystem .files ul");
      $("#filesystem .files p.no-files, #filesystem .files p.loading").remove();

      if(data.length == 0) 
      {
        $("#filesystem .files").prepend('<p class="no-files">No uploads yet!</p>');
        return;
      }

      if(currDir != "/")
      {
        $fileList.append('<li class="icon back"><a>' + spacer + '<i class="fa fa-arrow-circle-left"></i><span class="filename">../ Back<span></a></li>')
      }

      $("#filesystem .files ul li.back a").click(function(){
        $("#filesystem .breadcrumbs li.current").prev().find('a').click();
      });

      data.reverse().sort(function(a,b) {
        return a.isdir ? -1 : 1;
      });

      for(var i = 0; i < data.length; i++)
      {
        if(data[i].isdir)
        {
          $fileList.append('<li class="icon directory"><a data-name="' + data[i].name + '">' + spacer + '<i class="fa fa-folder-open"></i><span class="filename">' + data[i].name + '<span></a></li>');
          continue;
        }

        var path = $("#filesystem").data("file-root");
        var thumbUrl = path + currDir + 'thumbnail/' + data[i].name;
        var url = thumbUrl.replace('thumbnail/', '');

        var ext = data[i].name.toLowerCase().match(/\.\w+$/);

        if(!ext) 
        {
          $fileList.append('<li class="icon"><a data-url="' + url + '">' + spacer + '<i class="fa fa-question"></i><span class="filename">' + data[i].name + '</span></a></li>');
          continue;
        }

        ext = ext[0].replace('.', '');

        if(ext.match(/(png)|(gif)|(jpg)|(jpeg)/))
        {
          $fileList.append('<li><a data-url="' + url + '"><img src="' + thumbUrl + '" title="' + data[i].name + '" /><span class="filename">' + data[i].name + '</span></a></li>');  
          continue;
        }

        var faSlug = "file";
        if(ext.match(/(doc)|(docx)/)) faSlug = "-word";
        else if(ext.match(/(xls)|(xlsx)/)) faSlug = "-excel";
        else if(ext.match(/pdf/)) faSlug = "-pdf";
        else if(ext.match(/zip/)) faSlug = "-zip";
        else if(ext.match(/txt/)) faSlug = "-text";
        $fileList.append('<li class="icon"><a data-url="' + url + '">' + spacer + '<i class="fa fa-file' + faSlug + '-o"></i><span class="filename">' + data[i].name + '</span></a></li>');
      }

      mtSizeFSIcons();

      //directories
      $("#filesystem .files ul li.directory a").click(function(){
        $("#filesystem").data("curr-directory", $("#filesystem").data("curr-directory") + $(this).data("name") + '/');
        if(iid) mtSelectFile(iid);
        else mtSelectFile();
      });

      //callback
      $("#filesystem .files ul li:not(.directory) a").click(function(){
        if(iid && typeof window[iid] === "function") window[iid]($(this).data("url"));
      });
               
    } 
  });
}

function mtSizeFSIcons()
{
  var gridHeight = $("#filesystem .files li").not(".icon").height();
  var fontSize = Math.floor(.5 * gridHeight);
  
  if(gridHeight > 20)
  {
    $("#filesystem .files li.icon i").each(function(){
      $(this).css({fontSize : fontSize + 'px'});
      var marginSize = $(this).width() / 2;
      $(this).css({marginLeft : '-' + marginSize + 'px'});
    });
  }
}

////////////////////////
// wallpaper
////////////////////////

function mtSetWallpaper(url)
{
  if(url) $("#wallpaper-settings").data("url", url).foundation("reveal", "open");
  url = $("#wallpaper-settings").data("url");

  $("#wallpaper-settings .preview").css({
    backgroundImage: "url('" + url + "')",
    backgroundSize: "cover",
    backgroundPosition: "center center",
    backgroundAttachment: "fixed"
  });
}







///////////////////////////
////////////////////////
// DOM ready
////////////////////////
///////////////////////////

$(document).ready(function() {

  $(document).foundation();

  ////////////////////////
  // file browser
  ////////////////////////

  //find file fields on page and associate with respective callbacks
  $('[data-reveal-id="file-browser"]').each(function(){
    var fn = function(){}

    var iid = $(this).data("instance-id");

    $(this).click(function(){
      mtSelectFile(iid);  
    }); 
  });

  //resize filesystem icons on window resize
  $(window).resize(mtSizeFSIcons);

  ////////////////////////
  // file uplaod
  ////////////////////////

  var uploadCount = 0;

  $('#file-upload input[type="file"]').fileupload({
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
          mtSelectFile();
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
  // wallpaper
  ////////////////////////

  $("#wallpaper-settings .range-slider").on('change.fndtn.slider', function(){
    $("#wallpaper-settings .preview .overlay").css({
      opacity: (100 - parseInt($(this).attr('data-slider'))) / 100
    });
  });

  $("#wallpaper-settings a.button.secondary").click(function(){
    $("#wallpaper-settings").foundation("reveal", "close");
  });

  $("#wallpaper-settings a.button.save").click(setWallpaper);

  function setWallpaper(e)
  {
    var url = e ? $("#wallpaper-settings").data('url') : $.cookie("mtWallpaperURL");
    var opacity = e ? (100 - parseInt($("#wallpaper-settings .range-slider").attr('data-slider'))) / 100 : $.cookie("mtWallpaperOpacity");

    $("body").css({
      backgroundImage: "url('" + url + "')",
      backgroundSize: "cover",
      backgroundPosition: "center center",
      backgroundAttachment: "fixed"
    });

    $("#main, footer").css({
      background: "rgba(255, 255, 255, " + opacity + ")",
      opacity: .99
    });

    $("hr").css({
      borderColor: "#666"
    });

    $.cookie("mtWallpaperURL", url, { expires: 3650, path: '/' });
    $.cookie("mtWallpaperOpacity", opacity, { expires: 3650, path: '/' });

    $("#wallpaper-settings").foundation("reveal", "close");
  }

  $(document).on('opened.fndtn.reveal closed.fndtn.reveal', '[data-reveal]', function () {
    $("#wrapper").height($(".reveal-modal.open").height() + 280);
  });

  if($.cookie("mtWallpaperURL") && $.cookie("mtWallpaperOpacity")) setWallpaper();

  ////////////////////////
  // assorted ui
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
    connectWith: '.dashboard .columns:not(".no-drop")',
    placeholder: "panel placeholder",
    start: function(e, ui)
    {
      ui.placeholder.height(ui.item.height());
    },
    stop: function()
    {
      var layout = [];
      $('.dashboard .columns:not(".no-drop")').each(function(){
        layout.push([]);
        $(this).find(".panel").each(function(){
          layout[layout.length - 1].push($(this).data("dash-id"));
        });
      });

      $.cookie("mtDashboardLayout", JSON.stringify(layout), { expires: 3650, path: '/' });
    }
  });

  if($.cookie("mtDashboardLayout"))
  {
    var dashLayout = JSON.parse($.cookie("mtDashboardLayout"));
    var $panels = $('.dashboard .columns:not(".no-drop") .panel').remove();

    for(var i = 0; i < dashLayout.length; i++)
    {
      for(var j = 0; j < dashLayout[i].length; j++)
      {
        var dashid = dashLayout[i][j];
        $('.dashboard .columns:not(".no-drop")').eq(i).append($panels.filter('[data-dash-id="' + dashid + '"]'));
      }
    }
  }

});






///////////////////////////
////////////////////////
// Window loaded
////////////////////////
///////////////////////////

$(window).load(function(){

});
