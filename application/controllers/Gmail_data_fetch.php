<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmail_data_fetch extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('user');
    }

  	public function get_inbox_message()
  	{
	    if (! function_exists('imap_open')) 
	    {
	        echo "IMAP is not configured.";
	        exit();
	    } 
	    else 
	    {
	        /* Connecting Gmail server with IMAP */
	        $connection = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}INBOX', 'bilalaseer@gmail.com', '') or die('Cannot connect to Gmail: ' . imap_last_error());

	        /* Search Emails having the specified keyword in the email subject */
	        $emailData = imap_search($connection, 'UNSEEN');
	        $startDelimiter='<a href="';
	        $endDelimiter='"';
	        
	        if (! empty($emailData)) 
	        {
	            $a=array();
	            foreach ($emailData as $emailIdent) 
	            {
	                $overview = imap_fetch_overview($connection, $emailIdent, 0);
	                $message = imap_fetchbody($connection, $emailIdent, '2');
	                // $messageExcerpt = substr($message, 0, 150);
	                $partialMessage = trim(quoted_printable_decode($message)); 
	                $date = date("d F, Y", strtotime($overview[0]->date));
	                $output=$this->all_strings_between($partialMessage, $startDelimiter, $endDelimiter);
	                foreach ($output as $o) 
	                {
	                	$this->get_data($o);
	                }
	            }
	        }
	        imap_close($connection);
	    }
	    redirect(base_url().'home/index/');
    }
	public function get_string_between($content,$str1,$str2)
	{
	    $pos1 = strpos($content,$str1);
	    $strlen = strlen($str1);
	    $con1 = substr($content,$pos1);
	    $con2 = explode($str2, $con1);
	    $rest = substr($con2[0], $strlen);
	    return $rest;
	}
	public function all_strings_between($str, $startDelimiter, $endDelimiter) 
	{
		$contents = array();
		$startDelimiterLength = strlen($startDelimiter);
		$endDelimiterLength = strlen($endDelimiter);
		$startFrom = $contentStart = $contentEnd = 0;
		while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) 
		{
		    $contentStart += $startDelimiterLength;
		    $contentEnd = strpos($str, $endDelimiter, $contentStart);
		    if (false === $contentEnd) 
		    {
		      break;
		    }
		    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
		    $startFrom = $contentEnd + $endDelimiterLength;
	  	}
  		return $contents;
	}
	public function get_data($url)
	{
		libxml_use_internal_errors(true);
		$c = file_get_contents($url);
		$d = new DomDocument();
		$d->loadHTML($c);
		$xp = new domxpath($d);
		foreach ($xp->query("//meta[@property='og:title']") as $el) 
		{
			$title=$el->getAttribute("content");
		    // echo $title;
		}
		foreach ($xp->query("//meta[@property='og:description']") as $el) 
		{
			$description= $el->getAttribute("content");
		    // echo $description;
		}
		foreach ($xp->query("//meta[@property='og:image']") as $el) 
		{
			$image_url=$el->getAttribute("content");
		    // echo $image_url;
		}
		$data['title']=$title;
		$data['description']=$description;
		$data['image_url']=$image_url;
		$data['url']=$url;
		$data['created_at']=date("Y-m-d h:i:sa");
		$result=$this->user->add_news_to_db($data);
		if($result)
		{
			return;
		}
	}
	// public function curl_data($url)
	// {
	// 	$curl = curl_init($url);
	// 	curl_setopt($curl, CURLOPT_FAILONERROR, true);
	// 	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
	// 	$result = curl_exec($curl);

	// 	$test_url=$url;
	// 	$substring = substr($test_url, 0, strpos($test_url, 'com'));
	// 	$substring=$substring."com";
	// 	if($substring=="https://news.yahoo.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));

			
	// 		$image_url_start='<link rel="preload" href="';
	// 		$image_url_end='" as="image"';
	// 		$image_url=$this->get_string_between($result,$image_url_start,$image_url_end);


	// 		$desc_start='<div class="caas-body">';
	// 		$desc_end='</article>';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);

	// 	}
	// 	else if($substring=="https://www.bbc.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));


	// 		$desc_start='<article';
	// 		$desc_end='</article>';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);
	// 		$desc1 = substr($desc1, 0, 700);


	// 		$image_url_start='<img alt="';
	// 		$image_url_end='jpg';
	// 		$image_url=$this->get_string_between($result,$image_url_start,$image_url_end);
	// 		$image_url = trim(substr($image_url, strpos($image_url, '="') + 2));
	// 		$image_url=$image_url."jpg";

	// 	}
	// 	else if($substring=="https://www.nytimes.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));

			
	// 		$image_url_start='class="css-11cwn6f" src="';
	// 		$image_url_end='jpg';
	// 		$image_url=$this->get_string_between($result,$image_url_start,$image_url_end);
	// 		$image_url=$image_url."jpg";


	// 		$desc_start='<article';
	// 		$desc_end='</article>';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);
	// 		$desc1 = substr($desc1, 0, 700);

	// 	}
	// 	else if($substring=="https://www.fox32chicago.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));


	// 		$image_url="";

	// 		$desc_start='<div class="article-body';
	// 		$desc_end='<div data-uid="fts-ar-17"';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);

	// 	}
	// 	else if($substring=="https://www.foxnews.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));

			
	// 		$image_url="";


	// 		$desc_start='<div class="article-body';
	// 		$desc_end='<div class="article-meta">';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);

	// 	}
	// 	else if($substring=="https://www.washingtontimes.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));

			
	// 		$image_url_start='<div class="photo"><a';
	// 		$image_url_end='" width';
	// 		$image_url=$this->get_string_between($result,$image_url_start,$image_url_end);
	// 		$image_url = trim(substr($image_url, strpos($image_url, 'src="') + 5));


	// 		$desc_start='<div class="article-text';
	// 		$desc_end='<div id="newsletter-form-story">';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);

	// 	}
	// 	else if($substring=="https://news.sky.com")
	// 	{
	// 		$start='<h1 class="sdc-site-component-header--h1';
	// 		$end='</span>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, 'title">') + 7));

			
	// 		$image_url_start='<div class="sdc-article-image__wrapper"';
	// 		$image_url_end='jpg';
	// 		$image_url=$this->get_string_between($result,$image_url_start,$image_url_end);
	// 		$image_url = trim(substr($image_url, strpos($image_url, 'src="') + 5));
	// 		$image_url=$image_url."jpg";


	// 		$desc_start='<div class="sdc-article-body';
	// 		$desc_end='<div class="sdc-site-layout__col sdc-site-layout__col2">';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);
	// 		$desc1 = substr($desc1, 0, 1000);

	// 	}
	// 	else if($substring=="https://www.fox13now.com")
	// 	{
	// 		$start='<h1';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));

	// 		$image_url="";

	// 		$desc_start='<article';
	// 		$desc_end='</article>';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);

	// 	}
	// 	else if($substring=="https://www.king5.com")
	// 	{
	// 		$start='<h1 class="article__headline';
	// 		$end='</h1>';
	// 		$title=$this->get_string_between($result,$start,$end);
	// 		$title = trim(substr($title, strpos($title, '>') + 1));

	// 		$image_url="";

	// 		$desc_start='<div class="article__body';
	// 		$desc_end='</article>';
	// 		$desc1=$this->get_string_between($result,$desc_start,$desc_end);
	// 		$desc1 = trim(substr($desc1, strpos($desc1, '>') + 1));
	// 		$desc1=strip_tags($desc1);
	// 		$desc1 = substr($desc1, 0, 200);
	// 	}
	// 	else
	// 	{
	// 		$title="";
	// 		$desc1="";
	// 		$image_url="";
	// 	}

	// 	$data['title']=$title;
	// 	$data['description']=$desc1;
	// 	$data['image_url']=$image_url;
	// 	$data['url']=$url;
	// 	$data['created_at']=date("Y-m-d h:i:sa");
	// 	$result=$this->user->add_news_to_db($data);
	// 	if($result)
	// 	{
	// 		return;
	// 	}
	// }
}


