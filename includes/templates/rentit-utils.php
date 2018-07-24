<?php



function caag_hq_show_rating_stars($rating)
{
    switch ($rating){
        case 'One':
            $j = 1;
            break;
        case 'Two':
            $j = 2;
            break;
        case 'Three':
            $j = 3;
            break;
        case 'Four':
            $j = 4;
            break;

        case 'Five':
            $j = 5;
            break;
        default:
            $j=0;
    }
    $output = '';
    for($i=1; $i <=$j; $i++){
        $output .= '<span class="star active"></span>';
    }
    return $output;
}
