<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDF</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    body{
      font-family: monospace;
    }
    .info,.info tr,.info td {
      border: 1px solid darkblue;
      border-collapse: collapse;
    }
    .info td{
      padding: 5px;
    }
  </style>
</head>
<body>
  <div style="border: 4px solid blue;  border-radius: 30px;padding: 5px;padding-bottom: 10px;">    
    <div style="background: yellow; border-radius: 35px;color: darkblue;font-size: 38px;text-align: center;">
      <b>VIRGIN LINSEED OIL <span style="background: #fff;"><b>BP</b></span></b>
    </div>
    <table style="width:100%;">
      <tr>
        <td style="">
          <table style="width:100%">
            <tr>
              <td width="50%">
                <table style="width:100%;" class="info">
                  <tr>
                    <td> Batch No. </td>
                    <td> <?php if(!empty($_POST['batch_no'])){echo $_POST['batch_no'];}?> </td>
                  </tr>
                  <tr>
                    <td> Mfg. Date. </td>
                    <td> <?php if(!empty($_POST['mfg_date'])){echo $_POST['mfg_date'];}?> </td>
                  </tr>
                  <tr>
                    <td> Exp. Date </td>
                    <td> <?php if(!empty($_POST['exp_date'])){echo $_POST['exp_date'];}?> </td>
                  </tr>
                  <tr>
                    <td> Drum No. </td>
                    <td> <?php if(!empty($_POST['drum_no'])){echo $_POST['drum_no'];}?> </td>
                  </tr>
                </table>
              </td>
              <td width="50%">
                <table style="width:100%;" class="info">
                  <tr>
                    <td> Gross Wt. </td>
                    <td> <?php if(!empty($_POST['gross_weight'])){echo $_POST['gross_weight'];}?> </td>
                  </tr>
                  <tr>
                    <td> Tare Wt. </td>
                    <td> <?php if(!empty($_POST['tare_weight'])){echo $_POST['tare_weight'];}?> </td>
                  </tr>
                  <tr>
                    <td> Net Wt. </td>
                    <td> <?php if(!empty($_POST['net_weight'])){echo $_POST['net_weight'];}?> </td>
                  </tr>
                  <tr>
                    <td> D.M.L No. </td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="50%" style="border:1px solid darkblue;padding: 5px;">
                <p> 
                  <br>
                  <br>
                  <span> Mfg. By. : <b>Zefelabs (I) Pvt. Ltd.</b></span><br>
                  <span><b>Factory :</b> Near Gurukripa Warehouse</span><br>
                  <span>After Railway Crossing,Dakachiya</span><br>
                  <span>Indore(M.P.)</span><br>
                  <span><b>R.Office</b> : 206,Sapphire Heights</span><br>
                  <span>A.B Road, Indore (MP)</span><br>
                </p>
              </td>
              <td width="50%" style="border:1px solid darkblue;padding: 5px;">
                <p >
                  <span>  PROTECT FROM LIGHT</span><br>
                  <span>  KEEP IN COOL PLACE</span><br>
                  <span>  CLOSE CONTAINER TIGHTLY.</span><br>
                  <br>
                  <table style="width:100%;">
                    <tr>
                      <td>
                        <span> <i class="fa fa-phone"></i> : +91 731 2572525 </span><br>
                        <span> <i class="fa fa-mobile"></i> : +91 92291 63608</span><br>
                        <span> <i class="fa fa-envelope"></i> : oil@oilin.in </span><br>
                        <span> <i class="fa fa-star-o"></i> : www.oilin.in </span>      
                      </td>
                      <td>
                        <img src="qr_image/<?php echo $fname;?>">
                      </td>
                    </tr>
                  </table>
                  
                </p>               
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </div>
</body>
</html>