<?php
    include ("php/conexion.php");//Se llama archivo donde se ha hecho la conexion

    if(empty($_POST["boleta"])){
        header("Location: lost.html");
    } 
    else{
        require('fpdf/fpdf.php');

        $boleta = $_POST["boleta"];
        $curp = $_POST["curp"];

        $query_buscar = "SELECT * FROM alumnos WHERE curp ='$curp' AND boleta='$boleta'";

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
                    $this->Cell(130,10,utf8_decode('INSTITUTO POLITÉCNICO NACIONAL'),1,0,'C');
                    // Salto de línea
                    $this->Ln(13);
                    // Movernos a la derecha
                    $this->Cell(45);
                    $this->SetFont('Arial','',16);
                    //Subtitulo
                    $this->Cell(100,7,utf8_decode('ESCUELA SUPERIOR DE COMPUTO'),0,0,'C');
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
                    $pdf->cell(100,7,utf8_decode('DATOS GENERALES'),0,0,'C');
                    $pdf->Ln(10);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(68,10,utf8_decode('BOLETA:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['boleta']),1,1,'C',0);
        
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15);    
                    $pdf->Cell(68,10,utf8_decode('NOMBRE:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['nombre']),1,1,'C',0);
        
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('APELLIDO PATERNO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['apellido_paterno']),1,1,'C',0);
        
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('APELLIDO MATERNO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['apellido_materno']),1,1,'C',0);
                    
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('FECHA DE NACIMIENTO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['fecha']),1,1,'C',0);
        
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('GENERO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['genero']),1,1,'C',0);
        
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('CURP:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['curp']),1,1,'C',0);
                    
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('HORARIO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['horario']),1,1,'C',0);
                    
                    $pdf->setX(20);
                    $pdf->SetFont('Arial','B',15); 
                    $pdf->Cell(68,10,utf8_decode('LABORATORIO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['laboratorio']),1,1,'C',0);
        
                    $pdf->Ln(5);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','BU',16);
                    $pdf->cell(100,7,utf8_decode('DATOS DE CONTACTO'),0,0,'C');
                    $pdf->Ln(10);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('CALLE:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['calle']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('NUMERO EXTERIOR:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['exterior']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('NUMERO INTERIOR:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['interior']),1,1,'C',0);
        
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('COLONIA:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['colonia']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('ALCALDIA:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['alcaldia']),1,1,'C',0);
                    
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('ESTADO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['estado']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('C.P.:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['cp']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('TELEFONO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['telefono']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('CORREOS:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['correo']),1,1,'C',0);
                    
                    $pdf->AddPage();
                    $pdf->Ln(5);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','BU',16);
                    $pdf->cell(100,7,utf8_decode('PROCEDENCIA'),0,0,'C');
                    $pdf->Ln(10);
                    
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(80,10,utf8_decode('ESCUELA DE PROCEDENCIA:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(100,10,utf8_decode($row['escuela']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(80,10,utf8_decode('ENTIDAD FEDERATIVA:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(80,10,utf8_decode($row['entidad']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(80,10,utf8_decode('PROMEDIO:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(10,10,utf8_decode($row['promedio']),1,1,'C',0);
        
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(80,10,utf8_decode('ELECCION:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(10,10,utf8_decode($row['opcion']),1,1,'C',0);
                    
                    
                    $pdf->Ln(5);
                    $pdf->setX(50);
                    $pdf->SetFont('Arial','BU',16);
                    $pdf->cell(100,7,utf8_decode('DATOS MEDICOS'),0,0,'C');
                    $pdf->Ln(10);
                    
                    $pdf->setX(20);//se reposiciona en x en 30
                    $pdf->SetFont('Arial','B',15);     
                    $pdf->Cell(60,10,utf8_decode('DISCAPACIDAD:'),1,0,'C',0);
                    $pdf->SetFont('Arial','',15); 
                    $pdf->cell(100,10,utf8_decode($row['discapacidad']),1,0,'C',0);
        
                }
                $pdf->Output();
        }else{
            echo "Error";
            die();
        }
    }
?>