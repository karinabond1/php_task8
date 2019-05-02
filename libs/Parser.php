<?php

class Parser 
{
    private $url;
    private $start;
    private $end;

    public function __construct($url,$start,$end)
    {
        $this->url = $url;
        $this->start = $start;
        $this->end = $end;
    }

    private function getContent()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function parser()
    {
        $arrResult = array();

        if ($this->start < $this->end) {
            $file = $this->getContent();
            $doc = phpQuery::newDocument($file);
            foreach ($doc->find('.g') as $item) {
                $item = pq($item);
                $g = $doc->find('.g')->html();
                $h3 = $item->find('.r')->html();
                $cite = $item->find('.s')->html();
                if($doc->find('.g .s')>0 && $item->find('.s')->html()){
                    $h31 = str_replace("/url?q=","", $h3);
                    $strPos1 = (strpos($h31,'sa'))-5;
                    $strPos2 = strpos($h31,'">');
                    $h32 = substr($h31 , $strPos1, $strPos2 - $strPos1);

                    $h3Res = str_replace($h32,"", $h31);
                    $arr = array($h3Res,$cite);
                    array_push($arrResult,$arr);
                }
            }
        }
        return $arrResult;
    }

    

}