<p align="center">
<?php
echo anchor('consulta_astra/rep_excel/'.$anio.'/'.$mes, "Generar Reporte en excel");
echo "<br />";
echo $this->table->generate($query);
echo "<br />";
echo anchor('consulta_astra/rep_excel/'.$anio.'/'.$mes, "Generar Reporte en excel");
?>
</p>