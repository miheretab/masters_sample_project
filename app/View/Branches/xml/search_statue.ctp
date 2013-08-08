<?php 
$xmlObject = Xml::fromArray(array('p' => array('c' => $statue)), array('format' => 'tags')); // You can use Xml::build() too
$xmlString = $xmlObject->asXML(); 
echo $xmlString; ?>



