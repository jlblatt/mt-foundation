$(document).foundation();



$(document).ready(function(){

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