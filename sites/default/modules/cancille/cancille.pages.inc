<?php
  function cancille_page($node) {
    print '<h3 class="views-accordion-tramites_servicios-page_128-header">
Requisitos </h3>' . render(field_view_field('node', $node, 'body', array('label' => 'hidden'))) . '
<table class="BotonAzul">
  <tbody>
    <tr>
	  <td>&nbsp;</td>
      <td>
	    <a href="https://tramites.cancilleria.gov.co/Ciudadano/Apostilla/solicitudTramite/inicio.aspx">Haga aquí su solicitud de apostilla o legalización en línea</a>
      </td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>';
  }
?>