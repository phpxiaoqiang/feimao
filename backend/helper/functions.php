<?php 
function dd($aa) {
	echo "<pre>";
	print_r($aa);
    echo "<pre>";
}
//excel打印函数
function excelData($datas,$titlename,$title,$filename){ 
            $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>"; 
            $str .="<table border=1><head>".$titlename."</head>"; 
            // $str .= $title; 
            foreach ($datas  as $key=> $rt ) 
            { 
                $str .= "<tr>"; 
                foreach ( $rt as $k => $v ) 
                { 
                    $str .= "<td>{$v}</td>"; 
                } 
                $str .= "</tr>\n"; 
            } 
            $str .= "</table></body></html>"; 
            header( "Content-Type: application/vnd.ms-excel; name='excel'" ); 
            header( "Content-type: application/octet-stream" ); 
            header( "Content-Disposition: attachment; filename=".$filename ); 
            header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" ); 
            header( "Pragma: no-cache" ); 
            header( "Expires: 0" ); 
            exit( $str ); 
        } 

 ?>