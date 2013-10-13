(function ($) {

  $(document).ready(function(){
//    $("#edit-pais").change(function(event) {
//      $('.form-item-tipo').css('display','block');
//    });

    $("#edit-tipo").change(function(event) {
//      alert($("#edit-tipo").val());
      if ($("#edit-tipo").val() > 0) {
	  $.get(Drupal.t('/cancille/@nid', {'@nid': $("#edit-tipo").val()}),
	  function(data){
		$("#markup-node").html(data);
      });
      }
    });

  });

})(jQuery);