<?php
Yii::import('ext.PdfGrid.fpdf.fpdf');





class PDF extends fpdf
{
    
	public $title = 'Informe';
	public $subTitle = '';
        public $piePagina = 'Desarrollado por Tramasoft Soluciones TIC - www.tramasoft.com';
        public $nombreEmpresa = '';
        public $nit = '';
	public $widths;
	public $aligns;
	public $rowHeight = 6;
	public $imagePath;
	//longitud total de la tabla
	public $tableWidth = 200;
	public $showLogo = false;
	public $headerDetails = false;
	
	// Cabecera de p�gina
	public function Header()
	{
            $compania = Compania::model()->find(); 

		// Logo
		if($this->showLogo)
			$this->Image($this->imagePath,30,20,0,18);
                
		// Empresa
		$this->SetFont('Arial','',14);
		$this->Cell(0, 5, $compania->NOMBRE_ABREV, 0, 1, 'C');
                $this->SetFont('Arial','',10);
		$this->Cell(0, 6, 'Nit: '. $compania->NIT, 0, 1, 'C');
		
		// Salto de l�nea
		$this->Ln(8);
                // Titulo
		$this->SetFont('Arial','',14);
		
                $this->SetFont('Arial','',16);
		$this->Cell(0, 6, $this->title, 0, 1, 'C');
                $this->Ln(5);
                
		
		if( isset($this->headerDetails) ) {
			//guardar coordenadas
			$x = $this->GetX(); $y = $this->GetY();
			
			$this->SetY(20);
			$this->SetX(-70);
			$this->SetFont('Arial','',10);
			$txt = "Emitido por: ".Yii::app()->user->name."\n";
			$txt .= "Fecha : ".date('d/m/Y')."\n";
			$txt .= "Pagina ".$this->PageNo()."/{nb}";
			$this->MultiCell(60, 5, $txt, 0, 'L');
			
			//restaurar coordenadas
			$this->SetX($x); $this->SetY($y);
		}
	}
	
	public function SetBold()
	{
		$this->setFont('', 'B');
	}
	
	public function SetItalic()
	{
		$this->setFont('', 'I');
	}
	

	public function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	//Set the array of column alignments
	public function SetAligns($a)
	{
		$this->aligns=$a;
	}

	/**
	 * $config puede tener:
	 * 		border=>true/false
	 * 		fill=>true/false
	 */
	public function Row($data, $config)
	{
		$config['border'] = !empty($config['border']);
		$config['fill'] = !empty($config['fill']);
		$config['header'] = !empty($config['header']);
                
                
	
		//Calculate the height of the row
		$nb	= $this->NbLines($data);
                
		$h	= $this->rowHeight*max($nb);
		
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++) {
			$w=$this->widths[$i];
			if($config['header'])
				$a = 'C';
			else
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			
			//Draw the border
			if($config['border'])
				$this->Rect($x, $y, $w, $h);
				
			//Print the text
			$this->MultiCell($w, $h/$nb[$i], $data[$i], 0, $a, $config['fill']);
			
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		
		//Go to the next line
		$this->Ln($h);
	}

	private function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	//Computes the number of lines a MultiCell of width w will take
	private function NbLines($data)
	{
		$resp = array();
		for($n=0;$n<count($data);$n++) {
			$w		= $this->widths[$n];
			$txt	= $data[$n];
			
			$cw=&$this->CurrentFont['cw'];
			
			if($w==0)
				$w=$this->w-$this->rMargin-$this->x;
			
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r", '', $txt);
			$nb=strlen($s);
			
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
			
			$sep=-1;
			$i=0;
			$j=0;
			$l=0;
			$nl=1;
			while($i<$nb) {
				$c=$s[$i];
				
				if($c=="\n") {
					$i++;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
					continue;
				}
				
				if($c==' ')
					$sep=$i;
					
				$l+=$cw[$c];
				if($l>$wmax) {
					if($sep==-1)
					{
						if($i==$j)
							$i++;
					} else
						$i=$sep+1;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
				}
				else
					$i++;
			}
			
			$resp[] = $nl;
		}
		
		return $resp;
	}
        
        	public function Footer()
	{
		//Pie de pagina
                    
                $this->Text(100, 190, $this->piePagina);
		
	}
        
}