<?php
echo '<script type="text/javascript">
      function cimgdel (file)
      {
        var Check = confirm("Soll das Bild wirklich gel�scht werden?");
        if (Check == true)
          location.href = "?go=cimg_admin&unlink=" + file + "'.$session_url.'";
      }
      </script>';

if (isset($_GET['unlink']) && $_SESSION['cimg_admin'] == 1 )
{
  unlink("../images/content/".$_GET['unlink']);
  systext("Das Bild \"".$_GET['unlink']."\" wurde gel�scht!");
}

$ordner=opendir("../images/content"); // gib hier den gew�nschten pfad an

$ext_arr[] = ".jpg";
$ext_arr[] = ".jpeg";
$ext_arr[] = ".gif";
$ext_arr[] = ".png";
$ext_arr[] = ".JPG";
$ext_arr[] = ".JPEG";
$ext_arr[] = ".GIF";
$ext_arr[] = ".PNG";

while(($datei=readdir($ordner))!== false)
{
  $extension = substr($datei, strrpos($datei, "."));
  if($datei!="." AND $datei!=".." AND in_array($extension,$ext_arr))
  {
    $bildnamen[] = $datei;
  }
}

echo '   <table border="0" cellpadding="4" cellspacing="0" width="600">';

if (count($bildnamen)!=0)
{
  sort($bildnamen);
  foreach ($bildnamen as $datei)
  {
    echo '<tr align="left" valign="top">
             <td class="config" width="75%">
               '.$datei.' <font class="small">(<a href="../images/content/'.$datei.'" target="_blank">ansehen</a>)</font>
             </td>
             <td class="config" width="25%">
             <input onClick="cimgdel(\''.$datei.'\')" class="button" type="button" value="L�schen">
             </td>
           </tr>';
  }
}
else
{
  systext("Es wurden keine weiteren Bilder gefunden!");
}

echo '</table>';

?>