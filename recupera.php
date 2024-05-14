<?php
    include ("PHP/conexion.php");//Se llama archivo donde se ha hecho la conexion
    session_start();
    if(!isset($_SESSION["ID_TT"])){
        header("Location: lost.html");
    } 
    else{
        require('fpdf/fpdf.php');



        $ID_TT = $_SESSION["ID_TT"];

        $query_buscar = "SELECT 
        mt.ID_TT AS 'ID_Trabajo_Terminal',
        mt.Nombre_TT AS 'Trabajo_Terminal',
        mt.Descripción AS 'Descripcion',
        GROUP_CONCAT(DISTINCT CONCAT(a.Nombres, ' ', a.Apellido_Paterno, ' ', a.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Alumnos',
        GROUP_CONCAT(DISTINCT CONCAT(a.Correo) SEPARATOR ', ') AS 'Correos_Alumnos',
        GROUP_CONCAT(DISTINCT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Directores',
        tt.Nombre_Tipo_Titulacion AS 'Tipo_Titulacion',
        ar.Nombre_Area AS 'Area',
        et.Nombre_Estado AS 'Estado'
        FROM metodo_titulacion mt
        LEFT JOIN metodo_director md ON mt.ID_TT = md.ID_TT
        LEFT JOIN director d ON md.ID_Director = d.ID_Director
        LEFT JOIN alumno a ON mt.ID_TT = a.ID_TT
        LEFT JOIN area ar ON mt.ID_Area = ar.ID_Area
        LEFT JOIN tipo_titulacion tt ON mt.ID_Tipo_Titulacion = tt.ID_Tipo_Titulacion
        LEFT JOIN estado_titulacion et ON mt.ID_Estado = et.ID_Estado
        WHERE mt.ID_TT = $ID_TT
        GROUP BY mt.ID_TT";

        $result = mysqli_query($conexion, $query_buscar);

        if(mysqli_num_rows($result) > 0){
            class PDF extends FPDF{
                // Cabecera de página
                function Header(){
                    // Logo izquierda horizontal/ vertical/altura o tamano
                    $this->Image('img/Encabezado.png',15,8,180);
                    // Logo derecha horizontal/ vertical/altura o tamano
                                            // Salto de línea
                    $this->Ln(34);
                    // Arial bold 15
                    $this->SetFont('Arial','B',20);
                    // Movernos a la derecha
                    $this->Cell(30);
                    // Título
                    $this->Cell(130,10,utf8_decode('SISTEMA DE REGISTRO DE TRABAJOS DE TITULACION'),0,0,'C');
                    // Salto de línea
                    $this->Ln(13);
                    // Movernos a la derecha
                    $this->Cell(45);
                    $this->SetFont('Arial','',16);
                    //Subtitulo
                    $this->Cell(100,7,utf8_decode('AENETA'),0,0,'C');
                    // Salto de línea
                    $this->Ln(10);
                }
        
                    // Pie de página
                    function Footer(){
                        // Posición: a 1,5 cm del final
                        $this->SetY(-15);
                        // Arial italic 8
                        $this->SetFont('Arial','I',8);
                        // Número de página
                        $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
                    }
                }
                
                require 'php/conexion.php';//Se llamada la consulta de la base de datos 
        
                $pdf = new PDF();//se crea la variable ya predeterminada por la libreria 
                $pdf->aliasnbpages(); //Se crea automaticamente el numerado de cada pagina
                $pdf->AddPage();//Se agrega una nueva hoja
                $pdf->SetMargins(10,10,10);//se crea un margen en el documento
                $pdf->SetAutoPageBreak(true,10);//Da un salto de hoja justo en esa distancia del pie de pagina
                $pdf->SetFont('Arial','B',8);//Tipo de letra  //$pdf->Cell(40,10,'¡Hola, Mundo!');//Se genera una linea donde se pondra el mensaje 
        
                while($row = $result->fetch_assoc()){
                    //RELLENO DE TABLA CONTACTO
                    $pdf->Ln(5);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','BU',16);
                    $pdf->cell(100,7,utf8_decode('DATOS TRABAJO DE TITULACION'),0,0,'C');
                    $pdf->Ln(10);
        
                    $pdf->setX(50);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(120,10,utf8_decode('ID DE TRABAJO DE TITULACION:'),1,1,'C',0);
                    $pdf->setX(50);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['ID_Trabajo_Terminal']),1,1,'C',0);
                    

                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15);    
                    $pdf->Cell(120,10,utf8_decode('NOMBRE DE TRABAJO DE TITULACION:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->MultiCell(120, 10, utf8_decode($row['Trabajo_Terminal']), 1, 'C');
                    

                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15);    
                    $pdf->Cell(120,10,utf8_decode('RESUMEN DE TRABAJO DE TITULACION:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 

                    // MultiCell con altura calculada
                    $pdf->MultiCell(120, 10, utf8_decode($row['Descripcion']), 1, 'C');

                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(120,10,utf8_decode('ALUMNOS:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['Nombres_Alumnos']),1,1,'C',0);
        
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(120,10,utf8_decode('CORREOS ALUMNOS:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['Correos_Alumnos']),1,1,'C',0);

                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(120,10,utf8_decode('DIRECTORES:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['Nombres_Directores']),1,1,'C',0);
                    
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(120,10,utf8_decode('TIPO DE TITULACION:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['Tipo_Titulacion']),1,1,'C',0);
        
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(120,10,utf8_decode('AREA DE ESPECIALIZACION:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['Area']),1,1,'C',0);
        
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(120,10,utf8_decode('ESTADO DE TRABAJO DE TITULACION:'),1,1,'C',0);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(120,10,utf8_decode($row['Estado']),1,1,'C',0);
                    
                }
                $pdf->Output();
        }else{
            echo "Error";
            die();
        }
    }

?>