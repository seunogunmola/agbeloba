<?php

function add_meta_title($string) {
    $CI =&get_instance();
    $CI->data['meta_title'] = e($string). ' - '. $CI->data['meta_title'];

}
function getResource($resourceName){
    return base_url('resources/'.$resourceName);
}

function getAlertMessage($message,$type = 'danger') {
    if ($type != 'danger') {
       return '<div class = "alert alert-'.$type.'" style = "margin-left:10px; margin-right:10px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $message ."</div>";
    }
    else {
        return '<div class = "alert alert-'.$type.'"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '. $message ."</div>";
    }
}

function getBtn($url,$type){
    if ($type == 'edit') {
        return '<a href = "'.$url.'"  title = "Click this Button to Edit" style = "margin:5px;" data-toggle = "tooltip"> <i class = "fa fa-edit"></i></a>';
    }
    elseif ($type == 'delete') {
                return '<a href = "'.$url.'" title = "Click this Button to Delete" data-toggle = "tooltip" onclick = "return confirm(\'Are you sure you want to delete? \n It cannot be undone \')"> <i class = "fa fa-times-circle"></i></a>';
    }
    elseif ($type == 'view') {
                return '<a href = "'.$url.'"  target = "_blank" title = "Click this Button to view more info" data-toggle = "tooltip"> <i class = "fa fa-search"  ></i></a>';
    }

}

function getExcerpt($article,$numwords = 50) {
    $string = '';
    $url = 'articles/'.intval($article->article_id).'/'.$article->slug;
    $string .= '<h2>'.anchor($url,e($article->title)).'</h2>';
    $string .= '<p> <span class = "glyphicon glyphicon-time"></span> Posted on : '.e($article->publication_date).'</p>';
    $string .= '<p>'.e(limit_to_words(strip_tags($article->body),$numwords)).'</p>';
    $string .= anchor($url,'Read More');
    return $string;
}


function limit_to_words($string,$numwords) {
    $excerpt = explode(' ',$string,$numwords);

    if (count($excerpt) >= $numwords) {
        array_pop($excerpt);
    }
    $excerpt = implode(' ', $excerpt);
    return $excerpt;
}

function e($string){
    return htmlentities($string);
}

function article_link($article) {

    $url = 'articles/'.intval($article->article_id).'/'.$article->slug;
    $url = '<h2>'.anchor($url,e($article->title)).'</h2>';
    return $url;
}

function article_links($articles) {
    $string = '<ul>';
    foreach ($articles as $article):
        $url = article_link($article);
        $string .= '<li>'.$url.'</li>';
    endforeach;
    $string .= '</ul>';

    return $string;

}
function hashstring($stringtohash) {
    return hash('sha1',$stringtohash);
}


function getStates()
{
			return array('ABIA',
			'ADAMAWA',
			'AKWA IBOM',
			'ANAMBRA',
			'BAUCHI',
			'BAYELSA',
			'BENUE',
			'BORNO',
			'CROSS RIVER',
			'DELTA',
			'EBONYI',
			'EDO',
			'EKITI',
			'ENUGU',
			'GOMBE',
			'IMO',
			'JIGAWA',
			'KADUNA',
			'KANO',
			'KATSINA',
			'KEBBI',
			'KOGI',
			'KWARA',
			'LAGOS',
			'NASSARAWA',
			'NIGER',
			'OGUN',
			'ONDO',
			'OSUN',
			'OYO',
			'PLATEAU',
			'RIVERS',
			'SOKOTO',
			'TARABA',
			'YOBE',
			'ZAMFARA');

        }
function getCountries()
{
    return array('NIGERIA');

        }

function sendsms($message,$receiver) {
                $http_url = '%s?username=%s&password=%s&message=%s&sender=%s&mobiles=%s';
                $http_url = sprintf($http_url, config_item('sms_host'), config_item('sms_email'), config_item('sms_password'), urlencode($message), config_item('sms_sender'),$receiver);
                $ch = curl_init();
                $options = array(
                                    CURLOPT_URL => $http_url,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_SSL_VERIFYHOST => 0,
                                    CURLOPT_SSL_VERIFYPEER => 0,
                                );
                curl_setopt_array($ch, $options);
                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
}
