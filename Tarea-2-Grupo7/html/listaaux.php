<?php include '../include/navbar.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/db_config.php'; ?>
<?php
        $canciones_statement = "    
        select count(artistas.nombre), tabla.nombre, tabla.id
        from (
        select * from canciones join artista_tiene_cancion
        on canciones.id = artista_tiene_cancion.id_cancion) as tabla
        join artistas on artistas.id = tabla.id_artista
        group by tabla.nombre, tabla.id";
        $canciones = pg_query_params($dbconn, $canciones_statement, array()); #result       
        $artistas_statement = 'select nombre_artistico from artistas join artista_tiene_cancion
        on artista_tiene_cancion.id_artista = artistas.id
        where artista_tiene_cancion.id_cancion = $1;';
        $album_statement = 'select nombre from album join album_tiene_cancion
        on album_tiene_cancion.id_album = album.id
        where album_tiene_cancion.id_cancion = $1;';
        

?> 

<table border='3'>
        <thead>
                <tr>
                        <th>Songs's name</th>
                        <th>Artist's name</th>
                        <th>Album's name</th>
                        
                </tr>
        </thead>
        <tbody>
                <?php
                while($obj=pg_fetch_object($canciones)){ ?>
                <tr>
                        <?php
                        
                        $num = $obj->count;
                        if ($num > 1){
                                $result_artistas = pg_query_params($dbconn, $artistas_statement, array($obj->id));
                                $artistas = pg_fetch_all_columns($result_artistas,0);
                                $result_album = pg_query_params($dbconn, $album_statement, array($obj->id));
                                $album = pg_fetch_all_columns($result_album,0);
                                $artista_name = '';
                                foreach($artistas as $artista_value){
                                        $artista_name = $artista_name.$artista_value.' ';
                                        
                                } ?>
                            
                            <td><?php echo $obj->nombre;?></td>
                            <td><?php echo $artista_name?></td>
                            <td><?php echo $album[0]?></td>
                            <td> <form action="https://google.com"> <input type="submit" value="Go to Google" /> </form> </td>
                            

                        <?php } else {
                            $result_artistas = pg_query_params($dbconn, $artistas_statement, array($obj->id));
                            $artistas = pg_fetch_all_columns($result_artistas,0);
                            $result_album = pg_query_params($dbconn, $album_statement, array($obj->id));
                            $album = pg_fetch_all_columns($result_album,0); ?>  
                            
                               
                            
                            <td><?php echo $obj->nombre;?></td>
                            <td><?php echo $artistas[0];?></td>
                            <td><?php echo $album[0]?></td>
                            <td> <form action="https://google.com"> <input type="submit" value="Go to Google" /> </form> </td>

                            <?php } ?>
                        
                                         
                        
                        
                        
                </tr>

                <?php  } ?>
        </tbody>
</table>
    
</body>
</html>
