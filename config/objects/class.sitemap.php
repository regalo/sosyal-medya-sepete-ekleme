<?php
class Sitemap
{
	private static $xmlDoc;
    private static $url_set;
	public function  __construct ()
	{
	self::$xmlDoc = new DOMDocument('1.0',"utf-8");
	self::$url_set = self::$xmlDoc->appendChild( self::$xmlDoc->createElement("urlset"));
	self::$url_set->appendChild( self::$xmlDoc->createAttribute("xmlns"))->appendChild( self::$xmlDoc->createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9"));
	self::$url_set->appendChild( self::$xmlDoc->createAttribute("xmlns:xsi"))->appendChild( self::$xmlDoc->createTextNode("http://www.w3.org/2001/XMLSchema-instance"));
	self::$url_set->appendChild( self::$xmlDoc->createAttribute("xsi:schemaLocation"))->appendChild( self::$xmlDoc->createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"));   
		
	}
	
	public  function  get_sitemap ()

	{
	self::$xmlDoc->formatOutput = true;
	return self::$xmlDoc->saveXML();		
	}
	
	// url'leri bu fonksiyonu kullanarak giriyoruz.
	public function add_url ($loc,$lastmod="",$changefreq="",$priority="")
	
	{
	$url=self::$url_set->appendChild( self::$xmlDoc->createElement("url"));
	if ($loc!="")	
		$url->appendChild( self::$xmlDoc->createElement("loc", $loc));
	if ($lastmod!="")
		$url->appendChild( self::$xmlDoc->createElement("lastmod", $lastmod));
	if ($changefreq!="")
		$url->appendChild( self::$xmlDoc->createElement("changefreq", $changefreq));
	if ($priority!="")
		$url->appendChild( self::$xmlDoc->createElement("priority", $priority));
	
	}

}