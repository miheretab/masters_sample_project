<?php 
$xmlObject = Xml::fromArray(array('p' => array('c' => $branches)), array('format' => 'tags')); // You can use Xml::build() too
$xmlString = $xmlObject->asXML(); 
echo $xmlString; ?>



