<?php 

    /*Start of Configuration*/

    //disable error
    libxml_use_internal_errors(true);
    //initial dom
    $doc = new DOMDocument;
    //array order: name of fintech, url, class name, substring order
    $fintech = array
          (
          array("Koinworks","https://koinworks.com/?locale=id","npl-statistics__info", 8, -1),
          array("Investree","https://www.investree.id/","tkb90-info-white", 9, 5),
          array("Crowdo","https://crowdo.co.id","nav-link header-text", -7, 5)
          );

    /*End of Configuration*/

//start loop
for ($row = 0; $row < count($fintech); $row++) {
    
    //Get the URL from Array
    $doc->loadHTMLFile($fintech[$row]['1']);

    //Find content from the div
    $xpath = new DOMXPath($doc);
    $query = "//div[@class='".$fintech[$row]['2']."']";
    $response = $xpath->query($query);
    $tkb90 = (substr((trim($response->item(0)->textContent)), $fintech[$row]['3'], $fintech[$row]['4']));


     $array[] = array( 'name'   => $fintech[$row]['0'],
          'tkb90' => $tkb90);   

} //end loop

    //Convert plain array to object array
    $result = array();
    $result["data"] = array();
    $result['data'] = $array; 
 
    //Send to browser
    echo json_encode($result, JSON_PRETTY_PRINT); 
?>