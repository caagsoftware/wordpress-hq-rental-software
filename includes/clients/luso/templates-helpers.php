<?php

function caag_hq_get_reservation_page_from_brand_page($brand_id, $vehicle_id)
{
    switch($brand_id){
        case '1':
            return home_url() . '/reservations-honolulu/?vehicle_class_id=' . $vehicle_id;
        case '2':
            return home_url() . '/reservations-san-diego/?vehicle_class_id=' . $vehicle_id;
        case '3':
            return home_url() . '/reservations-las-vegas/?vehicle_class_id=' . $vehicle_id;
        case '4':
            return home_url() . '/reservations-reno-tahoe/?vehicle_class_id=' . $vehicle_id;
        case '5':
            return home_url() . '/reservations-phoenix/?vehicle_class_id=' . $vehicle_id;
        default:
        return home_url() . '/reservations-san-diego/?vehicle_class_id=' . $vehicle_id;
    }
}
function caag_hq_get_reservation_page_from_brand_page_only($brand_id)
{
    switch($brand_id){
        case '1':
            return home_url() . '/reservations-honolulu/';
        case '2':
            return home_url() . '/reservations-san-diego/';
        case '3':
            return home_url() . '/reservations-las-vegas/';
        case '4':
            return home_url() . '/reservations-reno-tahoe/';
        case '5':
            return home_url() . '/reservations-phoenix/';
        default:
            return home_url() . '/reservations-san-diego/';
    }
}

function caag_hq_get_brands_page_banner_image($brand_id, $make)
{
    switch($brand_id){
        case '1':
            //Honolulu
            switch($make){
                case 'Alfa Romeo':
                    return get_field('honolulu_banner_alfa_romero',4969);
                case 'Bmw':
                    return get_field('honolulu_banner_bmw',4969);
                case 'Fiat':
                    return get_field('honolulu_banner_fiat',4969);
                case 'Ford':
                    return get_field('honolulu_banner_ford',4969);
                case 'Honda':
                    return get_field('honolulu_banner_honda',4969);
                case 'Infiniti':
                    return get_field('honolulu_banner_infiniti',4969);
                case 'Jeep':
                    return get_field('honolulu_banner_jeep',4969);
                case 'Land Rover Range Rover':
                    return get_field('honolulu_banner_land_rover_range_rover',4969);
                case 'Toyota':
                    return get_field('honolulu_banner_toyota',4969);
                case 'Volkswagen':
                    return get_field('honolulu_banner_volkswagen',4969);
                default:
                    return get_field('honolulu_banner_image',4969);
            }
        case '2':
            //San Diego
            switch($make){
                case 'Acura':
                    return get_field('san_diego_banner_acura',4963);
                case 'Alfa Romeo':
                    return get_field('san_diego_banner_alfa_romeo',4963);
                case 'Audi':
                    return get_field('san_diego_banner_audi',4963);
                case 'Bmw':
                    return get_field('san_diego_banner_bmw',4963);
                case 'Cadillac':
                    return get_field('san_diego_banner_cadillac',4963);
                case 'Chevrolet':
                    return get_field('san_diego_banner_chevrolet',4963);
                case 'Dodge':
                    return get_field('san_diego_banner_dodge',4963);
                case 'Fiat':
                    return get_field('san_diego_banner_fiat',4963);
                case 'Ford':
                    return get_field('san_diego_banner_ford',4963);
                case 'Gmc':
                    return get_field('san_diego_banner_gmc',4963);
                case 'Honda':
                    return get_field('san_diego_banner_honda',4963);
                case 'Hyundai':
                    return get_field('san_diego_banner_hyundai',4963);
                case 'Infiniti':
                    return get_field('san_diego_banner_infinity',4963);
                case 'Jaguar':
                    return get_field('san_diego_banner_jaguar',4963);
                case 'Jeep':
                    return get_field('san_diego_banner_jeep',4963);
                case 'Kia':
                    return get_field('san_diego_banner_kia',4963);
                case 'Land Rover':
                    return get_field('san_diego_banner_land_rover',4963);
                case 'Land Rover Range Rover':
                    return get_field('san_diego_banner_land_rover_range_rover',4963);
                case 'Lexus':
                    return get_field('san_diego_banner_lexus',4963);
                case 'Maserati':
                    return get_field('san_diego_banner_maserati',4963);
                case 'Mercedes-benz':
                    return get_field('san_diego_banner_mercedez_benz',4963);
                case 'Mini':
                    return get_field('san_diego_banner_mini',4963);
                case 'Porsche':
                    return get_field('san_diego_banner_porsche',4963);
                case 'Toyota':
                    return get_field('san_diego_banner_toyota',4963);
                case 'Volkswagen':
                    return get_field('san_diego_banner_wolkswagen',4963);
                case 'Volvo':
                    return get_field('san_diego_banner_volvo',4963);
                default:
                    return get_field('san_diego_banner_image',4963);
            }
        case '3':
            //Las Vegas
            switch($make){
                case 'Audi':
                    return get_field('las_vegas_banner_image',4966);
                case 'Bmw':
                    return get_field('las_vegas_banner_bmw',4966);
                case 'Dodge':
                    return get_field('las_vegas_banner_dodge',4966);
                case 'Gmc':
                    return get_field('las_vegas_banner_gmc',4966);
                case 'Infiniti':
                    return get_field('las_vegas_banner_infiniti',4966);
                case 'Jeep':
                    return get_field('las_vegas_banner_jeep',4966);
                case 'Lexus':
                    return get_field('las_vegas_banner_lexus',4966);
                case 'Porsche':
                    return get_field('las_vegas_banner_porsche',4966);
                default:
                    return get_field('las_vegas_banner_image',4966);
            }

        case '4':
            //Reno
            switch($make){
                case 'Audi':
                    return get_field('reno_tahoe_banner_audi',4972);
                case 'Bmw':
                    return get_field('reno_tahoe_banner_bmw',4972);
                case 'Gmc':
                    return get_field('reno_tahoe_banner_gmc',4972);
                case 'Land Rover Range Rover':
                    return get_field('reno_tahoe_banner_Land_rover_range_rover',4972);
                case 'Mercedes-benz':
                    return get_field('reno_tahoe_banner_mercedez_benz',4972);
                case 'Porsche':
                    return get_field('reno_tahoe_banner_porsche',4972);
                case 'Toyota':
                    return get_field('reno_tahoe_banner_toyota',4972);
                default:
                    return get_field('reno_tahoe_banner_image',4972);

            }
        case '5':
            //Phoenix
            switch($make){
                case 'Infiniti':
                    return get_field('phoenix_banner_infiniti',9342);
                case 'Kia':
                    return get_field('phoenix_banner_kia',9342);
                case 'Lexus':
                    return get_field('phoenix_banner_lexus',9342);
                case 'Mini':
                    return get_field('phoenix_banner_mini',9342);
                case 'Nissan':
                    return get_field('phoenix_banner_nissan',9342);
                case 'Volkswagen':
                    return get_field('phoenix_banner_volkswagen',9342);
                default:
                    return get_field('phoenix_banner_image',9342);
            }

        default:
            return get_field('san_diego_banner_image',4963);
    }
}