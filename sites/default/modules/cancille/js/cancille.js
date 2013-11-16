(function ($) {

  $(document).ready(function(){

    $("#edit-tipo").change(function(event) {
      if ($("#edit-tipo").val() > 0) {
	  $.get(Drupal.t('/cancille/@nid', {'@nid': $("#edit-tipo").val()}),
	  function(data){
		$("#markup-node").html(data);
      });
      }
    });
    
    $("#edit-finder-datepicker-popup-0-wrapper").change(function(event) {
      $('#cancille-newsroom-calendar-form').submit();
    });
  });

})(jQuery);