<p align="center">
<?php
echo anchor('reporte/rep_excel/'.$anio.'/'.$mes, "Generar Reporte en excel");
echo "<br />";
echo $this->table->generate($query);
echo "<br />";
echo anchor('reporte/rep_excel/'.$anio.'/'.$mes, "Generar Reporte en excel");
?>
</p>