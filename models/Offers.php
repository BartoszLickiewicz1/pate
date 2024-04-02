<?php

namespace app\models;

use Yii;
use app\componentsu\X;
use app\fpdf\tfpdf;

use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "offers".
 *
 * @property int $number
 * @property string $data
 * @property string $invoice
 * @property string $about
 * @property string $file_path
 * @property string $montage_text
 * @property float $montage_price
 * @property string $additional_price_text
 * @property float $additional_price
 * @property string $disposal_text
 * @property float $disposal_price
 * @property float $vat
 * @property float $discount
 * @property string $text_top
 * @property string $text_bottom_1
 * @property string $text_bottom_2
 * @property string $text_bottom_3
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'invoice', 'about', 'montage_text', 'montage_price', 'additional_price_text', 'additional_price', 'disposal_text', 'disposal_price', 'vat', 'discount', 'text_top', 'text_bottom_1', 'text_bottom_2', 'text_bottom_3'], 'required'],
            [['date'], 'safe'],
            [['montage_price', 'additional_price', 'disposal_price', 'vat', 'discount','travel_time_price'], 'number'],
            [['invoice', 'about', 'montage_text', 'additional_price_text', 'disposal_text'], 'string', 'max' => 500],
            [['text_top', 'text_bottom_1', 'text_bottom_2', 'text_bottom_3'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => 'Number',
            'date' => 'Data',
            'invoice' => 'Invoice',
            'about' => 'About',
            'montage_text' => 'Montage Text',
            'montage_price' => 'Montage Price',
            'additional_price_text' => 'Additional Price Text',
            'additional_price' => 'Additional Price',
            'disposal_text' => 'Disposal Text',
            'disposal_price' => 'Disposal Price',
            'vat' => 'Vat',
            'travel_time_price' => 'Travel Time Price',
            'discount' => 'Discount',
            'text_top' => 'Text Top',
            'text_bottom_1' => 'Text Bottom 1',
            'text_bottom_2' => 'Text Bottom 2',
            'text_bottom_3' => 'Text Bottom 3',
            'is_template' => 'Is Template'
        ];

    }

    public function isTemplate(){
        return $this->is_template == 1;
    }
   static public function getProductsTemplates(){
        $query = Offers::find()->where(['is_template' => 1]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['offer_number' => 'number']);
    }

    public function getOfferElements()
    {
        $query = Products::find()->where(['offer_number' => $this->number]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    public function generatePdf(){
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddFont('DejaVu','', 'DejaVuSans.ttf',true);
        $pdf->AddFont('DejaVu','B', 'DejaVuSansCondensed-Bold.ttf',true);
        $pdf->AddFont('DejaVu','I', 'DejaVuSerifCondensed-Italic.ttf',true);
        $pdf->AddFont('Helvetica','','HelveticaNeueMedium.ttf',true);
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(0,7,$this->invoice .' Österreich',0,1);

        $products = $this->products;
        $productLabels = (new Products())->attributeLabels();
        $offerLabels = $this->attributeLabels();
// Column headings
$header = array('Pos.', $productLabels['name'], $productLabels['photo'], $productLabels['price_netto'],$productLabels['quantity'],'Betrag');
$data = $this->products;


$pdf->SetFont('DejaVu','',14);

$pdf->SetLeftMargin(5);

$pdf->AddPage();

    $pdf->SetTextColor(128,0,0);
    $pdf->SetFont('DejaVu', 'B', 12);
    $pdf->Cell(0,7,$offerLabels['invoice'].':',0,1,);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('DejaVu', '', 10);
    $pdf->Cell(0,7,$this->invoice.':',0,1);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0,7,mb_convert_encoding($this->invoice, 'ISO-8859-1', 'UTF-8').':',0,1);

    $pdf->SetTextColor(128,0,0);
    $pdf->SetFont('DejaVu', 'B', 12);
    $pdf->Cell(0,7,$offerLabels['about'].':',0,1);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('DejaVu', '', 10);
    $pdf->Cell(0,7,$this->about.':',0,1);

    $pdf->SetTextColor(128,0,0);
    $pdf->SetFont('DejaVu', 'B', 16);
    $pdf->Cell(0,7,'Kostenvoranschlag Nr.: '.$this->number.' / '. $this->date,0,1);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('DejaVu', '', 10);

    $pdf->BasicTable($header,$data);

    $pdf->AddPage();
    $pdf->Output();
        // $pdf = new PDF();
        // $pdf->AliasNbPages();
        // $pdf->AddPage();
        // $pdf->SetFont('Times','',12);
        // for($i=1;$i<=40;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        // $pdf->Output();
    }

}
class PDF extends tfpdf
{
    // Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(30,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(30,6,$col,1);
        $this->Ln();
    }
}

// Page header
function Header()
{
    $this->SetY(5);
    $this->Image( Yii::getAlias('@app/fpdf/logo.jpg'),5,5,25);
    $this->SetFont('DejaVu','',11);
    $this->SetTextColor(128,128,128);
    $text =
    'FERENC STUDIO
    Innenarchitektur & Fenster Design e.U.
    Gogolgasse 47/4, A-1130 Wien
    Tel.: +43 (0) 660 960 9358
    E-mail: ferencfenster@gmail.com';
    $lines = preg_split('/\r\n|\r|\n/', $text);
    foreach($lines as $line){
        $this->Cell(165);
        $this->Cell(30,6,$line,0,0,'R');
        $this->Ln(5);
    }
    $this->Ln(5);
    $this->SetLineWidth(1.5); // Ustaw grubość linii na 1.5 punktu
    $this->SetDrawColor(169,169,169); // Ustaw kolor linii na czerwony (RGB: 255, 0, 0)
    $this->Line(5, $this->GetY(), 205, $this->GetY()); 
    $this->Ln(10);
    $this->Cell(0,10,mb_convert_encoding('Österreich', 'ISO-8859-1',"UTF-8" ),0,1);
    $this->Cell(0,10,'Österreich',0,1);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // DejaVu italic 8
    $this->SetFont('DejaVu','I',8);
    // Page number
    $this->Cell(0,10,'Seite '.$this->PageNo().' von {nb}',0,0,'L');
}
}