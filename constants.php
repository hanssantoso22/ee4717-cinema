<?php
    $CINEMAS = [
        1=>'Marina',
        2=>'Downtown',
        3=>'Royal',
    ];
    $MOVIES = [
        1=>'Welcome to Sudden Death',
        2=>'Enola Holmes',
        3=>'Mulan',
        4=>'2067',
        5=>'Hard Kill',
        6=>'Money Plane',
        7=>'Happy Halloween Scooby-Doo!',
        8=>'Rogue',
        9=>'My Hero Academia: Heroes Rising',
        10=>'Beckman',
        11=>'American Pie Presents: Girls Rules',
        12=>'Santana',
        13=>'Peninsula',
        14=>'Ava',
        15=>'Unknown Origins',
        16=>'Artemis Fowl',
        17=>'Archive',
        18=>'Project Power',
        19=>'One Night in Bangkok',
        20=>'We Bare Bears: The Movie',
        21=>'Secret Society of Second Born Royals',
        22=>'KonoSuba: God\'s Blessing on this Wonderful World! Legend of Crimson',
        23=>'Cats & Dogs 3: Paws Unite',
        24=>'Joker',
        25=>'Birds of Prey (and the Fantabulous Emancipation of One Harley Quinn)',
    ];
    $GENRE = ['Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 'Drama', 'Family', 'Fantasy', 'Horror', 'Mystery', 'Science Fiction', 'Thriller'];
    $rows = ["A","B","C"];
    $SEATS = array();
    $today = date("Y-m-d");
    $next_week = date('Y-m-d',strtotime("+7 day", strtotime($today)));
    function push_element (&$array, $element) {
        array_push ($array,$element);
    }
    foreach ($rows as $item) {
        for ($i=1;$i<13;$i++) {
            $seat = $item.$i;
            push_element($SEATS,$seat);
        }
    }
    function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
        $dates = array();
        $current = strtotime( $first );
        $last = strtotime( $last );
    
        while( $current <= $last ) {
    
            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }
    
        return $dates;
    }
    $DATE_RANGE = dateRange ($today, $next_week);
?>