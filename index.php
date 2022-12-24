<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // echo '<pre>';print_r($_REQUEST);die;
  $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qr_image'.DIRECTORY_SEPARATOR;
  $PNG_WEB_DIR = 'qr_image/';
  include "lib/qrlib.php";    
  if (!file_exists($PNG_TEMP_DIR))
  {
    mkdir($PNG_TEMP_DIR);
  }
  $fname = uniqid().'.png';
  $filename = $PNG_TEMP_DIR.$fname;
  
  $errorCorrectionLevel = 'L'; //array('L','M','Q','H')    

  $matrixPointSize = min(max(2, 1), 10); //1-10

  $qrcodedata = '';
  if( $_POST['p_name'] ) { $qrcodedata .= "Product Name: ".$_POST['p_name']."\n"; }
  if( $_POST['p_code'] ) { $qrcodedata .= "Product Code: ".$_POST['p_code']."\n"; }
  if( $_POST['batch_no'] ) { $qrcodedata .= "Batch No: ".$_POST['batch_no']."\n"; }
  if( $_POST['mfg_date'] ) { $qrcodedata .= "Mfg. Date: ".$_POST['mfg_date']."\n"; }
  if( $_POST['retest_date'] ) { $qrcodedata .= "Retest Date: ".$_POST['retest_date']."\n"; }
  if( $_POST['exp_date'] ) { $qrcodedata .= "Exp Date: ".$_POST['exp_date']."\n"; }
  if( $_POST['drum_no'] ) { $qrcodedata .= "Drum No.: ".$_POST['drum_no']."\n"; }
  if( $_POST['tare_weight'] ) { $qrcodedata .= "Tare Weight: ".$_POST['tare_weight']."\n"; }
  if( $_POST['net_weight'] ) { $qrcodedata .= "Net Weight: ".$_POST['net_weight']."\n"; }
  if( $_POST['gross_weight'] ) { $qrcodedata .= "Gross Weight: ".$_POST['gross_weight']."\n"; }
  if( $_POST['container_code'] ) { $qrcodedata .= "Container Code: ".$_POST['container_code']."\n"; }
  if( $_POST['batch_size'] ) { $qrcodedata .= "Batch Size: ".$_POST['batch_size']."\n"; }
  if( $_POST['extra_info'] ) { $qrcodedata .= "Extra Info: ".$_POST['extra_info']."\n"; }
  if( $_POST['storage_condition'] ) { $qrcodedata .= "Storage Condition: ".$_POST['storage_condition']."\n"; }
  if( $_POST['c_name'] ) { $qrcodedata .= "Company Name: ".$_POST['c_name']."\n"; }
  if( $_POST['address'] ) { $qrcodedata .= "Address: ".$_POST['address']."\n"; }
  if( $_POST['mfg_license_no'] ) { $qrcodedata .= "Mfg License No.: ".$_POST['mfg_license_no']."\n"; }
  if( $_POST['import_license_no'] ) { $qrcodedata .= "Import License No.: ".$_POST['import_license_no']."\n"; }

  QRcode::png($qrcodedata, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
  // QRtools::timeBenchmark();

  $name = date('Y_m_d').'_'.uniqid().'.pdf';
  $pdfName = "pdf/$name";
  include 'lib/mpdf/vendor/autoload.php';
  ob_start();  // start output buffering
  include 'label_template.php';
  $htmlTmp = ob_get_clean(); 
  $mpdf = new \Mpdf\Mpdf();
  $mpdf->WriteHTML($htmlTmp);
  $mpdf->Output($pdfName,'F');
  
}
        
    /*//display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  */
    
/*    //config form
    echo '<form action="index.php" method="post">
        Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;
        <input type="submit" value="GENERATE"></form><hr/>';*/
// benchmark
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generate QR</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-info">
<div class="container">
  <h2>Details</h2>
  <div class="row">
    <form class="form-horizontal" action="" method="post">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-sm-3" for="p_name">Product Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="p_name" name="p_name" value="<?php if(!empty($_POST['p_name'])){echo $_POST['p_name'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="p_code">Product Code</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="p_code" name="p_code" value="<?php if(!empty($_POST['p_code'])){echo $_POST['p_code'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="batch_no">Batch Number</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="batch_no" name="batch_no" value="<?php if(!empty($_POST['batch_no'])){echo $_POST['batch_no'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="mfg_date">Mfg. Date</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="mfg_date" name="mfg_date" value="<?php if(!empty($_POST['mfg_date'])){echo $_POST['mfg_date'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="retest_date">Retest Date</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="retest_date" name="retest_date" value="<?php if(!empty($_POST['retest_date'])){echo $_POST['retest_date'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="exp_date">Exp. Date</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="exp_date" name="exp_date" value="<?php if(!empty($_POST['exp_date'])){echo $_POST['exp_date'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="drum_no">Drum No.</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="drum_no" name="drum_no" value="<?php if(!empty($_POST['drum_no'])){echo $_POST['drum_no'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="tare_weight">Tare Weight</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="tare_weight" name="tare_weight" value="<?php if(!empty($_POST['tare_weight'])){echo $_POST['tare_weight'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="net_weight">Net Weight</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="net_weight" name="net_weight" value="<?php if(!empty($_POST['net_weight'])){echo $_POST['net_weight'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="gross_weight">Gross Weight</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="gross_weight" name="gross_weight" value="<?php if(!empty($_POST['gross_weight'])){echo $_POST['gross_weight'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="container_code">Container Code</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="container_code" name="container_code" value="<?php if(!empty($_POST['container_code'])){echo $_POST['container_code'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="batch_size">Batch Size</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="batch_size" name="batch_size" value="<?php if(!empty($_POST['batch_size'])){echo $_POST['batch_size'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="extra_info">Extra Info</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="extra_info" id="extra_info"><?php if(!empty($_POST['extra_info'])){echo $_POST['extra_info'];}?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="storage_condition">Storage Condition</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="storage_condition" name="storage_condition" value="<?php if(!empty($_POST['storage_condition'])){echo $_POST['storage_condition'];}?>">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-sm-3" for="c_name">Company Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="c_name" name="c_name" value="<?php if(!empty($_POST['c_name'])){echo $_POST['c_name'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="address">Address</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="address" id="address"><?php if(!empty($_POST['address'])){echo $_POST['address'];}?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="mfg_license_no">Mfg. License No</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="mfg_license_no" name="mfg_license_no" value="<?php if(!empty($_POST['mfg_license_no'])){echo $_POST['mfg_license_no'];}?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="import_license_no">Import License No</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="import_license_no" name="import_license_no" value="<?php if(!empty($_POST['import_license_no'])){echo $_POST['import_license_no'];}?>">
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-3 col-sm-9 text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Generate QR Code</button>
          </div>
        </div>
        <?php if(!empty($fname)) {?>
          <div class="form-group text-right">
            <img src="qr_image/<?php echo $fname;?>">
          </div>
          <div class="form-group text-right">
            <a href="qr_image/<?php echo $fname;?>" download="qr_code" class="btn btn-primary">Download</a>
          </div>
          <div class="form-group">
            <?php include('label_template.php'); ?>
          </div>
          <div class="form-group text-right">
            <a href="<?php echo $pdfName;?>" download="label_pdf" class="btn btn-primary">Download</a>
          </div>
        <?php }?>
      </div>
    </form>
  </div>
  
</div>
</body>
</html>  