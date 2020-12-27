<?php
class AladdinXMLParser {
	var $inItems = FALSE;
	var $currentElement = '';
	var $itemInfo = array();
	var $itemList = array();

	function startHandler($parser, $element, $attr){
			if($element=="ITEM") { $this->inItems = TRUE; }
			$this->currentElement = $element;
	}

	function endHandler($parser, $element){
			if($element=="ITEM") { 
				$this->itemList[] = $this->itemInfo;
				$this->itemInfo = array();
				$this->inItems = FALSE; 
			}
			$this->currentElement = '';
	}
	function cdataHandler($parser, $cdata){
			if($this->inItems==TRUE){
				if($this->currentElement=="TITLE"){
					$this->itemInfo["TITLE"] = $cdata;
				} else if($this->currentElement=="LINK"){
					$this->itemInfo["LINK"] = $this->itemInfo["LINK"].$cdata;
				}
			}
	}
}
?> 