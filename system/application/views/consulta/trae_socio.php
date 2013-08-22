<?php
    if($numrows>0){	
?>
<p>
<span id="validando"></span>
<?php
    $tmpl = array (
                    'table_open'          => '<table id="hor-minimalist-b">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th scope="col">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

    $this->table->set_template($tmpl);
    $this->table->set_heading(array('Id. Socio', 'Nombre', 'A. Paterno', 'A. Materno', 'Edad', 'Sexo', 'C. P.', 'Suc. Alta', 'Alta'));
	echo $this->table->generate($query);

	echo $tabla;
	
	?>
</p>

<?php
	}
?>