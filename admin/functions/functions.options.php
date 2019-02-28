<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Register sidebar options for blog/portfolio/woocommerce category/archive pages
        global $wp_registered_sidebars;
        $sidebar_options[] = 'None';
        for($i=0;$i<1;$i++){
            $sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
            //var_dump($sidebars);
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $sidebar){
                    $sidebar_options[] = $sidebar['name'];
                }
            }
            $sidebars = sidebar_generator::get_sidebars();
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $key => $value){
                    $sidebar_options[] = $value;
                }
            }
        }
        // End
		
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Logo",
				"block_two"		=> "Menu",
				"block_three"	=> "Social Links",
				"block_four"	=> "Contact Info",
			), 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!				
				"block_five"	=> "Search Box",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/pattern/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/pattern/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}

		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
		
		$google_fonts = array(
						'Select Font' => 'Select Font',
						'ABeeZee' => 'ABeeZee',
						'Abel' => 'Abel',
						'Abhaya Libre' => 'Abhaya Libre',
						'Abril Fatface' => 'Abril Fatface',
						'Aclonica' => 'Aclonica',
						'Acme' => 'Acme',
						'Actor' => 'Actor',
						'Adamina' => 'Adamina',
						'Advent Pro' => 'Advent Pro',
						'Aguafina Script' => 'Aguafina Script',
						'Akronim' => 'Akronim',
						'Aladin' => 'Aladin',
						'Aldrich' => 'Aldrich',
						'Alef' => 'Alef',
						'Alegreya' => 'Alegreya',
						'Alegreya Sans' => 'Alegreya Sans',
						'Alegreya Sans SC' => 'Alegreya Sans SC',
						'Alegreya SC' => 'Alegreya SC',
						'Alex Brush' => 'Alex Brush',
						'Alfa Slab One' => 'Alfa Slab One',
						'Alice' => 'Alice',
						'Alike' => 'Alike',
						'Alike Angular' => 'Alike Angular',
						'Allan' => 'Allan',
						'Allerta' => 'Allerta',
						'Allerta Stencil' => 'Allerta Stencil',
						'Allura' => 'Allura',
						'Almendra' => 'Almendra',
						'Almendra Display' => 'Almendra Display',
						'Almendra SC' => 'Almendra SC',
						'Amarante' => 'Amarante',
						'Amaranth' => 'Amaranth',
						'Amatic SC' => 'Amatic SC',
						'Amatica SC' => 'Amatica SC',
						'Amethysta' => 'Amethysta',
						'Amiko' => 'Amiko',
						'Amiri' => 'Amiri',
						'Amita' => 'Amita',
						'Anaheim' => 'Anaheim',
						'Andada' => 'Andada',
						'Andika' => 'Andika',
						'Angkor' => 'Angkor',
						'Annie Use Your Telescope' => 'Annie Use Your Telescope',
						'Anonymous Pro' => 'Anonymous Pro',
						'Antic' => 'Antic',
						'Antic Didone' => 'Antic Didone',
						'Antic Slab' => 'Antic Slab',
						'Anton' => 'Anton',
						'Arapey' => 'Arapey',
						'Arbutus' => 'Arbutus',
						'Arbutus Slab' => 'Arbutus Slab',
						'Architects Daughter' => 'Architects Daughter',
						'Archivo Black' => 'Archivo Black',
						'Archivo Narrow' => 'Archivo Narrow',
						'Aref Ruqaa' => 'Aref Ruqaa',
						'Arima Madurai' => 'Arima Madurai',
						'Arimo' => 'Arimo',
						'Arizonia' => 'Arizonia',
						'Armata' => 'Armata',
						'Arsenal' => 'Arsenal',
						'Artifika' => 'Artifika',
						'Arvo' => 'Arvo',
						'Arya' => 'Arya',
						'Asap' => 'Asap',
						'Asar' => 'Asar',
						'Asset' => 'Asset',
						'Assistant' => 'Assistant',
						'Astloch' => 'Astloch',
						'Asul' => 'Asul',
						'Athiti' => 'Athiti',
						'Atma' => 'Atma',
						'Atomic Age' => 'Atomic Age',
						'Aubrey' => 'Aubrey',
						'Audiowide' => 'Audiowide',
						'Autour One' => 'Autour One',
						'Average' => 'Average',
						'Average Sans' => 'Average Sans',
						'Averia Gruesa Libre' => 'Averia Gruesa Libre',
						'Averia Libre' => 'Averia Libre',
						'Averia Sans Libre' => 'Averia Sans Libre',
						'Averia Serif Libre' => 'Averia Serif Libre',
						'Bad Script' => 'Bad Script',
						'Bahiana' => 'Bahiana',
						'Baloo' => 'Baloo',
						'Baloo Bhai' => 'Baloo Bhai',
						'Baloo Bhaina' => 'Baloo Bhaina',
						'Baloo Chettan' => 'Baloo Chettan',
						'Baloo Da' => 'Baloo Da',
						'Baloo Paaji' => 'Baloo Paaji',
						'Baloo Tamma' => 'Baloo Tamma',
						'Baloo Thambi' => 'Baloo Thambi',
						'Balthazar' => 'Balthazar',
						'Bangers' => 'Bangers',
						'Barrio' => 'Barrio',
						'Basic' => 'Basic',
						'Battambang' => 'Battambang',
						'Baumans' => 'Baumans',
						'Bayon' => 'Bayon',
						'Belgrano' => 'Belgrano',
						'Bellefair' => 'Bellefair',
						'Belleza' => 'Belleza',
						'BenchNine' => 'BenchNine',
						'Bentham' => 'Bentham',
						'Berkshire Swash' => 'Berkshire Swash',
						'Bevan' => 'Bevan',
						'Bigelow Rules' => 'Bigelow Rules',
						'Bigshot One' => 'Bigshot One',
						'Bilbo' => 'Bilbo',
						'Bilbo Swash Caps' => 'Bilbo Swash Caps',
						'BioRhyme' => 'BioRhyme',
						'BioRhyme Expanded' => 'BioRhyme Expanded',
						'Biryani' => 'Biryani',
						'Bitter' => 'Bitter',
						'Black Ops One' => 'Black Ops One',
						'Bokor' => 'Bokor',
						'Bonbon' => 'Bonbon',
						'Boogaloo' => 'Boogaloo',
						'Bowlby One' => 'Bowlby One',
						'Bowlby One SC' => 'Bowlby One SC',
						'Brawler' => 'Brawler',
						'Bree Serif' => 'Bree Serif',
						'Bubblegum Sans' => 'Bubblegum Sans',
						'Bubbler One' => 'Bubbler One',
						'Buda' => 'Buda',
						'Buenard' => 'Buenard',
						'Bungee' => 'Bungee',
						'Bungee Hairline' => 'Bungee Hairline',
						'Bungee Inline' => 'Bungee Inline',
						'Bungee Outline' => 'Bungee Outline',
						'Bungee Shade' => 'Bungee Shade',
						'Butcherman' => 'Butcherman',
						'Butterfly Kids' => 'Butterfly Kids',
						'Cabin' => 'Cabin',
						'Cabin Condensed' => 'Cabin Condensed',
						'Cabin Sketch' => 'Cabin Sketch',
						'Caesar Dressing' => 'Caesar Dressing',
						'Cagliostro' => 'Cagliostro',
						'Cairo' => 'Cairo',
						'Calligraffitti' => 'Calligraffitti',
						'Cambay' => 'Cambay',
						'Cambo' => 'Cambo',
						'Candal' => 'Candal',
						'Cantarell' => 'Cantarell',
						'Cantata One' => 'Cantata One',
						'Cantora One' => 'Cantora One',
						'Capriola' => 'Capriola',
						'Cardo' => 'Cardo',
						'Carme' => 'Carme',
						'Carrois Gothic' => 'Carrois Gothic',
						'Carrois Gothic SC' => 'Carrois Gothic SC',
						'Carter One' => 'Carter One',
						'Catamaran' => 'Catamaran',
						'Caudex' => 'Caudex',
						'Caveat' => 'Caveat',
						'Caveat Brush' => 'Caveat Brush',
						'Cedarville Cursive' => 'Cedarville Cursive',
						'Ceviche One' => 'Ceviche One',
						'Changa' => 'Changa',
						'Changa One' => 'Changa One',
						'Chango' => 'Chango',
						'Chathura' => 'Chathura',
						'Chau Philomene One' => 'Chau Philomene One',
						'Chela One' => 'Chela One',
						'Chelsea Market' => 'Chelsea Market',
						'Chenla' => 'Chenla',
						'Cherry Cream Soda' => 'Cherry Cream Soda',
						'Cherry Swash' => 'Cherry Swash',
						'Chewy' => 'Chewy',
						'Chicle' => 'Chicle',
						'Chivo' => 'Chivo',
						'Chonburi' => 'Chonburi',
						'Cinzel' => 'Cinzel',
						'Cinzel Decorative' => 'Cinzel Decorative',
						'Clicker Script' => 'Clicker Script',
						'Coda' => 'Coda',
						'Coda Caption' => 'Coda Caption',
						'Codystar' => 'Codystar',
						'Coiny' => 'Coiny',
						'Combo' => 'Combo',
						'Comfortaa' => 'Comfortaa',
						'Coming Soon' => 'Coming Soon',
						'Concert One' => 'Concert One',
						'Condiment' => 'Condiment',
						'Content' => 'Content',
						'Contrail One' => 'Contrail One',
						'Convergence' => 'Convergence',
						'Cookie' => 'Cookie',
						'Copse' => 'Copse',
						'Corben' => 'Corben',
						'Cormorant' => 'Cormorant',
						'Cormorant Garamond' => 'Cormorant Garamond',
						'Cormorant Infant' => 'Cormorant Infant',
						'Cormorant SC' => 'Cormorant SC',
						'Cormorant Unicase' => 'Cormorant Unicase',
						'Cormorant Upright' => 'Cormorant Upright',
						'Courgette' => 'Courgette',
						'Cousine' => 'Cousine',
						'Coustard' => 'Coustard',
						'Covered By Your Grace' => 'Covered By Your Grace',
						'Crafty Girls' => 'Crafty Girls',
						'Creepster' => 'Creepster',
						'Crete Round' => 'Crete Round',
						'Crimson Text' => 'Crimson Text',
						'Croissant One' => 'Croissant One',
						'Crushed' => 'Crushed',
						'Cuprum' => 'Cuprum',
						'Cutive' => 'Cutive',
						'Cutive Mono' => 'Cutive Mono',
						'Damion' => 'Damion',
						'Dancing Script' => 'Dancing Script',
						'Dangrek' => 'Dangrek',
						'David Libre' => 'David Libre',
						'Dawning of a New Day' => 'Dawning of a New Day',
						'Days One' => 'Days One',
						'Dekko' => 'Dekko',
						'Delius' => 'Delius',
						'Delius Swash Caps' => 'Delius Swash Caps',
						'Delius Unicase' => 'Delius Unicase',
						'Della Respira' => 'Della Respira',
						'Denk One' => 'Denk One',
						'Devonshire' => 'Devonshire',
						'Dhurjati' => 'Dhurjati',
						'Didact Gothic' => 'Didact Gothic',
						'Diplomata' => 'Diplomata',
						'Diplomata SC' => 'Diplomata SC',
						'Domine' => 'Domine',
						'Donegal One' => 'Donegal One',
						'Doppio One' => 'Doppio One',
						'Dorsa' => 'Dorsa',
						'Dosis' => 'Dosis',
						'Dr Sugiyama' => 'Dr Sugiyama',
						'Droid Sans' => 'Droid Sans',
						'Droid Sans Mono' => 'Droid Sans Mono',
						'Droid Serif' => 'Droid Serif',
						'Duru Sans' => 'Duru Sans',
						'Dynalight' => 'Dynalight',
						'Eagle Lake' => 'Eagle Lake',
						'Eater' => 'Eater',
						'EB Garamond' => 'EB Garamond',
						'Economica' => 'Economica',
						'Eczar' => 'Eczar',
						'Ek Mukta' => 'Ek Mukta',
						'El Messiri' => 'El Messiri',
						'Electrolize' => 'Electrolize',
						'Elsie' => 'Elsie',
						'Elsie Swash Caps' => 'Elsie Swash Caps',
						'Emblema One' => 'Emblema One',
						'Emilys Candy' => 'Emilys Candy',
						'Engagement' => 'Engagement',
						'Englebert' => 'Englebert',
						'Enriqueta' => 'Enriqueta',
						'Erica One' => 'Erica One',
						'Esteban' => 'Esteban',
						'Euphoria Script' => 'Euphoria Script',
						'Ewert' => 'Ewert',
						'Exo' => 'Exo',
						'Exo 2' => 'Exo 2',
						'Expletus Sans' => 'Expletus Sans',
						'Fanwood Text' => 'Fanwood Text',
						'Farsan' => 'Farsan',
						'Fascinate' => 'Fascinate',
						'Fascinate Inline' => 'Fascinate Inline',
						'Faster One' => 'Faster One',
						'Fasthand' => 'Fasthand',
						'Fauna One' => 'Fauna One',
						'Federant' => 'Federant',
						'Federo' => 'Federo',
						'Felipa' => 'Felipa',
						'Fenix' => 'Fenix',
						'Finger Paint' => 'Finger Paint',
						'Fira Mono' => 'Fira Mono',
						'Fira Sans' => 'Fira Sans',
						'Fira Sans Condensed' => 'Fira Sans Condensed',
						'Fira Sans Extra Condensed' => 'Fira Sans Extra Condensed',
						'Fjalla One' => 'Fjalla One',
						'Fjord One' => 'Fjord One',
						'Flamenco' => 'Flamenco',
						'Flavors' => 'Flavors',
						'Fondamento' => 'Fondamento',
						'Fontdiner Swanky' => 'Fontdiner Swanky',
						'Forum' => 'Forum',
						'Francois One' => 'Francois One',
						'Frank Ruhl Libre' => 'Frank Ruhl Libre',
						'Freckle Face' => 'Freckle Face',
						'Fredericka the Great' => 'Fredericka the Great',
						'Fredoka One' => 'Fredoka One',
						'Freehand' => 'Freehand',
						'Fresca' => 'Fresca',
						'Frijole' => 'Frijole',
						'Fruktur' => 'Fruktur',
						'Fugaz One' => 'Fugaz One',
						'Gabriela' => 'Gabriela',
						'Gafata' => 'Gafata',
						'Galada' => 'Galada',
						'Galdeano' => 'Galdeano',
						'Galindo' => 'Galindo',
						'Gentium Basic' => 'Gentium Basic',
						'Gentium Book Basic' => 'Gentium Book Basic',
						'Geo' => 'Geo',
						'Geostar' => 'Geostar',
						'Geostar Fill' => 'Geostar Fill',
						'Germania One' => 'Germania One',
						'GFS Didot' => 'GFS Didot',
						'GFS Neohellenic' => 'GFS Neohellenic',
						'Gidugu' => 'Gidugu',
						'Gilda Display' => 'Gilda Display',
						'Give You Glory' => 'Give You Glory',
						'Glass Antiqua' => 'Glass Antiqua',
						'Glegoo' => 'Glegoo',
						'Gloria Hallelujah' => 'Gloria Hallelujah',
						'Goblin One' => 'Goblin One',
						'Gochi Hand' => 'Gochi Hand',
						'Gorditas' => 'Gorditas',
						'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
						'Graduate' => 'Graduate',
						'Grand Hotel' => 'Grand Hotel',
						'Gravitas One' => 'Gravitas One',
						'Great Vibes' => 'Great Vibes',
						'Griffy' => 'Griffy',
						'Gruppo' => 'Gruppo',
						'Gudea' => 'Gudea',
						'Gurajada' => 'Gurajada',
						'Habibi' => 'Habibi',
						'Halant' => 'Halant',
						'Hammersmith One' => 'Hammersmith One',
						'Hanalei' => 'Hanalei',
						'Hanalei Fill' => 'Hanalei Fill',
						'Handlee' => 'Handlee',
						'Hanuman' => 'Hanuman',
						'Happy Monkey' => 'Happy Monkey',
						'Harmattan' => 'Harmattan',
						'Headland One' => 'Headland One',
						'Heebo' => 'Heebo',
						'Henny Penny' => 'Henny Penny',
						'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
						'Hind' => 'Hind',
						'Hind Guntur' => 'Hind Guntur',
						'Hind Madurai' => 'Hind Madurai',
						'Hind Siliguri' => 'Hind Siliguri',
						'Hind Vadodara' => 'Hind Vadodara',
						'Holtwood One SC' => 'Holtwood One SC',
						'Homemade Apple' => 'Homemade Apple',
						'Homenaje' => 'Homenaje',
						'Iceberg' => 'Iceberg',
						'Iceland' => 'Iceland',
						'IM Fell Double Pica' => 'IM Fell Double Pica',
						'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
						'IM Fell DW Pica' => 'IM Fell DW Pica',
						'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
						'IM Fell English' => 'IM Fell English',
						'IM Fell English SC' => 'IM Fell English SC',
						'IM Fell French Canon' => 'IM Fell French Canon',
						'IM Fell French Canon SC' => 'IM Fell French Canon SC',
						'IM Fell Great Primer' => 'IM Fell Great Primer',
						'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
						'Imprima' => 'Imprima',
						'Inconsolata' => 'Inconsolata',
						'Inder' => 'Inder',
						'Indie Flower' => 'Indie Flower',
						'Inika' => 'Inika',
						'Inknut Antiqua' => 'Inknut Antiqua',
						'Irish Grover' => 'Irish Grover',
						'Istok Web' => 'Istok Web',
						'Italiana' => 'Italiana',
						'Italianno' => 'Italianno',
						'Itim' => 'Itim',
						'Jacques Francois' => 'Jacques Francois',
						'Jacques Francois Shadow' => 'Jacques Francois Shadow',
						'Jaldi' => 'Jaldi',
						'Jim Nightshade' => 'Jim Nightshade',
						'Jockey One' => 'Jockey One',
						'Jolly Lodger' => 'Jolly Lodger',
						'Jomhuria' => 'Jomhuria',
						'Josefin Sans' => 'Josefin Sans',
						'Josefin Slab' => 'Josefin Slab',
						'Joti One' => 'Joti One',
						'Judson' => 'Judson',
						'Julee' => 'Julee',
						'Julius Sans One' => 'Julius Sans One',
						'Junge' => 'Junge',
						'Jura' => 'Jura',
						'Just Another Hand' => 'Just Another Hand',
						'Just Me Again Down Here' => 'Just Me Again Down Here',
						'Kadwa' => 'Kadwa',
						'Kalam' => 'Kalam',
						'Kameron' => 'Kameron',
						'Kanit' => 'Kanit',
						'Kantumruy' => 'Kantumruy',
						'Karla' => 'Karla',
						'Karma' => 'Karma',
						'Katibeh' => 'Katibeh',
						'Kaushan Script' => 'Kaushan Script',
						'Kavivanar' => 'Kavivanar',
						'Kavoon' => 'Kavoon',
						'Kdam Thmor' => 'Kdam Thmor',
						'Keania One' => 'Keania One',
						'Kelly Slab' => 'Kelly Slab',
						'Kenia' => 'Kenia',
						'Khand' => 'Khand',
						'Khmer' => 'Khmer',
						'Khula' => 'Khula',
						'Kite One' => 'Kite One',
						'Knewave' => 'Knewave',
						'Kotta One' => 'Kotta One',
						'Koulen' => 'Koulen',
						'Kranky' => 'Kranky',
						'Kreon' => 'Kreon',
						'Kristi' => 'Kristi',
						'Krona One' => 'Krona One',
						'Kumar One' => 'Kumar One',
						'Kumar One Outline' => 'Kumar One Outline',
						'Kurale' => 'Kurale',
						'La Belle Aurore' => 'La Belle Aurore',
						'Laila' => 'Laila',
						'Lakki Reddy' => 'Lakki Reddy',
						'Lalezar' => 'Lalezar',
						'Lancelot' => 'Lancelot',
						'Lateef' => 'Lateef',
						'Lato' => 'Lato',
						'League Script' => 'League Script',
						'Leckerli One' => 'Leckerli One',
						'Ledger' => 'Ledger',
						'Lekton' => 'Lekton',
						'Lemon' => 'Lemon',
						'Lemonada' => 'Lemonada',
						'Libre Baskerville' => 'Libre Baskerville',
						'Libre Franklin' => 'Libre Franklin',
						'Life Savers' => 'Life Savers',
						'Lilita One' => 'Lilita One',
						'Lily Script One' => 'Lily Script One',
						'Limelight' => 'Limelight',
						'Linden Hill' => 'Linden Hill',
						'Lobster' => 'Lobster',
						'Lobster Two' => 'Lobster Two',
						'Londrina Outline' => 'Londrina Outline',
						'Londrina Shadow' => 'Londrina Shadow',
						'Londrina Sketch' => 'Londrina Sketch',
						'Londrina Solid' => 'Londrina Solid',
						'Lora' => 'Lora',
						'Love Ya Like A Sister' => 'Love Ya Like A Sister',
						'Loved by the King' => 'Loved by the King',
						'Lovers Quarrel' => 'Lovers Quarrel',
						'Luckiest Guy' => 'Luckiest Guy',
						'Lusitana' => 'Lusitana',
						'Lustria' => 'Lustria',
						'Macondo' => 'Macondo',
						'Macondo Swash Caps' => 'Macondo Swash Caps',
						'Mada' => 'Mada',
						'Magra' => 'Magra',
						'Maiden Orange' => 'Maiden Orange',
						'Maitree' => 'Maitree',
						'Mako' => 'Mako',
						'Mallanna' => 'Mallanna',
						'Mandali' => 'Mandali',
						'Marcellus' => 'Marcellus',
						'Marcellus SC' => 'Marcellus SC',
						'Marck Script' => 'Marck Script',
						'Margarine' => 'Margarine',
						'Marko One' => 'Marko One',
						'Marmelad' => 'Marmelad',
						'Martel' => 'Martel',
						'Martel Sans' => 'Martel Sans',
						'Marvel' => 'Marvel',
						'Mate' => 'Mate',
						'Mate SC' => 'Mate SC',
						'Maven Pro' => 'Maven Pro',
						'McLaren' => 'McLaren',
						'Meddon' => 'Meddon',
						'MedievalSharp' => 'MedievalSharp',
						'Medula One' => 'Medula One',
						'Meera Inimai' => 'Meera Inimai',
						'Megrim' => 'Megrim',
						'Meie Script' => 'Meie Script',
						'Merienda' => 'Merienda',
						'Merienda One' => 'Merienda One',
						'Merriweather' => 'Merriweather',
						'Merriweather Sans' => 'Merriweather Sans',
						'Metal' => 'Metal',
						'Metal Mania' => 'Metal Mania',
						'Metamorphous' => 'Metamorphous',
						'Metrophobic' => 'Metrophobic',
						'Michroma' => 'Michroma',
						'Milonga' => 'Milonga',
						'Miltonian' => 'Miltonian',
						'Miltonian Tattoo' => 'Miltonian Tattoo',
						'Miniver' => 'Miniver',
						'Miriam Libre' => 'Miriam Libre',
						'Mirza' => 'Mirza',
						'Miss Fajardose' => 'Miss Fajardose',
						'Mitr' => 'Mitr',
						'Modak' => 'Modak',
						'Modern Antiqua' => 'Modern Antiqua',
						'Mogra' => 'Mogra',
						'Molengo' => 'Molengo',
						'Molle' => 'Molle',
						'Monda' => 'Monda',
						'Monofett' => 'Monofett',
						'Monoton' => 'Monoton',
						'Monsieur La Doulaise' => 'Monsieur La Doulaise',
						'Montaga' => 'Montaga',
						'Montez' => 'Montez',
						'Montserrat' => 'Montserrat',
						'Montserrat Alternates' => 'Montserrat Alternates',
						'Montserrat Subrayada' => 'Montserrat Subrayada',
						'Moul' => 'Moul',
						'Moulpali' => 'Moulpali',
						'Mountains of Christmas' => 'Mountains of Christmas',
						'Mouse Memoirs' => 'Mouse Memoirs',
						'Mr Bedfort' => 'Mr Bedfort',
						'Mr Dafoe' => 'Mr Dafoe',
						'Mr De Haviland' => 'Mr De Haviland',
						'Mrs Saint Delafield' => 'Mrs Saint Delafield',
						'Mrs Sheppards' => 'Mrs Sheppards',
						'Mukta Vaani' => 'Mukta Vaani',
						'Muli' => 'Muli',
						'Mystery Quest' => 'Mystery Quest',
						'Neucha' => 'Neucha',
						'Neuton' => 'Neuton',
						'New Rocker' => 'New Rocker',
						'News Cycle' => 'News Cycle',
						'Niconne' => 'Niconne',
						'Nixie One' => 'Nixie One',
						'Nobile' => 'Nobile',
						'Nokora' => 'Nokora',
						'Norican' => 'Norican',
						'Nosifer' => 'Nosifer',
						'Nothing You Could Do' => 'Nothing You Could Do',
						'Noticia Text' => 'Noticia Text',
						'Noto Sans' => 'Noto Sans',
						'Noto Serif' => 'Noto Serif',
						'Nova Cut' => 'Nova Cut',
						'Nova Flat' => 'Nova Flat',
						'Nova Mono' => 'Nova Mono',
						'Nova Oval' => 'Nova Oval',
						'Nova Round' => 'Nova Round',
						'Nova Script' => 'Nova Script',
						'Nova Slim' => 'Nova Slim',
						'Nova Square' => 'Nova Square',
						'NTR' => 'NTR',
						'Numans' => 'Numans',
						'Nunito' => 'Nunito',
						'Nunito Sans' => 'Nunito Sans',
						'Odor Mean Chey' => 'Odor Mean Chey',
						'Offside' => 'Offside',
						'Old Standard TT' => 'Old Standard TT',
						'Oldenburg' => 'Oldenburg',
						'Oleo Script' => 'Oleo Script',
						'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
						'Open Sans' => 'Open Sans',
						'Open Sans Condensed' => 'Open Sans Condensed',
						'Oranienbaum' => 'Oranienbaum',
						'Orbitron' => 'Orbitron',
						'Oregano' => 'Oregano',
						'Orienta' => 'Orienta',
						'Original Surfer' => 'Original Surfer',
						'Oswald' => 'Oswald',
						'Over the Rainbow' => 'Over the Rainbow',
						'Overlock' => 'Overlock',
						'Overlock SC' => 'Overlock SC',
						'Overpass' => 'Overpass',
						'Overpass Mono' => 'Overpass Mono',
						'Ovo' => 'Ovo',
						'Oxygen' => 'Oxygen',
						'Oxygen Mono' => 'Oxygen Mono',
						'Pacifico' => 'Pacifico',
						'Padauk' => 'Padauk',
						'Palanquin' => 'Palanquin',
						'Palanquin Dark' => 'Palanquin Dark',
						'Pangolin' => 'Pangolin',
						'Paprika' => 'Paprika',
						'Parisienne' => 'Parisienne',
						'Passero One' => 'Passero One',
						'Passion One' => 'Passion One',
						'Pathway Gothic One' => 'Pathway Gothic One',
						'Patrick Hand' => 'Patrick Hand',
						'Patrick Hand SC' => 'Patrick Hand SC',
						'Pattaya' => 'Pattaya',
						'Patua One' => 'Patua One',
						'Pavanam' => 'Pavanam',
						'Paytone One' => 'Paytone One',
						'Peddana' => 'Peddana',
						'Peralta' => 'Peralta',
						'Permanent Marker' => 'Permanent Marker',
						'Petit Formal Script' => 'Petit Formal Script',
						'Petrona' => 'Petrona',
						'Philosopher' => 'Philosopher',
						'Piedra' => 'Piedra',
						'Pinyon Script' => 'Pinyon Script',
						'Pirata One' => 'Pirata One',
						'Plaster' => 'Plaster',
						'Play' => 'Play',
						'Playball' => 'Playball',
						'Playfair Display' => 'Playfair Display',
						'Playfair Display SC' => 'Playfair Display SC',
						'Podkova' => 'Podkova',
						'Poiret One' => 'Poiret One',
						'Poller One' => 'Poller One',
						'Poly' => 'Poly',
						'Pompiere' => 'Pompiere',
						'Pontano Sans' => 'Pontano Sans',
						'Poppins' => 'Poppins',
						'Port Lligat Sans' => 'Port Lligat Sans',
						'Port Lligat Slab' => 'Port Lligat Slab',
						'Pragati Narrow' => 'Pragati Narrow',
						'Prata' => 'Prata',
						'Preahvihear' => 'Preahvihear',
						'Press Start 2P' => 'Press Start 2P',
						'Pridi' => 'Pridi',
						'Princess Sofia' => 'Princess Sofia',
						'Prociono' => 'Prociono',
						'Prompt' => 'Prompt',
						'Prosto One' => 'Prosto One',
						'Proza Libre' => 'Proza Libre',
						'PT Mono' => 'PT Mono',
						'PT Sans' => 'PT Sans',
						'PT Sans Caption' => 'PT Sans Caption',
						'PT Sans Narrow' => 'PT Sans Narrow',
						'PT Serif' => 'PT Serif',
						'PT Serif Caption' => 'PT Serif Caption',
						'Puritan' => 'Puritan',
						'Purple Purse' => 'Purple Purse',
						'Quando' => 'Quando',
						'Quantico' => 'Quantico',
						'Quattrocento' => 'Quattrocento',
						'Quattrocento Sans' => 'Quattrocento Sans',
						'Questrial' => 'Questrial',
						'Quicksand' => 'Quicksand',
						'Quintessential' => 'Quintessential',
						'Qwigley' => 'Qwigley',
						'Racing Sans One' => 'Racing Sans One',
						'Radley' => 'Radley',
						'Rajdhani' => 'Rajdhani',
						'Rakkas' => 'Rakkas',
						'Raleway' => 'Raleway',
						'Raleway Dots' => 'Raleway Dots',
						'Ramabhadra' => 'Ramabhadra',
						'Ramaraja' => 'Ramaraja',
						'Rambla' => 'Rambla',
						'Rammetto One' => 'Rammetto One',
						'Ranchers' => 'Ranchers',
						'Rancho' => 'Rancho',
						'Ranga' => 'Ranga',
						'Rasa' => 'Rasa',
						'Rationale' => 'Rationale',
						'Ravi Prakash' => 'Ravi Prakash',
						'Redressed' => 'Redressed',
						'Reem Kufi' => 'Reem Kufi',
						'Reenie Beanie' => 'Reenie Beanie',
						'Revalia' => 'Revalia',
						'Rhodium Libre' => 'Rhodium Libre',
						'Ribeye' => 'Ribeye',
						'Ribeye Marrow' => 'Ribeye Marrow',
						'Righteous' => 'Righteous',
						'Risque' => 'Risque',
						'Roboto' => 'Roboto',
						'Roboto Condensed' => 'Roboto Condensed',
						'Roboto Mono' => 'Roboto Mono',
						'Roboto Slab' => 'Roboto Slab',
						'Rochester' => 'Rochester',
						'Rock Salt' => 'Rock Salt',
						'Rokkitt' => 'Rokkitt',
						'Romanesco' => 'Romanesco',
						'Ropa Sans' => 'Ropa Sans',
						'Rosario' => 'Rosario',
						'Rosarivo' => 'Rosarivo',
						'Rouge Script' => 'Rouge Script',
						'Rozha One' => 'Rozha One',
						'Rubik' => 'Rubik',
						'Rubik Mono One' => 'Rubik Mono One',
						'Ruda' => 'Ruda',
						'Rufina' => 'Rufina',
						'Ruge Boogie' => 'Ruge Boogie',
						'Ruluko' => 'Ruluko',
						'Rum Raisin' => 'Rum Raisin',
						'Ruslan Display' => 'Ruslan Display',
						'Russo One' => 'Russo One',
						'Ruthie' => 'Ruthie',
						'Rye' => 'Rye',
						'Sacramento' => 'Sacramento',
						'Sahitya' => 'Sahitya',
						'Sail' => 'Sail',
						'Salsa' => 'Salsa',
						'Sanchez' => 'Sanchez',
						'Sancreek' => 'Sancreek',
						'Sansita' => 'Sansita',
						'Sarala' => 'Sarala',
						'Sarina' => 'Sarina',
						'Sarpanch' => 'Sarpanch',
						'Satisfy' => 'Satisfy',
						'Scada' => 'Scada',
						'Scheherazade' => 'Scheherazade',
						'Schoolbell' => 'Schoolbell',
						'Scope One' => 'Scope One',
						'Seaweed Script' => 'Seaweed Script',
						'Secular One' => 'Secular One',
						'Sevillana' => 'Sevillana',
						'Seymour One' => 'Seymour One',
						'Shadows Into Light' => 'Shadows Into Light',
						'Shadows Into Light Two' => 'Shadows Into Light Two',
						'Shanti' => 'Shanti',
						'Share' => 'Share',
						'Share Tech' => 'Share Tech',
						'Share Tech Mono' => 'Share Tech Mono',
						'Shojumaru' => 'Shojumaru',
						'Short Stack' => 'Short Stack',
						'Shrikhand' => 'Shrikhand',
						'Siemreap' => 'Siemreap',
						'Sigmar One' => 'Sigmar One',
						'Signika' => 'Signika',
						'Signika Negative' => 'Signika Negative',
						'Simonetta' => 'Simonetta',
						'Sintony' => 'Sintony',
						'Sirin Stencil' => 'Sirin Stencil',
						'Six Caps' => 'Six Caps',
						'Skranji' => 'Skranji',
						'Slabo 13px' => 'Slabo 13px',
						'Slabo 27px' => 'Slabo 27px',
						'Slackey' => 'Slackey',
						'Smokum' => 'Smokum',
						'Smythe' => 'Smythe',
						'Sniglet' => 'Sniglet',
						'Snippet' => 'Snippet',
						'Snowburst One' => 'Snowburst One',
						'Sofadi One' => 'Sofadi One',
						'Sofia' => 'Sofia',
						'Sonsie One' => 'Sonsie One',
						'Sorts Mill Goudy' => 'Sorts Mill Goudy',
						'Source Code Pro' => 'Source Code Pro',
						'Source Sans Pro' => 'Source Sans Pro',
						'Source Serif Pro' => 'Source Serif Pro',
						'Space Mono' => 'Space Mono',
						'Special Elite' => 'Special Elite',
						'Spectral' => 'Spectral',
						'Spicy Rice' => 'Spicy Rice',
						'Spinnaker' => 'Spinnaker',
						'Spirax' => 'Spirax',
						'Squada One' => 'Squada One',
						'Sree Krushnadevaraya' => 'Sree Krushnadevaraya',
						'Sriracha' => 'Sriracha',
						'Stalemate' => 'Stalemate',
						'Stalinist One' => 'Stalinist One',
						'Stardos Stencil' => 'Stardos Stencil',
						'Stint Ultra Condensed' => 'Stint Ultra Condensed',
						'Stint Ultra Expanded' => 'Stint Ultra Expanded',
						'Stoke' => 'Stoke',
						'Strait' => 'Strait',
						'Sue Ellen Francisco' => 'Sue Ellen Francisco',
						'Suez One' => 'Suez One',
						'Sumana' => 'Sumana',
						'Sunshiney' => 'Sunshiney',
						'Supermercado One' => 'Supermercado One',
						'Sura' => 'Sura',
						'Suranna' => 'Suranna',
						'Suravaram' => 'Suravaram',
						'Suwannaphum' => 'Suwannaphum',
						'Swanky and Moo Moo' => 'Swanky and Moo Moo',
						'Syncopate' => 'Syncopate',
						'Tangerine' => 'Tangerine',
						'Taprom' => 'Taprom',
						'Tauri' => 'Tauri',
						'Taviraj' => 'Taviraj',
						'Teko' => 'Teko',
						'Telex' => 'Telex',
						'Tenali Ramakrishna' => 'Tenali Ramakrishna',
						'Tenor Sans' => 'Tenor Sans',
						'Text Me One' => 'Text Me One',
						'The Girl Next Door' => 'The Girl Next Door',
						'Tienne' => 'Tienne',
						'Tillana' => 'Tillana',
						'Timmana' => 'Timmana',
						'Tinos' => 'Tinos',
						'Titan One' => 'Titan One',
						'Titillium Web' => 'Titillium Web',
						'Trade Winds' => 'Trade Winds',
						'Trirong' => 'Trirong',
						'Trocchi' => 'Trocchi',
						'Trochut' => 'Trochut',
						'Trykker' => 'Trykker',
						'Tulpen One' => 'Tulpen One',
						'Ubuntu' => 'Ubuntu',
						'Ubuntu Condensed' => 'Ubuntu Condensed',
						'Ubuntu Mono' => 'Ubuntu Mono',
						'Ultra' => 'Ultra',
						'Uncial Antiqua' => 'Uncial Antiqua',
						'Underdog' => 'Underdog',
						'Unica One' => 'Unica One',
						'UnifrakturCook' => 'UnifrakturCook',
						'UnifrakturMaguntia' => 'UnifrakturMaguntia',
						'Unkempt' => 'Unkempt',
						'Unlock' => 'Unlock',
						'Unna' => 'Unna',
						'Vampiro One' => 'Vampiro One',
						'Varela' => 'Varela',
						'Varela Round' => 'Varela Round',
						'Vast Shadow' => 'Vast Shadow',
						'Vesper Libre' => 'Vesper Libre',
						'Vibur' => 'Vibur',
						'Vidaloka' => 'Vidaloka',
						'Viga' => 'Viga',
						'Voces' => 'Voces',
						'Volkhov' => 'Volkhov',
						'Vollkorn' => 'Vollkorn',
						'Voltaire' => 'Voltaire',
						'VT323' => 'VT323',
						'Waiting for the Sunrise' => 'Waiting for the Sunrise',
						'Wallpoet' => 'Wallpoet',
						'Walter Turncoat' => 'Walter Turncoat',
						'Warnes' => 'Warnes',
						'Wellfleet' => 'Wellfleet',
						'Wendy One' => 'Wendy One',
						'Wire One' => 'Wire One',
						'Work Sans' => 'Work Sans',
						'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
						'Yantramanav' => 'Yantramanav',
						'Yatra One' => 'Yatra One',
						'Yellowtail' => 'Yellowtail',
						'Yeseva One' => 'Yeseva One',
						'Yesteryear' => 'Yesteryear',
						'Yrsa' => 'Yrsa',
						'Zeyada' => 'Zeyada',
						'Zilla Slab' => 'Zilla Slab'
					);


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "Getting Started",
						"type" 		=> "heading"
				);	

$of_options[] = array( 	"name" 		=> "dem_sett",
						"desc" 		=> "",
						"id" 		=> "dem_sett",
						"std" 		=> "<h3>Import Templates</h3>Import Creativo Templates with just one click",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Demo text",
						"desc" 		=> "",
						"id" 		=> "text_demo",
						"std" 		=> '<p>Now that you have installed Creativo on your WordPress site, you can import one of the available templates, with just one click – basically make your WordPress site look exactly like our templates, including images, content, sliders and Theme Options.</p><p>To do this, go to Appearance -> Import Templates area.</p>
						<p>You can see listed there all the available templates. With every new update of the theme, we will also be adding new templates, to which you will have Free access.</p>
						<p>Once you have decided which template you want to import, click the Install button bellow that appears below the desired template. A pop-up window will appear informing you that the import process will begin – you will also be informed that the demo import should best be performed on a clean wordpress install.</p>
						<p>Wait for a few seconds or minutes. After the process is completed you will be informed with a pop-up message that the import process has finished.</p>
						<p>Try loading your home page now, it should look exactly like the demo template you imported. If for example you imported Blogger template, your site should look exactly like: <a href="https://rockythemes.com/creativo-blogger/" target="_blank">https://rockythemes.com/creativo-blogger/</a></p>
						<p>You can now start customizing the theme with your own content, font families, colors, etc.</p>
						<p>Read the more on <a href="https://rockythemes.com/documentation/importing-a-creativo-template/" target="_blank">Importing a Creativo Template</a></p>',
						"icon" 		=> true,
						"type" 		=> "plain_text"
				);

$of_options[] = array( 	"name" 		=> "theme_doc",
						"desc" 		=> "",
						"id" 		=> "theme_doc",
						"std" 		=> "<h3>Creativo Documentation</h3>Learn how to use and customize the Creativo theme",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Creativo Doc",
						"desc" 		=> "",
						"id" 		=> "cr_doc",
						"std" 		=> '<p>Check out the online documentation for the Creativo theme here: <a href="https://rockythemes.com/documentation/" target="_blank">https://rockythemes.com/documentation/</a></p>						
							<ul>
								<li><a href="https://rockythemes.com/documentation/category/getting-started/" target="_blank">Getting Started Tutorials</a></li>
								<li><a href="https://rockythemes.com/documentation/category/header/" target="_blank">Header Tutorials</a></li>
								<li><a href="https://rockythemes.com/documentation/category/footer/" target="_blank">Footer Tutorials</a></li>
								<li><a href="https://rockythemes.com/documentation/category/blog-posts/" target="_blank">Blog Posts Tutorials</a></li>
								<li><a href="https://rockythemes.com/documentation/category/pages/" target="_blank">Pages Tutorials</a></li>
								<li><a href="https://rockythemes.com/documentation/category/blog-posts/" target="_blank">Sliders Tutorials</a></li>								
							</ul>
						',
						"icon" 		=> true,
						"type" 		=> "plain_text"
				);

$of_options[] = array( 	"name" 		=> "Logo Favicon",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Logo",
						"desc" 		=> "",
						"id" 		=> "logo_fav",
						"std" 		=> "<h3>Logo and Favicon Settings.</h3>",
						"icon" 		=> true,						
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);				
$of_options[] = array( 	"name" 		=> "Logo ",
						"desc" 		=> "Upload your website logo.",
						"id" 		=> "logo",						
						"std" 		=> "",						
						"type" 		=> "upload",
						"collapse_sec"	=> "logo_fav"
				);
				
$of_options[] = array( 	"name" 		=> "Retina Logo ",
						"desc" 		=> "Upload your website retina logo. Your Retina Logo should be twice the size of your normal logo. For example if your normal logo is: 175x35, your retina logo should be: 360x70 pixels. ",
						"id" 		=> "retina_logo",						
						"std" 		=> "",
						"type" 		=> "upload",
						"collapse_sec"	=> "logo_fav"
				);

$of_options[] = array( 	"name" 		=> "Mobile Logo Upload",
						"desc" 		=> "Optionally you can upload another logo to be used for mobile devices with resolution lower than 830px.",
						"id" 		=> "mobile_logo",						
						"std" 		=> "",
						"type" 		=> "upload",
						"collapse_sec"	=> "logo_fav"
				);

$of_options[] = array( 	"name" 		=> "Transparent Header Logo ",
						"desc" 		=> "Set a custom logo for Transparent Header. This will be used sitewide unless you specify a custom logo individually for each post or page and only if the Transparent Header is turned on",
						"id" 		=> "transparent_logo",						
						"std" 		=> "",
						"type" 		=> "upload",
						"collapse_sec"	=> "logo_fav"
				);

$of_options[] = array( 	"name" 		=> "Transparent Header Logo Retina",
						"desc" 		=> "Set a custom retina logo for Transparent Header. This will be used sitewide unless you specify a custom logo individually for each post or page and only if the Transparent Header is turned on",
						"id" 		=> "transparent_logo_retina",						
						"std" 		=> "",
						"type" 		=> "upload",
						"collapse_sec"	=> "logo_fav"
				);							
				
$of_options[] = array(  "name" => "Enable Custom URL for Logo",
						"desc" => "Enable or Disable the use of custom url for your logo.",
						"id" => "en_custom_logo_url",
						"std" => 0,
						"folds" => 1,
						"type" => "switch",
						"collapse_sec"	=> "logo_fav"
					);				
				
$of_options[] = array( 	"name" 		=> "Logo Custom URL",
						"desc" 		=> "Enter a custom url (including http://) that will be used when clicking the logo. Leave blank to not use this feature",
						"id" 		=> "custom_logo_url",
						"std" 		=> "",
						"fold"		=> "en_custom_logo_url",
						"type" 		=> "text",
						"collapse_sec"	=> "logo_fav"
				);				
				
$of_options[] = array(  "name" => "Logo Top Padding",
						"id" => "logo_padding_top",
						"std" 		=> "25",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" ,
						"collapse_sec"	=> "logo_fav"
				);	

$of_options[] = array(  "name" => "Logo Bottom Padding",
						"id" => "logo_padding_bottom",
						"std" 		=> "25",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" ,
						"collapse_sec"	=> "logo_fav"
				);		

$of_options[] = array(  "name" => "Logo Left Padding",
						"id" => "logo_padding_left",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "logo_fav" 
				);
				
$of_options[] = array(  "name" => "Logo Right Padding",
						"id" => "logo_padding_right",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "logo_fav"
				);				
				
$of_options[] = array(  "name" => "Logo Resize",
						"desc" => "Force logo resize to a give value.",
						"id" => "logo_resize",
						"std" => 0,
						"type" => "switch",
						"collapse_sec"	=> "logo_fav"
					);				

$of_options[] = array( 	"name" 		=> "Logo Resize width",
						"desc" 		=> "Enter the resize width of the logo in pixels. E.g: 200px",
						"id" 		=> "logo_resize_value",
						"std" 		=> "150px",
						"fold" => "logo_resize",
						"type" 		=> "text",
						"collapse_sec"	=> "logo_fav"
				);
			
$of_options[] = array(  "name" => "Logo Separator",
						"desc" => "Add a logo separator to the right of the logo.",
						"id" => "logo_separator",
						"std" => 0,
						"type" => "switch",
						"collapse_sec"	=> "logo_fav"
					);

$of_options[] = array(  "name" => "Logo Separator Left spacing",
						"id" => "logo_separator_space_left",
						"std" 		=> "40",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"fold" => "logo_separator",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "logo_fav"
				);	

$of_options[] = array(  "name" => "Logo Separator Right spacing",
						"id" => "logo_separator_space_right",
						"std" 		=> "10",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"fold" => "logo_separator",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "logo_fav" 
				);	

$of_options[] = array( 	"name" 		=> "Logo Separator ",
						"desc" => "",
						"id" => "logo_separator_color",
						"std" => "#444444",
						"fold" => "logo_separator",
						"type" => "color",
						"collapse_sec"	=> "logo_fav"
				);										

$of_options[] = array( 	"name" 		=> "Favicon Upload",
						"desc" 		=> "Upload your custom favicon. To generate a favicon you can visit <a href=\"http://tools.dynamicdrive.com/favicon/\" target=\"_blank\">Dynamic Drive</a>",
						"id" 		=> "favicon",						
						"std" 		=> "",
						"type" 		=> "upload",
						"collapse_sec"	=> "logo_fav"
				);
				
$of_options[] = array( 	"name" 		=> "Text Logo",
						"desc" 		=> "",
						"id" 		=> "text_logos",
						"std" 		=> "<h3>Text Logo</h3>",						
						"type" 		=> "info",
						"class" 		=> "hide_me admin_accord",
						"collapse"	=> true
				);	

$of_options[] = array( 	"name" 		=> "Text logo explain",						
						"id" 		=> "text_logo_explain",
						"std" 		=> 'If no image logo is used, the text logo will be used. The text logo will automatically display your Site Name. To change your Site Name, please go to Settings -> General',
						"icon" 		=> true,
						"type" 		=> "plain_text",
						"collapse_sec"	=> "text_logos"
				);

$of_options[] = array(  "name" => "Text Logo Html Tag",
						"id" => "text_logo_tag",
						"std" => "h1",
						"desc" => "Select the html tag to be used for the text logo.",
						"type" => "select",
						"options" => array("h1" => "H1", "h2" => "H2", "h3" => "H3", "h4" => "H4", "h5" => "H5"),
						"collapse_sec"	=> "text_logos"
					);	

$of_options[] = array( 	"name" 		=> "Text Logo Font Size (px)",
						"desc" => "Default is 13",
						"id" => "textlogo_font_size",
						"std" 		=> "24",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "80",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "text_logos" 
				);	

$of_options[] = array(  "name" => "Text Logo Font Weight",
						"id" => "textlogo_font_weight",
						"desc" => "Default is: 300",
						"std" => "300",
						"type" => "select",
						"options" => array(300,400,500,600,700),
						"collapse_sec"	=> "text_logos");				
				
$of_options[] = array( 	"name" 		=> "Text Logo Color",
						"desc" => "",
						"id" => "text_logo_color",
						"std" => "#21252b",
						"type" => "color",
						"collapse_sec"	=> "text_logos" 
				);	

$of_options[] = array( 	"name" 		=> "Text Logo Color on Hover",
						"desc" => "",
						"id" => "text_logo_color_hover",
						"std" => "#99d37c",
						"type" => "color",
						"collapse_sec"	=> "text_logos" 
				);	
				
$of_options[] = array( 	"name" 		=> "Tagline",
						"desc" 		=> "",
						"id" 		=> "tagline_field",
						"std" 		=> "<h3>Tagline</h3>",
						"icon" 		=> true,
						"type" 		=> "info",
						"class" 		=> "hide_me admin_accord",
						"collapse"	=> true
				);	

$of_options[] = array( 	"name" 		=> "Text logo explain",						
						"id" 		=> "text_logo_explaining",
						"std" 		=> 'Add or remove your site Tagline. To change your Site Tagline, please go to Settings -> General',
						"icon" 		=> true,
						"type" 		=> "plain_text",
						"collapse_sec"	=> "tagline_field"
				);
				
$of_options[] = array(  "name" => "Enable Tagline",
						"desc" => "Enable or Disable the Tagline.",
						"id" => "en_tagline",
						"std" => 0,
						"folds" => 1,
						"collapse_sec"	=> "tagline_field",
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Tagline Color",
						"desc" => "",
						"id" => "tagline_color",
						"std" => "#dddddd",
						"fold" => "en_tagline",
						"type" => "color",
						"collapse_sec"	=> "tagline_field",
				);		
				
$of_options[] = array( 	"name" 		=> "Tagline Font Size (px)",
						"desc" => "Default is 13",
						"id" => "tagline_font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "42",
						"fold"		=> "en_tagline",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "tagline_field"
				);																	
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);	


$of_options[] = array( 	"name" 		=> "General Settings",
						"desc" 		=> "",
						"id" 		=> "gen_set",
						"std" 		=> "<h3>General Settings</h3>",
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);


$of_options[] = array(  "name" => "Page Loading",
						"desc" 		=> "Enable/disable page loading effect.",
						"id" => "page_load_effect",
						"std" => "0",
						"folds" => "1",
						"collapse_sec"	=> "gen_set",
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Page Loading Symbol color ",
						"desc" => "Choose the color of the loading symbol",
						"id" => "page_load_symbol_color",
						"std" => "#40a168",
						"fold" => "page_load_effect",
						"type" => "color",
						"collapse_sec"	=> "gen_set",
				);	

$of_options[] = array(  "name" => "Smooth Scroll",
						"desc" 		=> "Enable/disable smooth scroll effect.",
						"id" => "page_smooth_scroll",
						"std" => "0",
						"collapse_sec"	=> "gen_set",
						"type" => "switch");

$of_options[] = array(  "name" => "Creativo Minified CSS",
						"desc" 		=> "Enable/disable minified CSS.",
						"id" => "load_minified_css",
						"std" => "0",
						"collapse_sec"	=> "gen_set",
						"type" => "switch");

$of_options[] = array(  "name" => "Creativo Minified JS scripts",
						"desc" 		=> "Enable/disable minified JS scripts.",
						"id" => "load_minified",
						"std" => "0",
						"collapse_sec"	=> "gen_set",
						"type" => "switch");

$of_options[] = array(  "name" => "Featured Images",
						"name" => "How many Featured Images to use",
						"id" => "featured_images_count",
						"std" 		=> "5",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "30",
						"collapse_sec"	=> "gen_set",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Comments on Pages",
						"desc" 		=> "Enable/disable comments on Default Page Template.",
						"id" => "comments_pages",
						"std" => "1",
						"collapse_sec"	=> "gen_set",
						"type" => "switch");
				
$of_options[] = array( 	"name" 		=> "Header pos",
						"desc" 		=> "",
						"id" 		=> "header_p",
						"std" 		=> "<h3>Header Position</h3>",						
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);		

$of_options[] = array(  "name" => "Header Position",
						"desc" 		=> "Use the select box to choose the positioning of the Header.",
						"id" => "header_position",
						"std" => "Top",
						"type" => "select",
						"collapse_sec"	=> "header_p",
						"options" => array("top" => "Top", "left" => "Left", "right" => "Right"));													

$of_options[] = array( 	"name" 		=> "Site Layout",
						"desc" 		=> "Select an existing layout for your site.",
						"id" 		=> "site_layout",
						"std" 		=> "<h3>Site Layout</h3>",						
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Site Layout",
						"id" => "site_width",
						"std" => "extra_wide",
						"type" => "select",
						"collapse_sec"	=> "site_layout",
						"options" => array( "extra_wide" => "Extra Wide", "wide" => "Wide", "boxed" => "Boxed"));	
						
$of_options[] = array(  "name" => "Boxed Layout width",
						"id" => "boxed_width",
						"desc" => "Select the width of the Boxed Layout: normal or wide",
						"std" => "normal",
						"type" => "select",
						"collapse_sec"	=> "site_layout",
						"options" => array("960px", "1160px"));

$of_options[] = array( 	"name" 		=> "Search options",						
						"id" 		=> "search_options",
						"std" 		=> "<h3>Search Options</h3>",						
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
						
						
$of_options[] = array(  "name" => "Search in Posts",
						"desc" 		=> "Include Posts in search results.",
						"id" => "en_search_post",
						"std" => "1",
						"collapse_sec"	=> "search_options",
						"type" => "switch");

$of_options[] = array(  "name" => "Search in Pages",
						"desc" 		=> "Include Pages in search results.",
						"id" => "en_search_page",
						"std" => "1",
						"collapse_sec"	=> "search_options",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Search in Portfolio items",
						"desc" 		=> "Include Portfolio items in search results.",
						"id" => "en_search_portfolio",
						"std" => "1",
						"collapse_sec"	=> "search_options",
						"type" => "switch");						
						
$of_options[] = array(  "name" => "Search in WooCommerce Products",
						"desc" 		=> "Include WooCommerce Products in search results - only if WooCommerce plugin is active.",
						"id" => "en_search_product",
						"std" => "1",
						"collapse_sec"	=> "search_options",
						"type" => "switch");	

$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "",
						"id" 		=> "track_code",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Tracking Code / Header Code / Body Code</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Visitors Tracking Code",
						"desc" 		=> "Paste here your google analytics or any other visitors tracking code you want to use",
						"id" 		=> "footer_code",
						"std" 		=> "",
						"collapse_sec"	=> "track_code",
						"type" 		=> "textarea"
				);	

$of_options[] = array( 	"name" 		=> "Javascript Code before &lt;/head&gt;",
						"desc" 		=> "Paste here your javascript code that will be rendered before the closing &lt;/head&gt; tag",
						"id" 		=> "header_code",
						"std" 		=> "",
						"collapse_sec"	=> "track_code",
						"type" 		=> "textarea"
				);																																								

$of_options[] = array( 	"name" 		=> "Javascript Code before &lt;/body&gt;",
						"desc" 		=> "Paste here your javascript code that will be rendered before the closing &lt;/body&gt; tag",
						"id" 		=> "body_code",
						"std" 		=> "",
						"collapse_sec"	=> "track_code",
						"type" 		=> "textarea"
				);
						
$of_options[] = array( 	"name" 		=> "Responsiveness",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Site Responsiveness",
						"desc" 		=> "",
						"id" 		=> "resp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Responsiveness</h3>Choose if you want to enable or disable the responsive layout for the theme.",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "",
						"desc" 		=> "Enable/disable site responsiveness.",
						"id" => "responsiveness",
						"std" => "1",
						"type" => "switch");																														

$of_options[] = array( 	"name" 		=> "Typography",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Fonts",
						"desc" 		=> "",
						"id" 		=> "g_fonts",
						"std" 		=> "<h3>Google Fonts Settings</h3>",
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Select Logo and Tagline Font Family",
						"desc" => "Select a font family for text logo and tagline text",
						"id" => "logo_tagline_font",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Logo and Tagline", 
									"size" => "13px"
						),
						"options" => $google_fonts);	
													
$of_options[] = array(  "name" => "Select Body Font Family",
						"desc" => "Select a font family for body text",
						"id" => "body_font",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Body Font Family", 
									"size" => "13px"
						),
						"options" => $google_fonts);
													
$of_options[] = array(  "name" => "Select Headings Font Family",
						"desc" => "Select a font family for headings",
						"id" => "heading_font",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Headings Font Family", 
									"size" => "13px"
						),
						"options" => $google_fonts);
						
$of_options[] = array(  "name" => "Sidebar Headings Font Family",
						"desc" => "Select a font family for the sidebar headings",
						"id" => "side_heading_font",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Sidebar Headings Font Family", 
									"size" => "13px"
						),
						"options" => $google_fonts);	
						

$of_options[] = array(  "name" => "Header Menu Font Family",
						"desc" => "Select a font family for the header menu",
						"id" => "menu_font_family",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "HOME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PAGES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SHORTCODES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CONTACT",									
									"size" => "13px"
						),
						"options" => $google_fonts);
						
$of_options[] = array(  "name" => "Top Bar Menu Font Family",
						"desc" => "Select a font family for the top menu",
						"id" => "tm_font_family",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Top Menu", 
									"size" => "13px"
						),
						"options" => $google_fonts);						

$of_options[] = array(  "name" => "Buttons Font Family",
						"desc" => "Select a font family for the buttons used on your site",
						"id" => "btn_font_family",
						"std" => "Open Sans",
						"collapse_sec"	=> "g_fonts",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Buttons", 
									"size" => "13px"
						),
						"options" => $google_fonts);
						
$of_options[] = array( 	"name" 		=> "Google Character Sets",
						"desc" 		=> "Adjust the settings to load different character sets. More character sets equals to slower page load. Possible options are: latin, latin-ext, cyrillic, cyrillic-ext, greek, greek-ext, vietnamese",
						"id" 		=> "ggl_character_sets",
						"std" 		=> "latin",
						"collapse_sec"	=> "g_fonts",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Google Fonts Weight",
						"desc" 		=> "Adjust the settings to load different font weight. More font weights equals to slower page load. Possible options are: 300,400,400italic,500,600,700,700italic,800,900",
						"id" 		=> "ggl_font_weight",
						"std" 		=> "400,400italic,700,700italic",
						"collapse_sec"	=> "g_fonts",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Custom Font",
						"desc" 		=> "",
						"id" 		=> "c_fonts",
						"std" 		=> "<h3 style=\"margin: 0;\">Custom Font</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);				

$of_options[] = array(  "name" => "Custom Font .woff",
						"desc" => "Upload here the .woff font file.",
						"id" => "custom_woff",
						"std" => "",
						"mod" => "yes",
						"collapse_sec"	=> "c_fonts",
						"type" => "upload");	
						
$of_options[] = array(  "name" => "Custom Font .ttf",
						"desc" => "Upload here the .ttf font file.",
						"id" => "custom_ttf",
						"std" => "",
						"mod" => "yes",
						"collapse_sec"	=> "c_fonts",
						"type" => "media");	
						
$of_options[] = array(  "name" => "Custom Font .svg",
						"desc" => "Upload here the .svg font file.",
						"id" => "custom_svg",
						"std" => "",
						"mod" => "yes",
						"collapse_sec"	=> "c_fonts",
						"type" => "media");	
						
$of_options[] = array(  "name" => "Custom Font .eot",
						"desc" => "Upload here the .eot font file.",
						"id" => "custom_eot",
						"std" => "",
						"mod" => "yes",
						"collapse_sec"	=> "c_fonts",
						"type" => "media");	
							
						
$of_options[] = array( 	"name" 		=> "Choose where to use your Custom Font",
						"desc" 		=> "Use for Body Font",
						"id" 		=> "custom_body",
						"std" 		=> 0,
						"collapse_sec"	=> "c_fonts",
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"desc" 		=> "Use for Text Logo and tagline",
						"id" 		=> "custom_logo_tagline",
						"std" 		=> 0,
						"collapse_sec"	=> "c_fonts",
						"type" 		=> "switch"
				);				
$of_options[] = array( 	"desc" 		=> "Use for Header Menu",
						"id" 		=> "custom_menu",
						"std" 		=> 0,
						"collapse_sec"	=> "c_fonts",
						"type" 		=> "switch"
				);	
				
$of_options[] = array( 	"desc" 		=> "Use for Top Bar Menu",
						"id" 		=> "custom_top_menu",
						"std" 		=> 0,
						"collapse_sec"	=> "c_fonts",
						"type" 		=> "switch"
				);				
				
$of_options[] = array( 	"desc" 		=> "Use for Headings",
						"id" 		=> "custom_heading",
						"std" 		=> 0,
						"collapse_sec"	=> "c_fonts",
						"type" 		=> "switch"
				);	
							

$of_options[] = array( 	"desc" 		=> "Use on Sidebar Headings",
						"id" 		=> "custom_sidebar",
						"std" 		=> 0,
						"collapse_sec"	=> "c_fonts",
						"type" 		=> "switch"
				);																						

$of_options[] = array( 	"name" 		=> "Body Font Sizes",
						"desc" 		=> "",
						"id" 		=> "g_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Body Font Size</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Body Font Line Height",
						"id" => "body_line_height",
						"std" => "22px",
						"type" => "text",
						"collapse_sec"	=> "g_font_sizes",
						"desc" => "Enter the line height for the Body font."
						);	
				
$of_options[] = array( 	"name" 		=> "Body Font Size (px)",
						"desc" => "Default is 13",
						"id" => "font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "42",
						"collapse_sec"	=> "g_font_sizes",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Body Font Weight",
						"id" => "body_font_weight",
						"desc" => "Select the font weight for the body. Make sure you also set the correct values under Google Fonts Weight option above.",
						"std" => "400",
						"type" => "select",
						"collapse_sec"	=> "g_font_sizes",
						"options" => array(300,400,500, 600,700,800,900));	

$of_options[] = array( 	"name" 		=> "Body Text Letter Spacing (px)",
						"desc" => "Default is 0",
						"id" => "body_letter_spacing",												
						"std" => "0",
						"type" => "text",
						"collapse_sec"	=> "g_font_sizes",
						"desc" => "Enter a value for letter spacing."
						);	

$of_options[] = array( 	"name" 		=> "Header Menu & SubMenu Font Sizes",
						"desc" 		=> "",
						"id" 		=> "hm_sm_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Menu & SubMenu Font Sizes</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);				
						
$of_options[] = array(  "name" => "Header Menu Font Size(px)",
						"id" => "menu_font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "hm_sm_font_sizes",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Header SubMenu Font Size(px)",
						"id" => "submenu_font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "hm_sm_font_sizes",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Header SubMenu Line Height(px)",
						"id" => "submenu_line_height",
						"std" 		=> "35",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "80",
						"collapse_sec"	=> "hm_sm_font_sizes",
						"type" 		=> "sliderui" 
				);								

$of_options[] = array(  "name" => "Header Menu Font Weight - First Level only",
						"id" => "menu_font_weight",
						"std" => "400",
						"type" => "select",
						"collapse_sec"	=> "hm_sm_font_sizes",
						"options" => array(300,400,500, 600,700,800,900));
						
$of_options[] = array( 	"name" 		=> "Header Menu Letter Spacing",
						"id" => "menu_letter_spacing",
						"std" => "0",
						"type" => "text",
						"collapse_sec"	=> "hm_sm_font_sizes",
						"desc" => "Enter a value for letter spacing."
						);							

$of_options[] = array( 	"name" 		=> "Top Bar Font Sizes",
						"desc" 		=> "",
						"id" 		=> "tb_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Top Bar Font Sizes</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);				
$of_options[] = array(  "name" => "Top Bar Menu Font Size(px)",
						"id" => "tm_font_size",
						"std" 		=> "12",
						"desc" => "Default is 12",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "tb_font_sizes",
						"type" 		=> "sliderui" 
				);		

$of_options[] = array(  "name" => "Top Bar Contact Info Font Size(px)",
						"id" => "tb_contact_font_size",
						"std" 		=> "12",
						"desc" => "Default is 12",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "tb_font_sizes",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "Page Title Font Sizes",
						"desc" 		=> "",
						"id" 		=> "pt_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Page Title Font Sizes</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Page Title Font Size(px)",
						"id" => "page_title_font_size",
						"std" 		=> "18",
						"desc" => "Default is 18",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "pt_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array(  "name" => "Page Title SubHeading Font Size(px)",
						"id" => "page_title_subheading_font_size",
						"std" 		=> "13",
						"desc" => "Default is 13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "pt_font_sizes",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "Sidebar Font Sizes",
						"desc" 		=> "",
						"id" 		=> "sidebar_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Sidebar Font Sizes</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);																	
				
$of_options[] = array( 	"name" 		=> "Sidebar Heading Font Size (px)",
						"desc" => "Default is 14",
						"id" => "side_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "sidebar_font_sizes",
						"type" 		=> "sliderui" 
				);		

$of_options[] = array(  "name" => "Sidebar Heading Font Weight",
						"id" => "side_font_weight",
						"std" => "600",
						"collapse_sec"	=> "sidebar_font_sizes",
						"type" => "select",
						"options" => array(300,400,500, 600,700,800,900));

$of_options[] = array( 	"name" 		=> "Footer Font Sizes",
						"desc" 		=> "",
						"id" 		=> "footer_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Footer Font Sizes</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Footer Sidebar Heading Font Size (px)",
						"desc" => "Default is 14",
						"id" => "footer_side_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "footer_font_sizes",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "Footer Widgets Font Size (px)",
						"desc" => "Default is 14",
						"id" => "footer_widgets_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "footer_font_sizes",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "Footer Copyright Font Size (px)",
						"desc" => "Default is 14",
						"id" => "footer_copyright_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "footer_font_sizes",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "Headings Font Sizes",
						"desc" 		=> "",
						"id" 		=> "head_font_sizes",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Headings Font Sizes</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);														
				
$of_options[] = array( 	"name" 		=> "Heading Font Size H1 (px)",
						"desc" => "Default is 36",
						"id" => "h1_font_size",
						"std" 		=> "36",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Heading Font Size H2 (px)",
						"desc" => "Default is 30",
						"id" => "h2_font_size",
						"std" 		=> "30",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Heading Font Size H3 (px)",
						"desc" => "Default is 24",
						"id" => "h3_font_size",
						"std" 		=> "24",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Heading Font Size H4 (px)",
						"desc" => "Default is 18",
						"id" => "h4_font_size",
						"std" 		=> "18",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Heading Font Size H5 (px)",
						"desc" => "Default is 14",
						"id" => "h5_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Heading Font Size H6 (px)",
						"desc" => "Default is 12",
						"id" => "h6_font_size",
						"std" 		=> "12",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array(  "name" => "H1, H2, H3, H4, H5, H6 Font Weight",
						"id" => "headings_font_weight",
						"std" => "400",
						"type" => "select",
						"collapse_sec"	=> "head_font_sizes",
						"options" => array(300,400,500,600,700,800,900));
						
$of_options[] = array(  "name" => "H1, H2, H3, H4, H5, H6 Margin Bottom",
						"id" => "headings_margin_bottom",
						"std" 		=> "10",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui"
				);																																
					
$of_options[] = array(  "name" => "Paragraph tag: < p > Margin Bottom",
						"id" => "paragraph_margin_bottom",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "head_font_sizes",
						"type" 		=> "sliderui"
				);								
				
$of_options[] = array( 	"name" 		=> "Fonts Color",
						"desc" 		=> "",
						"id" 		=> "fonts",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Fonts Colors</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);								
				
$of_options[] = array( 	"name" 		=> "Body Font Color",
						"desc" => "Default is #666666",
						"id" => "font_color",
						"std" => "#666666",
						"type" => "color" 
				);													

$of_options[] = array( 	"name" 		=> "Basic Design",
						"type" 		=> "heading"
				);
					
																					

						
$of_options[] = array( 	"name" 		=> "Boxed Layout Styling",
						"desc" 		=> "",
						"id" 		=> "boxed_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Boxed Layout Styling</h3>
						The settings bellow will only affect the Boxed Layout style.",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Outer Shadow",
						"desc" 		=> "Enable/disable outer shadow.",
						"id" => "outer_shadow",
						"std" => "0",
						"type" => "switch");	
						
$of_options[] = array( 	"name" 		=> "Margin Top / Bottom",
						"desc" => "Default is 20",
						"id" => "margin_all",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array( 	"name" 		=> "Outer Padding",
						"desc" => "Default is 0",
						"id" => "padding_out",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);																	
				
$of_options[] = array(  "name" => "Outer Border Style",
						"desc" => "Select the outer border style.",
						"id" => "outer_border_type",
						"std" => "solid",
						"type" => "select",
						"options" => array("dotted","dashed","solid","double","groove","inset","outset","ridge"));	
						
$of_options[] = array(  "name" => "Outer Border Width",
						"desc" => "Select the outer border width.",
						"id" => "outer_border",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "8",
						"type" 		=> "sliderui" 
				);						
						
$of_options[] = array( 	"name" 		=> "Outer Border Color",
						"desc" => "Default is #ECECEC",
						"id" => "outer_border_color",
						"std" => "#ECECEC",
						"type" => "color" 
				);	
				
$of_options[] = array( 	"name" 		=> "Outer Background",
						"desc" 		=> "Upload an image or new pattern for the background.",
						"id" 		=> "boxed_bg",						
						"std" 		=> "",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Outer Background Repeat",
						"id" => "bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat"));
						
$of_options[] = array(  "name" => "Outer Background Attachment",
						"desc" 		=> "Select Fixed to keep the background fixed in place on user scroll.",
						"id" => "bg_attachment",
						"std" => "fixed",
						"type" => "select",
						"options" => array("scroll","fixed"));												
				
$of_options[] = array(  "name" => "Fullscreen Background",
						"desc" 		=> "Enable/disable fullscreen background.",
						"id" => "bg_fullscreen",
						"std" => "0",						
						"type" => "switch");
						
$of_options[] = array(  "name" => "Enable Parallax",
						"desc" 		=> "Enable/disable parallax background.",
						"id" => "en_parallax",
						"std" => "0",						
						"type" => "switch");							
						
$of_options[] = array(  "name" => "Use Patterns",
						"desc" 		=> "Enable/disable background patterns (if enabled, the patterns will overide the background image settings.",
						"id" => "enable_pattern",
						"std" => "0",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Background Pattern",
						"desc" 		=> "Select a background pattern.",
						"id" 		=> "pattern",
						"std" 		=> $bg_images_url."pattern1.png",
						"type" 		=> "tiles",
						"fold" 		=> "enable_pattern",
						"options" 	=> array(
						"pattern1" => get_template_directory_uri()."/images/pattern/pattern1.png",
						"pattern2" => get_template_directory_uri()."/images/pattern/pattern2.png",
						"pattern3" => get_template_directory_uri()."/images/pattern/pattern3.png",
						"pattern4" => get_template_directory_uri()."/images/pattern/pattern4.png",
						"pattern5" => get_template_directory_uri()."/images/pattern/pattern5.png",
						"pattern6" => get_template_directory_uri()."/images/pattern/pattern6.png",
						"pattern7" => get_template_directory_uri()."/images/pattern/pattern7.png",
						"pattern8" => get_template_directory_uri()."/images/pattern/pattern8.png",
						"pattern9" => get_template_directory_uri()."/images/pattern/pattern9.png",
						"pattern10" => get_template_directory_uri()."/images/pattern/pattern10.png",
						"pattern11" => get_template_directory_uri()."/images/pattern/pattern11.png",
						"pattern12" => get_template_directory_uri()."/images/pattern/pattern12.png",
						"pattern13" => get_template_directory_uri()."/images/pattern/pattern13.png",
						"pattern14" => get_template_directory_uri()."/images/pattern/pattern14.png",
						"pattern15" => get_template_directory_uri()."/images/pattern/pattern15.png",
						"pattern16" => get_template_directory_uri()."/images/pattern/pattern16.png",
						"pattern17" => get_template_directory_uri()."/images/pattern/pattern17.png",
						"pattern18" => get_template_directory_uri()."/images/pattern/pattern18.png",
						"pattern19" => get_template_directory_uri()."/images/pattern/pattern19.png",
						"pattern20" => get_template_directory_uri()."/images/pattern/pattern20.png",
						"pattern21" => get_template_directory_uri()."/images/pattern/pattern21.png",
						"pattern22" => get_template_directory_uri()."/images/pattern/pattern22.png",
						"pattern23" => get_template_directory_uri()."/images/pattern/pattern23.png",
						"pattern24" => get_template_directory_uri()."/images/pattern/pattern24.png",
						"pattern25" => get_template_directory_uri()."/images/pattern/pattern25.png"
				));
				
$of_options[] = array(  "name" =>  "Outer Background Color",
						"desc" => "",
						"id" => "body_bg_color",
						"std" => "#ffffff",
						"type" => "color");		
						
$of_options[] = array(  "name" =>  "Inner Background Color",
						"desc" => "",
						"id" => "body_bg_color_inside",
						"std" => "#ffffff",
						"type" => "color");										
																									
				
$of_options[] = array( 	"name" 		=> "Colors",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Colors",
						"desc" 		=> "",
						"id" 		=> "colors_head",
						"std" 		=> "<h3>Colors</h3>Selec the main color scheme for Creativo. ",
						"icon" 		=> true,
						"type" 		=> "info"
				);	

$of_options[] = array(  "name" => "Predefined Color Scheme",
						"desc" => "",
						"id" => "color_scheme",
						"std" => "Light Red",
						"type" => "select",
						"options" => array( 'green' => 'Green',
											'blue' => 'Blue',  
											'red' => 'Red',  
											'yellow' => 'Yellow',
											'purple' => 'Purple',
											'grey' => 'Grey',
											'black' => 'Black'
									 ));
				
$of_options[] = array(  "name" =>  "Link Color",
						"desc" => "",
						"id" => "primary_color",
						"std" => "#333333",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Link Color on Hover",
						"desc" => "",
						"id" => "primary_color_hover",
						"std" => "#5bc98c",
						"type" => "color");	

/*						
$of_options[] = array(  "name" =>  "Second Link Color",
						"desc" => "",
						"id" => "second_link_color",
						"std" => "#E1F4C6",
						"type" => "color");	
*/						

$of_options[] = array(  "name" =>  "Image Hover Color - Potfolio &amp; Blog Items",
						"desc" => "",
						"id" => "pb_hover_color",
						"std" => "#5bc98c",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Shortcodes Default Color",
						"desc" => "",
						"id" => "shortcode_color",
						"std" => "#5bc98c",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Custom Colors",
						"desc" 		=> "",
						"id" 		=> "layout",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom Colors</h3>
						If you modify the colors above and need to keep them saved after you select a new color system use the options bellow to save your values (each field above has a correspondent below).",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Colors",
						"desc" 		=> "Enable custom colors pattern -  this will overide the color system selected above",
						"id" 		=> "use_custom",
						"std" 		=> 0,
						"folds" => 1,
						"type" 		=> "switch"
				);				
				
$of_options[] = array(  "name" =>  "Custom Primary Link Color",
						"desc" => "",
						"id" => "custom_primary_color",
						"fold" => "use_custom",
						"std" => "#58A623",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Second Link Color",
						"desc" => "",
						"id" => "custom_second_link_color",
						"fold" => "use_custom",
						"std" => "#E1F4C6",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Image Hover Color - Potfolio &amp; Blog Items",
						"desc" => "",
						"id" => "custom_pb_hover_color",
						"fold" => "use_custom",
						"std" => "#b4e56b",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Shortcodes Default Color",
						"desc" => "",
						"id" => "custom_shortcode_color",
						"fold" => "use_custom",
						"std" => "#a0ce4e",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Border Color",
						"desc" => "",
						"id" => "custom_button_border_color",
						"fold" => "use_custom",
						"std" => "#95b959",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Gradient Color (Top)",
						"desc" => "",
						"id" => "custom_button_gradient_top_color",
						"fold" => "use_custom",
						"std" => "#cae387",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Gradient Color (Bottom)",
						"desc" => "",
						"id" => "custom_button_gradient_bottom_color",
						"fold" => "use_custom",
						"std" => "#a5cb5e",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Text Color",
						"desc" => "",
						"id" => "custom_button_text_color",
						"fold" => "use_custom",
						"std" => "#5A742D",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Text Shadow Color",
						"desc" => "",
						"id" => "custom_button_text_shadow_color",
						"fold" => "use_custom",
						"std" => "#DFF4BC",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Footer Widget Link Color",
						"desc" => "",
						"id" => "custom_footer_widget_link_color",
						"fold" => "use_custom",
						"std" => "#77b31d",
						"type" => "color");				

$of_options[] = array( 	"name" 		=> "Top Bar",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> " Top Bar",
						"desc" 		=> "",
						"id" 		=> "head_top_bar",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Top Bar</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Top Bar explain",						
						"id" 		=> "top_bar_explaining",
						"std" 		=> 'Adds a top bar, above the Header section.',
						"icon" 		=> true,
						"type" 		=> "plain_text",
						"collapse_sec"	=> "head_top_bar"
				);
				
$of_options[] = array(  "name" => "Enable Top Bar",
						"desc" 		=> "Enable/disable top bar.",
						"id" => "en_top_bar",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "head_top_bar",
						"type" => "switch");  

$of_options[] = array(  "name" => "Disable Top Bar for posts",
						"desc" => "Check this option to disable the Top Bar on all Posts.",
						"id" => "top_bar_posts_disable",
						"std" => 0,
						"fold" => "en_top_bar",
						"collapse_sec"	=> "head_top_bar",
						"type" => "checkbox");
						
$of_options[] = array(  "name" => "Top Bar Left Content",
						"fold" => "en_top_bar",
						"desc" => "Select what to display in the left position of the Top Bar",
						"id" => "tb_left_content",
						"std" => "contactinfo",
						"type" => "select",
						"collapse_sec"	=> "head_top_bar",
						"options" => array('contactinfo' => 'Contact Info', 'socialinks' => 'Social Links', 'nav' => 'Top Menu', 'empty' => 'Leave Empty'));	
						
$of_options[] = array(  "name" => "Top Bar Right Content",
						"desc" => "Select what to display in the right position of the Top Bar",
						"fold" => "en_top_bar",
						"id" => "tb_right_content",
						"std" => "socialinks",
						"type" => "select",
						"collapse_sec"	=> "head_top_bar",
						"options" => array('contactinfo' => 'Contact Info', 'socialinks' => 'Social Links', 'nav' => 'Top Menu', 'empty' => 'Leave Empty'));

$of_options[] = array(  "name" => "Force Social Icons to Top Bar - Left or Right",
						"fold" => "en_top_bar",
						"desc" => "Use this option to force the Social Icons to appear on the Left or the Right area of the Top Bar, in addition to the selection above.",
						"id" => "tb_foce_social_icons",
						"std" => "no",
						"collapse_sec"	=> "head_top_bar",
						"type" => "select",
						"options" => array('no' => 'No', 'left' => 'Left Section', 'right' => 'Right Section'));																				
						
$of_options[] = array(  "name" =>  "Top Bar Background Color",
						"desc" => "",
						"id" => "top_bar_bg",
						"std" => "#000",
						"fold" => "en_top_bar",
						"collapse_sec"	=> "head_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Top Bar Bottom Border Color",
						"desc" => "",
						"id" => "top_bar_border",
						"std" => "#444",
						"fold" => "en_top_bar",
						"collapse_sec"	=> "head_top_bar",
						"type" => "color");							
						
$of_options[] = array(  "name" => "Top Bar Social Icons Color",
						"id" => "top_bar_social_color",
						"std" => "#eeeeee",
						"type" => "color",
						"fold" => "en_top_bar",
						"collapse_sec"	=> "head_top_bar"
						);
						
						
$of_options[] = array( 	"name" 		=> "Top Bar Icons Opacity - in percents",
						"desc" => "Default opacity: 60%",
						"id" => "social_icons_opacity",
						"std" 		=> "60",
						"min" 		=> "10",
						"step"		=> "5",
						"max" 		=> "100",
						"fold" => "en_top_bar",
						"collapse_sec"	=> "head_top_bar",
						"type" 		=> "sliderui" 
						);	
						
$of_options[] = array( 	"name" 		=> " Top Bar Menu",
						"desc" 		=> "",
						"id" 		=> "tb_mn",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Top Bar Menu</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,						
						"type" 		=> "info"
				);		
				
$of_options[] = array(  "name" =>  "Top Menu Link Color",
						"desc" => "",
						"id" => "tm_link_color",
						"std" => "#999999",	
						"collapse_sec"	=> "tb_mn",					
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Top Menu Link Color on Hover",
						"desc" => "",
						"id" => "tm_link_color_hover",
						"collapse_sec"	=> "tb_mn",
						"std" => "#5bc98c",
						
						"type" => "color");	
						
$of_options[] = array(  "name" => "Top Menu Separator",
						"desc" 		=> "Enable/disable top menu separator.",
						"id" => "tm_separator",
						"collapse_sec"	=> "tb_mn",
						"std" => "1",
						
						"type" => "switch");							
						
$of_options[] = array(  "name" =>  "Top Menu Separator Color",
						"desc" => "",
						"id" => "tm_separator_color",
						"collapse_sec"	=> "tb_mn",
						"std" => "#f2f2f2",
						
						"type" => "color");	

$of_options[] = array(  "name" =>  "Sub Menu Link Color",
						"desc" => "",
						"id" => "tm_sub_menu_link",
						"std" => "#545454",
						"fold" => "en_top_bar",
						"collapse_sec"	=> "tb_mn",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Sub Menu Link Color on Hover",
						"desc" => "",
						"id" => "tm_sub_menu_link_hover",
						"std" => "#000000",
						"collapse_sec"	=> "tb_mn",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Sub Menu Link Background Color",
						"desc" => "",
						"id" => "tm_sub_menu_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "tb_mn",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Sub Menu Link Background Color on Hover",
						"desc" => "",
						"id" => "tm_sub_menu_bg_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "tb_mn",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Sub Menu Bottom Separator Color",
						"desc" => "",
						"id" => "tm_sm_separator_color",
						"std" => "#eeeeee",
						"collapse_sec"	=> "tb_mn",
						"type" => "color");

						/*
$of_options[] = array( 	"name" 		=> "Top Menu Separator Symbol",
						"desc" 		=> "Default is: |",
						"id" 		=> "tm_separator_symbol",
						"std" 		=> "|",
						"fold"		=> "en_top_bar",
						"type" 		=> "text"
				);																															
						*/
$of_options[] = array( 	"name" 		=> "Contact",
						"desc" 		=> "",
						"id" 		=> "tb_contact",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Contact Info</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,	
						//"fold"		=> "en_top_bar",
						"type" 		=> "info"
				);		
				
$of_options[] = array( 	"name" 		=> "Contact Email",
						"desc" 		=> "Enter your contact email.",
						"id" 		=> "contact_email",
						"std" 		=> "hello@yoursite.com",
						"collapse_sec"	=> "tb_contact",
						//"fold"		=> "en_top_bar",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Phone Number",
						"desc" 		=> "Enter your phone number.",
						"id" 		=> "contact_phone",
						"std" 		=> "+1 650-253-0000",
						//"fold"		=> "en_top_bar",
						"collapse_sec"	=> "tb_contact",
						"type" 		=> "text"
				);	

$of_options[] = array( 	"name" 		=> "Contact Address",
						"desc" 		=> "Enter your address.",
						"id" 		=> "contact_address",
						"std" 		=> "",
						//"fold"		=> "en_top_bar",
						"collapse_sec"	=> "tb_contact",
						"type" 		=> "text"
				);	
				
$of_options[] = array(  "name" => "Enable Tap to Call Button",
						"desc" 		=> "Enable/disable a tap to call button, on mobile devices with a resolution lower than 767px.",
						"id" => "en_tap_call",
						"std" => "0",
						//"fold"		=> "en_top_bar",
						"collapse_sec"	=> "tb_contact",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Tap to Call text on button",
						"desc" 		=> "Enter the text you want to appear on the button.",
						"id" 		=> "tap_call_text",
						"std" 		=> "Give us a Call Now!",
						"fold"		=> "en_tap_call",
						"collapse_sec"	=> "tb_contact",
						"type" 		=> "text"
				);																							

$of_options[] = array(  "name" =>  "Contact text Color",
						"desc" => "",
						"id" => "contact_text",
						"std" => "#999999",
						"collapse_sec"	=> "tb_contact",
						//"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Contact link Color",
						"desc" => "",
						"id" => "contact_link",
						"std" => "#999999",
						"collapse_sec"	=> "tb_contact",
						//"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Contact link Color on Hover",
						"desc" => "",
						"id" => "contact_link_hover",
						"std" => "#5bc98c",
						"collapse_sec"	=> "tb_contact",
						//"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Separator Color",
						"desc" => "",
						"id" => "top_bar_separator",
						"std" => "#999999",
						"collapse_sec"	=> "tb_contact",
						//"fold" => "en_top_bar",
						"type" => "color");	

$of_options[] = array(  "name" => "Separator Style",						
						"desc" => "Select the style of the separator",
						"id" => "top_bar_separator_style",
						"std" => "contactinfo",
						"collapse_sec"	=> "tb_contact",
						"type" => "select",
						"options" => array('dotted' => 'Dotted', 'solid' => 'Solid'));							

$of_options[] = array( 	"name" 		=> "Header Top",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Header General Settings",
						"desc" 		=> "",
						"id" 		=> "header_top",
						"std" 		=> "<h3>Header General Settings</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Sticky Header",
						"desc" 		=> "Enable/disable the Sticky Header.",
						"id" => "enable_sticky",
						"std" => "1",
						"collapse_sec"	=> "header_top",
						"type" => "switch");

$of_options[] = array(  "name" => "Header Resize on scroll",
						"desc" 		=> "Enable/disable Sticky Resize on user scroll.",
						"id" => "header_resize",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "header_top",
						"type" => "switch");

$of_options[] = array(  "name" => "Resize Factor (%)",
						"id" => "resize_factor",
						"std" 		=> "30",
						"min" 		=> "2",
						"step"		=> "1",
						"max" 		=> "90",
						"desc" 		=> "Select the resize factor in percent. Higher values will resize the header more.",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "header_top",
						"fold" => "header_resize" 
				);	

$of_options[] = array(  "name" => "Sticky Menu - Modern Header",
						"desc" 		=> "Enable/disable Sticky Menu for Modern Header only. Disable the Sticky Header option above.",
						"id" => "enable_sticky_menu_modern",
						"std" => "0",
						"collapse_sec"	=> "header_top",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Sticky Menu on Mobile",
						"desc" 		=> "Enable/disable the Sticky Menu on Mobile Devices.",
						"id" => "sticky_mobile_menu",
						"std" => "1",
						"collapse_sec"	=> "header_top",
						"type" => "switch");						
						
$of_options[] = array(  "name" => "Sticky Header Background Opacity (%)",
						"id" => "sticky_header_opacity",
						"std" 		=> "100",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "header_top",
						"desc" 		=> "Select the opacity of the Sticky Header Background in percent. A lower value will make the sticky header more transparent - select 0 to make the Sticky Header fully transparent.",
						"type" 		=> "sliderui" 
				);											
/*
$of_options[] = array( 	"name" 		=> "Header Section Position",
						"desc" 		=> "",
						"id" 		=> "header_pos2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Section Position</h3>Select the position of the header: Top, Left or Right",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "",
						"id" => "header_position",
						"std" => "Top",
						"type" => "select",
						"options" => array("top" => "Top", "left" => "Left", "right" => "Right"));				
*/
					
$of_options[] = array( 	"name" 		=> "Header Styling",
						"desc" 		=> "",
						"id" 		=> "header_styling",
						"std" 		=> "<h3>Header Styling</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Header Style",
						"desc" 		=> "Select the style that will be used for the Header area.",
						"id" => "header_style",
						"std" => "Default",
						"type" => "select",
						"collapse_sec"	=> "header_styling",
						"options" => array("style1" => "Normal","style2" => "Modern", "business" => "Business"));	
/*
$of_options[] = array( 	"name" 		=> "Header W",
						"desc" 		=> "",
						"id" 		=> "header_w",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Width</h3>Select the width of your header",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
*/				
$of_options[] = array(  "name" => "Header Width",
						"id" => "header_width",
						"desc" 		=> "Select the width of the Header Area.",
						"std" => "Default",
						"type" => "select",
						"collapse_sec"	=> "header_styling",
						"options" => array("normal" => "Normal","expanded" => "Expanded"));																											
/*
$of_options[] = array( 	"name" 		=> "Header Pos",
						"desc" 		=> "",
						"id" 		=> "header_pos",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Elements Positioning</h3>Select how the header logo and menu will be displayed: normal or centered!",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
*/				
$of_options[] = array(  "name" => "Header Elements Positioning",
						"id" => "header_el_pos",
						"std" => "normal",
						"desc" => "Select how the header logo and menu will be displayed: normal or centered!",
						"type" => "select",
						"collapse_sec"	=> "header_styling",
						"options" => array("normal" => "Normal","center" => "Centered", "left" => "Left"));	

$of_options[] = array(  "name" => "Modern Header Style Elements Positioning",
						"id" => "header_modern_el_pos",
						"std" => "default",
						"desc" => "For the Modern Header we can choose the positioning of the elements in the navigation area",
						"type" => "select",
						"collapse_sec"	=> "header_styling",
						"options" => array("default" => "Default","left" => "Left"));													
				
$of_options[] = array( 	"name" 		=> "Transparent Header Options",
						"desc" 		=> "",
						"id" 		=> "header_trans",
						"std" 		=> "<h3>Transparent Header Options</h3>",						
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Transparent Header",
						"desc" 		=> "Enable/disable Transparent Header.",
						"id" => "en_transparent_header",
						"std" => "0",
						"folds" => "1",
						"collapse_sec"	=> "header_trans",
						"type" => "switch");

$of_options[] = array(  "name" => "Use Transparent Header on Posts",
						"desc" => "Check this option to enable Transparent Header on all Posts.",
						"id" => "transparent_header_posts",
						"std" => 0,
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" => "checkbox");

$of_options[] = array(  "name" => "Use Transparent Header on Pages",
						"desc" => "Check this option to enable Transparent Header on all Pages.",
						"id" => "transparent_header_pages",
						"std" => 0,
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" => "checkbox");

$of_options[] = array(  "name" =>  "Transparent Header Menu Color",
						"desc" => "Select a custom color for the main items of the Header Menu - this will overide the Header Menu -> Header Menu Text Color setting",
						"id" => "transparent_header_color",
						"std" => "",
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Transparent Header Border Color",
						"desc" => "Select a custom color for the Header Bottom Border and Header Bussins Icons Border, when the Transparent Header is being used.",
						"id" => "transparent_header_border_color",
						"std" => "",
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" => "color");	

$of_options[] = array(  "name" => "Transparent Header Border Opacity",
						"id" => "transparent_header_border_opacity",
						"desc" 		=> "Enter the opacity for the Header Border and Header Business Icons border.",
						"std" 		=> "85",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Transparent Header Custom SubMenu",
						"desc" 		=> "Select Yes to use custom styling options for the SubMenus when the Transparent Header is turned on.",
						"id" => "en_transparent_header_submenu",
						"fold" => "en_transparent_header",
						"std" => "no",
						"type" => "select",
						"collapse_sec"	=> "header_trans",
						"options" => array( "no" => "No","yes" => "Yes" ));	
/*
$of_options[] = array(  "name" => "Transparent Header Custom SubMenu",
						"desc" 		=> "Enable/disable the use of Custom Colors for SubMenu items when the Transparent Header is turned on.",
						"id" => "en_transparent_header_submenu",
						"std" => "0",
						"folds" => "1",
						"fold" => "en_transparent_header",
						"type" => "switch");
*/
$of_options[] = array(  "name" =>  "Transparent Header SubMenu Color",
						"desc" => "Select a custom color for the SubMenu items of the Header Menu - this will overide the Header Menu -> Header SubMenu Items Text Color setting",
						"id" => "transparent_header_sm_color",
						"std" => "",
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Transparent Header SubMenu Background Color",
						"desc" => "Select a custom color for the background of the SubMenu.",
						"id" => "transparent_header_sm_bg",
						"std" => "",
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" => "color");	

$of_options[] = array(  "name" => "Transparent Header SubMenu Background Opacity",
						"id" => "transparent_header_sm_bg_opac",
						"desc" 		=> "Enter the opacity for the Header SubMenu Background.",
						"std" 		=> "85",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"fold" => "en_transparent_header",
						"collapse_sec"	=> "header_trans",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "Header Customization",
						"desc" 		=> "",
						"id" 		=> "header_custom",
						"std" 		=> "<h3>Header Customization</h3>",						
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Header Search Icon",
						"desc" 		=> "Enable/disable header search icon.",
						"id" => "header_search_icon",
						"std" => "1",
						"collapse_sec"	=> "header_custom",
						"type" => "switch");	

$of_options[] = array(  "name" => "Header Social Icons",
						"desc" 		=> "Force Social Icons to appear in the header area",
						"id" => "header_social_icons",
						"std" => "0",
						"collapse_sec"	=> "header_custom",
						"type" => "switch");	
																																				
				
$of_options[] = array(  "name" => "Header Bottom Shadow",
						"desc" 		=> "Enable/disable header bottom shadow.",
						"id" => "header_bottom_shadow",
						"std" => "1",
						"collapse_sec"	=> "header_custom",
						"type" => "switch");

$of_options[] = array(  "name" => "Header Bottom Shadow on Scroll",
						"desc" 		=> "Enable/disable header bottom shadow only when Sticky Header is turned on and only on scroll.",
						"id" => "header_bottom_shadow_scroll",
						"std" => "0",
						"collapse_sec"	=> "header_custom",
						"type" => "switch");								

$of_options[] = array(  "name" => "Header Bottom Border",
						"id" => "header_bottom_border",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "10",
						"desc" 		=> "Select the width in pixels for the bottom border of the header area",
						"collapse_sec"	=> "header_custom",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" =>  "Header Bottom Border Color",
						"desc" => "",
						"id" => "header_bottom_border_color",
						"std" => "#f2f2f2",
						"collapse_sec"	=> "header_custom",
						"type" => "color");	

$of_options[] = array(  "name" => "Header Business Icons Border",
						"id" => "business_header_sep",
						"std" 		=> "1",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "10",
						"desc" 		=> "When using the Header Business option you can add a border between the Navigation elements and the Shop Icon, Search Icon and Off Canvas Icon. Drag the slider to 0 to not use any border.",
						"collapse_sec"	=> "header_custom",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" =>  "Header Business Icons Border Color",
						"desc" => "",
						"id" => "business_header_sep_color",
						"std" => "#f2f2f2",
						"collapse_sec"	=> "header_custom",
						"type" => "color");	
																									
				
$of_options[] = array(  "name" => "Use Patterns",
						"desc" 		=> "Enable/disable patterns.",
						"id" => "en_header_pattern",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "header_custom",
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Background Pattern",
						"desc" 		=> "Select a background pattern for the header.",
						"id" 		=> "header_patterns",
						"std" 		=> $bg_images_url."pattern10.png",
						"type" 		=> "tiles",
						"collapse_sec"	=> "header_custom",
						"fold" 		=> "en_header_pattern",
						"options" 	=> array(
						"pattern1" => get_template_directory_uri()."/images/pattern/pattern1.png",
						"pattern2" => get_template_directory_uri()."/images/pattern/pattern2.png",
						"pattern3" => get_template_directory_uri()."/images/pattern/pattern3.png",
						"pattern4" => get_template_directory_uri()."/images/pattern/pattern4.png",
						"pattern5" => get_template_directory_uri()."/images/pattern/pattern5.png",
						"pattern6" => get_template_directory_uri()."/images/pattern/pattern6.png",
						"pattern7" => get_template_directory_uri()."/images/pattern/pattern7.png",
						"pattern8" => get_template_directory_uri()."/images/pattern/pattern8.png",
						"pattern9" => get_template_directory_uri()."/images/pattern/pattern9.png",
						"pattern10" => get_template_directory_uri()."/images/pattern/pattern10.png",
						"pattern11" => get_template_directory_uri()."/images/pattern/pattern11.png",
						"pattern12" => get_template_directory_uri()."/images/pattern/pattern12.png",
						"pattern13" => get_template_directory_uri()."/images/pattern/pattern13.png",
						"pattern14" => get_template_directory_uri()."/images/pattern/pattern14.png",
						"pattern15" => get_template_directory_uri()."/images/pattern/pattern15.png",
						"pattern16" => get_template_directory_uri()."/images/pattern/pattern16.png",
						"pattern17" => get_template_directory_uri()."/images/pattern/pattern17.png",
						"pattern18" => get_template_directory_uri()."/images/pattern/pattern18.png",
						"pattern19" => get_template_directory_uri()."/images/pattern/pattern19.png",
						"pattern20" => get_template_directory_uri()."/images/pattern/pattern20.png",
						"pattern21" => get_template_directory_uri()."/images/pattern/pattern21.png",
						"pattern22" => get_template_directory_uri()."/images/pattern/pattern22.png",
						"pattern23" => get_template_directory_uri()."/images/pattern/pattern23.png",
						"pattern24" => get_template_directory_uri()."/images/pattern/pattern24.png",
						"pattern25" => get_template_directory_uri()."/images/pattern/pattern25.png",
					));
					
				
				
$of_options[] = array(  "name" =>  "Header Background Color",
						"desc" => "",
						"id" => "header_bg_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "header_custom",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Header Custom Background",
						"desc" 		=> "Upload an image or new pattern for the background of the header.",
						"id" 		=> "header_bg_image",						
						"std" 		=> "",
						"collapse_sec"	=> "header_custom",
						"type" 		=> "upload"
				);					
$of_options[] = array(  "name" => "Header Custom Background Repeat",
						"id" => "header_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"collapse_sec"	=> "header_custom",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat"));	

$of_options[] = array( 	"name" 		=> "Header Call to Action",
						"desc" 		=> "",
						"id" 		=> "header_action",
						"std" 		=> "<h3>Header Call to Action</h3>",						
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Header Call to Action Button",
						"desc" 		=> "Ads a Call to Action Button to the right of the Header area",
						"id" => "header_extra_button",
						"std" => "0",
						"folds" => "1",
						"collapse_sec"	=> "header_action",
						"type" => "switch");

$of_options[] = array(  "name" => "Header CTA Button Text",
						"desc" => "Set the text for the CTA button",
						"id" => "header_cta_text",
						"std" => "BOOK A CLASS",
						"fold" => "header_extra_button",
						"collapse_sec"	=> "header_action",
						"type" => "text");

$of_options[] = array(  "name" => "Header CTA Link",
						"desc" => "Set the link for the CTA button. Include the http:// or https:// protocol as well.",
						"id" => "header_cta_link",
						"std" => "",
						"fold" => "header_extra_button",
						"collapse_sec"	=> "header_action",
						"type" => "text");

$of_options[] = array(  "name" => "Header CTA Link Target",
						"desc" 		=> "Choose the target of the link. Same window or new window.",
						"id" => "header_cta_link_target",
						"fold" => "header_extra_button",
						"std" => "_self",
						"collapse_sec"	=> "header_action",
						"type" => "select",
						"options" => array( "_self" => "Same Window","_blank" => "New Window" ));	

$of_options[] = array(  "name" =>  "Header CTA Background Color",
						"desc" => "Set the background color for the CTA button",
						"id" => "header_cta_bg",
						"std" => "#d03672",
						"fold" => "header_extra_button",
						"collapse_sec"	=> "header_action",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Header CTA Text Color",
						"desc" => "Set the text color for the CTA button",
						"id" => "header_cta_color",
						"std" => "#ffffff",
						"fold" => "header_extra_button",
						"collapse_sec"	=> "header_action",
						"type" => "color");	

$of_options[] = array(  "name" => "Header CTA Font Weight",
						"id" => "header_cta_fw",
						"desc" => "Select the font weight for the CTA button.",
						"std" => "500",
						"fold" => "header_extra_button",
						"type" => "select",
						"collapse_sec"	=> "header_action",
						"options" => array(300,400,500,600,700));	

$of_options[] = array( 	"name" 		=> "Header CTA Font Size (px)",
						"desc" => "Default is 11",
						"id" => "header_cta_fs",
						"std" 		=> "11",
						"min" 		=> "10",
						"fold" => "header_extra_button",
						"step"		=> "1",
						"max" 		=> "30",
						"collapse_sec"	=> "header_action",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "Header Menu",
						"desc" 		=> "",
						"id" 		=> "header_menu",
						"std" 		=> "<h3>Header Menu</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
/*				
$of_options[] = array(  "name" => "Header Menu Style",
						"id" => "header_menu_style",
						"std" => "new-style",
						"type" => "select",
						"options" => array("old-style" => "Old Style","new-style" => "New Style"));				
*/

$of_options[] = array(  "name" => "Header SubMenu Width",
						"desc" 		=> "Enter the width of the submenu items in pixels. Default: 165px",
						"id" => "sub_menu_width",
						"std" => "165px",
						"collapse_sec"	=> "header_menu",
						"type" => "text");						

$of_options[] = array(  "name" => "Header Menu Margin Top",
						"desc" 		=> "Use this option to add a top margin to the navigation. Useful if you want your logo to be vertically centered when using the Default Header.<br> E.g: 30px",
						"id" => "vertical_nav",
						"std" => "",
						"collapse_sec"	=> "header_menu",
						"type" => "text");

$of_options[] = array(  "name" => "Header Menu Line Height",
						"id" => "main_menu_line_height",
						"desc" 		=> "Enter the line height in pixels for the Header Menu Main items",
						"std" 		=> "85",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "200",
						"collapse_sec"	=> "header_menu",
						"type" 		=> "sliderui" 
				);
										
								
$of_options[] = array(  "name" => "Header Menu Uppercase",
						"desc" 		=> "Force uppercase text for the Header Menu.",
						"id" => "force_uppercase",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "header_menu",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Header Menu - SubMenu Indicator",
						"desc" 		=> "Enable/disable the SubMenu Indicator (the + sign)",
						"id" => "submenu_indicator",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "header_menu",
						"type" => "switch");										
/*						
$of_options[] = array(  "name" => "Header Menu Position",
						"desc" 		=> "Select the position of the header menu.",
						"id" => "menu_float",
						"std" => "right",
						"type" => "select",
						"options" => array("left","right"));	
*/	

$of_options[] = array(  "name" => "Header Menu Item Spacing",
						"desc" => "Enter the spacing for the Main Menu items.",
						"id" => "menu_item_space",
						"std" => "18",
						"min" => "10",
						"step" => "1",
						"max" => "50",
						"collapse_sec"	=> "header_menu",
						"type" => "sliderui");			

$of_options[] = array(  "name" => "Header Menu Text Color",
						"desc" 		=> "Select the color of the header text menu.",
						"id" => "menu_color",
						"std" => "#21252b",
						"collapse_sec"	=> "header_menu",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Header Menu Text Color on Hover",
						"desc" 		=> "Select the color of the header text menu on hover.",
						"id" => "menu_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "header_menu",
						"type" => "color");		
					
$of_options[] = array(  "name" => "Header Menu Background Color on Hover",
						"desc" 		=> "Select the background color of the header text menu on hover.",
						"id" => "menu_color_bg_hover",
						"std" => "#5bc98c",
						"collapse_sec"	=> "header_menu",
						"type" => "color");

$of_options[] = array(  "name" => "Header Menu Items Have Border",
						"desc" 		=> "Enable/disable a border effec for Main Menu items",
						"id" => "menu_border_en",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "header_menu",
						"type" => "switch");								

$of_options[] = array(  "name" => "Header Menu Items Border Width",
						"id" => "menu_border_width",
						"desc" 		=> "Use the slider to specify the thickness of the Main Menu Items",
						"std" 		=> "3",
						"fold"		=> "menu_border_en",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "5",
						"collapse_sec"	=> "header_menu",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Header Menu Items Border Color",
						"desc" 		=> "Select the color for the Main Menu Items border.",
						"id" => "head_menu_border_color",
						"fold"		=> "menu_border_en",
						"std" => "#333333",
						"collapse_sec"	=> "header_menu",
						"type" => "color");

$of_options[] = array(  "name" => "Header Menu Items Border Location",
						"desc" 		=> "Select the location of the border effect.",
						"id" => "menu_border_loc",
						"fold"		=> "menu_border_en",
						"std" => "Above",
						"type" => "select",
						"collapse_sec"	=> "header_menu",
						"options" => array("above" => "Above","below" => "Below"));
/*					
$of_options[] = array(  "name" => "Header Menu Background Color Force Transparency",
						"desc" 		=> "Enable this option to make the header menu background transparent.",
						"id" => "menu_color_bg_transparent",
						"std" => "0",
						"folds" => 0,
						"type" => "switch");												
*/

$of_options[] = array(  "name" => "Header SubMenu Top Border Color",
						"desc" 		=> "Select the top border color of the submenu.",
						"id" => "submenu_border_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "header_menu",
						"type" => "color");	

$of_options[] = array(  "name" => "Header SubMenu Top Border Thickness",
						"id" => "submenu_border_thick",
						"desc" 		=> "Use the slider to specify the thickness of the SubMenu Border",
						"std" 		=> "3",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "5",
						"collapse_sec"	=> "header_menu",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Force SubMenu Border",
						"desc" 		=> "Enable this option to add a border over the entire SubMenu area. The thickness and color will be inherited from the options above",
						"id" => "force_submenu_border",
						"std" => "0",		
						"collapse_sec"	=> "header_menu",				
						"type" => "switch");

$of_options[] = array(  "name" => "Header SubMenu Shadow effect",
						"desc" 		=> "Enable/disable shadow effect for SubMenus",
						"id" => "submenu_shadow",
						"std" => "1",
						"collapse_sec"	=> "header_menu",					
						"type" => "switch");

$of_options[] = array(  "name" => "Header SubMenu Top/Bottom Padding",
						"id" => "submenu_padding_tb",
						"desc" 		=> "Use the slider to specify a padding top/bottom",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "50",
						"collapse_sec"	=> "header_menu",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Header SubMenu Items Left/Right Padding",
						"id" => "submenu_items_padding_lr",
						"desc" 		=> "Use the slider to specify a left/right padding for SubMenu Items",
						"std" 		=> "18",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "50",
						"collapse_sec"	=> "header_menu",
						"type" 		=> "sliderui" 
				);													
						
$of_options[] = array(  "name" => "Header SubMenu Items Text Color",
						"desc" 		=> "Select the text color of the submenu items.",
						"id" => "submenu_color",
						"std" => "#666666",
						"collapse_sec"	=> "header_menu",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Header SubMenu Items Text Color on Hover",
						"desc" 		=> "Select the text color of the submenu items on hover.",
						"id" => "submenu_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "header_menu",
						"type" => "color");
						
$of_options[] = array(  "name" => "Header SubMenu Items Background Color",
						"desc" 		=> "Select the background color of the submenu items text.",
						"id" => "submenu_bg_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "header_menu",
						"type" => "color");
						
$of_options[] = array(  "name" => "Header SubMenu Items Background Color on Hover",
						"desc" 		=> "Select the background color of the submenu items text, on hover.",
						"id" => "submenu_bg_color_hover",
						"std" => "#5bc98c",
						"collapse_sec"	=> "header_menu",
						"type" => "color");	



$of_options[] = array(  "name" => "Header SubMenu Items Separator",
						"desc" 		=> "Enable/disable SubMenu Item separator",
						"id" => "submenu_separator_enable",
						"std" => "1",			
						"collapse_sec"	=> "header_menu",			
						"type" => "switch");											
																				
$of_options[] = array(  "name" => "Header SubMenu Items Separator Color",
						"desc" 		=> "Select the color of the submenu items separator.",
						"id" => "submenu_separator",
						"std" => "#f4f4f4",
						"collapse_sec"	=> "header_menu",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Modern Header Styling",
						"desc" 		=> "",
						"id" 		=> "modern_header_style",
						"std" 		=> "<h3>Modern Header Styling</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,						
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Modern Header Menu Background Color",
						"desc" 		=> "Choose a background color of the Modern Header Menu",
						"id" => "menu_bg_color_full",
						"std" => "#000000",
						"collapse_sec"	=> "modern_header_style",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Modern Header Menu Border Color",
						"desc" 		=> "Choose a border color for the Modern Header Menu. ",
						"id" => "menu_border_color",
						"std" => "#444444",
						"collapse_sec"	=> "modern_header_style",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Modern Header HTML Code ",
						"desc" 		=> "Paste here your html code for the right side of the Modern header area. You can add javascripts codes to output the banners you want or plain HTML.",
						"id" 		=> "header_banner",
						"std" 		=> "",
						"collapse_sec"	=> "modern_header_style",
						"type" 		=> "textarea"
				);	

$of_options[] = array(  "name" => "Force Social Icons with Logo Inline",
						"desc" 		=> "Enable/disable the placement of Social Media profiles to the right of the Logo.",
						"id" => "modern_social_icons",
						"std" => "0",	
						"folds" => "1",
						"collapse_sec"	=> "modern_header_style",
						"type" => "switch");

$of_options[] = array(  "name" => "Social Icons Margin Top",
						"id" => "modern_si_margin_top",
						"desc" 		=> "Set a top margin for the Social Icons. Useful for positiong the icons vertically.",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "modern_header_style",
						"fold"		=> "modern_social_icons"
				);

$of_options[] = array(  "name" => "Social Icons Color",
						"desc" 		=> "Select the color of the Social Icons.",
						"id" => "modern_si_color",
						"std" => "#333333",
						"fold"		=> "modern_social_icons",
						"collapse_sec"	=> "modern_header_style",
						"type" => "color");

$of_options[] = array(  "name" => "Social Icons Background Color",
						"desc" 		=> "Optionally a background color can be set for the Social Icons. Leave blank for no background color.",
						"id" => "modern_si_bg_color",
						"std" => "",
						"fold"		=> "modern_social_icons",
						"collapse_sec"	=> "modern_header_style",
						"type" => "color");	

$of_options[] = array(  "name" => "Social Icons Shape",
						"desc" 		=> "Select the style of the Social Icons - only works if a background color is set above",
						"id" => "modern_si_shape",
						"std" => "Square",
						"type" => "select",
						"fold"		=> "modern_social_icons",
						"collapse_sec"	=> "modern_header_style",
						"options" => array("square" => "Square","rounded" => "Rounded", "circle" => "Circle"));


$of_options[] = array(  "name" => "Modern Header Call to Action",
						"desc" 		=> "Enable/disable a Call to Action area on the right of the Modern Header",
						"id" => "modern_cta",
						"std" => "0",	
						"folds" => "1",
						"collapse_sec"	=> "modern_header_style",
						"type" => "switch");

$of_options[] = array(  "name" => "Modern Header CTA Margin Top",
						"id" => "modern_cta_margin_top",
						"desc" 		=> "Set a top margin for the Call to Action",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "modern_header_style",
						"fold"		=> "modern_cta"
				);

$of_options[] = array(  "name" => "CTA Heading Text",
						"desc" 		=> "Add here the Heading Text",
						"id" => "modern_cta_head_text",
						"std" => "Call us 24/24 in any working day",
						"fold"		=> "modern_cta",
						"collapse_sec"	=> "modern_header_style",
						"type" => "text");	

$of_options[] = array(  "name" => "CTA Heading Phone Number",
						"desc" 		=> "Add here the Phone Number",
						"id" => "modern_cta_phone",
						"std" => "0800 304 2094",
						"fold"		=> "modern_cta",
						"collapse_sec"	=> "modern_header_style",
						"type" => "text");	

$of_options[] = array( 	"name" 		=> "CTA Heading Text Custom CSS",
						"desc" 		=> "Add custom css rules for the CTA Heading Text. E.g: font-size: 12px; line-height: normal;",
						"id" 		=> "modern_cta_ht_css",
						"std" 		=> "",
						"fold"		=> "modern_cta",
						"collapse_sec"	=> "modern_header_style",
						"type" 		=> "textarea"
				);	

$of_options[] = array( 	"name" 		=> "CTA Phone Number Custom CSS",
						"desc" 		=> "Add custom css rules for the CTA Phone Number. E.g: font-size: 12px; line-height: normal;",
						"id" 		=> "modern_cta_pn_css",
						"std" 		=> "",
						"fold"		=> "modern_cta",
						"collapse_sec"	=> "modern_header_style",
						"type" 		=> "textarea"
				);	

$of_options[] = array(  "name" => "CTA Separator",
						"desc" 		=> "Enable/disable a separator to the left of the CTA. Useful if the Social Icons are also set to appear to the left of the CTA.",
						"id" => "modern_cta_sep",
						"std" => "0",	
						"fold" => "modern_cta",
						"collapse_sec"	=> "modern_header_style",
						"type" => "switch");

$of_options[] = array(  "name" => "CTA Separator color",
						"desc" 		=> "Select the color of the separator.",
						"id" => "modern_cta_sep_color",
						"std" => "#dddddd",
						"collapse_sec"	=> "modern_header_style",
						"type" => "color");	


$of_options[] = array( 	"name" 		=> "MegaMenu",
						"desc" 		=> "",
						"id" 		=> "mega_menu",
						"std" 		=> "<h3 >MegaMenu Styling</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Column Title Text/Link Color",
						"desc" 		=> "Select the text color of the column title.",
						"id" => "mm_column_title",
						"std" => "#444444",
						"collapse_sec"	=> "mega_menu",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Column Title Link Color on Hover",
						"desc" 		=> "Select the link color on hover of the column title.",
						"id" => "mm_column_title_hover",
						"std" => "#5bc98c",
						"collapse_sec"	=> "mega_menu",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Column Title Font Size",
						"id" => "mm_column_title_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "mega_menu",
						"type" 		=> "sliderui" 
				);		
				
$of_options[] = array(  "name" => "Column Title Font Weight",
						"id" => "mm_column_title_font_weight",
						"std" => "normal",
						"type" => "select",
						"collapse_sec"	=> "mega_menu",
						"options" => array("normal","300","400","500","600","700"));	
						
				
$of_options[] = array(  "name" => "MegaMenu Links Color",
						"id" => "mm_links_color",
						"desc" 		=> "Select the link color of the MegaMenu sub-menu items.",
						"std" => "#ffffff",
						"collapse_sec"	=> "mega_menu",
						"type" => "color");	

$of_options[] = array(  "name" => "MegaMenu Links Color on Hover",
						"id" => "mm_links_color_hover",
						"desc" 		=> "Select the link color on hover of the MegaMenu sub-menu items.",
						"std" => "#5bc98c",
						"collapse_sec"	=> "mega_menu",
						"type" => "color");																													
																																										

$of_options[] = array( 	"name" 		=> "Header Padding &amp; Margins",
						"desc" 		=> "",
						"id" 		=> "header_padd_mar",
						"std" 		=> "<h3>Header Padding &amp; Margins</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
						
$of_options[] = array(  "name" => "Header Bottom Margin (px)",
						"id" => "header_bottom_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"collapse_sec"	=> "header_padd_mar",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Top Margin (px)",
						"id" => "header_top_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"collapse_sec"	=> "header_padd_mar",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Top Padding (px)",
						"id" => "header_top_padding",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"collapse_sec"	=> "header_padd_mar",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Bottom Padding (px)",
						"id" => "header_bottom_padding",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"collapse_sec"	=> "header_padd_mar",
						"type" 		=> "sliderui" 
				);				
																									
$of_options[] = array( 	"name" 		=> "Header Left Right",
						"type" 		=> "heading"
				);	

$of_options[] = array( 	"name" 		=> "head_lr",
						"desc" 		=> "",
						"id" 		=> "header_lr_s",
						"std" 		=> "<h3>Header Left Right Settings</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Elements Positioning",
						"desc" 		=> "Drag and Drop elements to assign them in the correct order. Drag elements in the Disabled area to not show them.",
						"id" 		=> "side_blocks",
						"std" 		=> $of_options_homepage_blocks,
						"collapse_sec"	=> "header_lr_s",
						"type" 		=> "sorter"
				);

$of_options[] = array(  "name" => "Center Elements",
						"desc" 		=> "Enable this option if you want to center all elements in the header",
						"id" => "hlr_centered",
						"std" => "0",	
						"collapse_sec"	=> "header_lr_s",					
						"type" => "switch");																																																									
				
$of_options[] = array( 	"name" 		=> "Header Area Width (px)",
						"desc" 		=> "Enter the header width in pixels. Default: 300px",
						"id" 		=> "hlr_width",
						"std" 		=> "300px",
						"collapse_sec"	=> "header_lr_s",
						"type" 		=> "text"
				);	
				
$of_options[] = array(  "name" => "Header Area Background Color",
						"desc" 		=> "Select the background color for left/right header area.",
						"id" => "hlr_bg_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "header_lr_s",
						"type" => "color");	
						
$of_options[] = array( 	"name" 		=> "Header Area Background Image",
						"desc" 		=> "Upload an image for the background of the header left/right area.",
						"id" 		=> "hlr_bg_img",						
						"std" 		=> "",
						"collapse_sec"	=> "header_lr_s",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Background Image Repeat",
						"id" => "hlr_bg_img_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"collapse_sec"	=> "header_lr_s",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat"));	
						
$of_options[] = array( 	"name" 		=> "Background Image Position X",
						"desc" 		=> "You can custom position the background by entering pixel or percent values. E.g: -50px <br> Enter: 50% if you want your background to be centered horizontally.",
						"id" 		=> "hlr_bg_img_x",
						"std" 		=> "",
						"collapse_sec"	=> "header_lr_s",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Background Image Position Y",
						"desc" 		=> "You can custom position the background horizontally, by entering pixel or percent values. E.g: -50px <br> Enter: 50% if you want your background to be centered vertically.",
						"id" 		=> "hlr_bg_img_y",
						"std" 		=> "",
						"collapse_sec"	=> "header_lr_s",
						"type" 		=> "text"
				);																					
				
$of_options[] = array(  "name" => "Fullscreen Background",
						"desc" 		=> "Enable/disable fullscreen background for the header left/right area.",
						"id" => "hlr_bg_fullscreen",
						"std" => "0",
						"collapse_sec"	=> "header_lr_s",				
						"type" => "switch");
						
$of_options[] = array(  "name" => "Header Shadow Effect",
						"desc" 		=> "Enable/disable shadow effect for the left/right header area.",
						"id" => "hlr_shadow_en",
						"std" => "1",		
						"collapse_sec"	=> "header_lr_s",				
						"type" => "switch");							
														
$of_options[] = array(  "name" => "Header Border Width ",
						"id" => "hlr_border_width",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "20",
						"desc" 		=> "Select the width of the border for the header left/right area.",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "header_lr_s",
				);
				
$of_options[] = array(  "name" => "Header Area Border Color",
						"desc" 		=> "Select the border color for left/right header area. Will only work if the Header Border Width is greater than 0.",
						"id" => "hlr_border_color",
						"std" => "#eeeeee",
						"collapse_sec"	=> "header_lr_s",
						"type" => "color");	
						
$of_options[] = array( 	"name" 		=> "Soc Links",
						"desc" 		=> "",
						"id" 		=> "hlr_sl",
						"std" 		=> "<h3>Social Icons</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Social Icons Background Color",
						"desc" 		=> "Select the background color for the Social Icon. Leave blank if you want the social links to use a transparent background.",
						"id" => "hlr_si_bg",
						"std" => "",
						"collapse_sec"	=> "hlr_sl",
						"type" => "color");

$of_options[] = array(  "name" => "Social Icons Background Color on Hover",
						"desc" 		=> "Select the background color on hover for the Social Icon.",
						"id" => "hlr_si_bg_hover",
						"std" => "",
						"collapse_sec"	=> "hlr_sl",
						"type" => "color");									
						
$of_options[] = array(  "name" => "Social Icons Color",
						"desc" 		=> "Select the color for the Social Icon. ",
						"id" => "hlr_si_color",
						"std" => "#5e5e5e",
						"collapse_sec"	=> "hlr_sl",
						"type" => "color");														
						
$of_options[] = array( 	"name" 		=> "Menu Options",
						"desc" 		=> "",
						"id" 		=> "hlr_mt",
						"std" 		=> "<h3>Menu Typography</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Menu Font Family",
						"desc" => "Select a font family for menus.",
						"id" => "hlr_font_family",
						"std" => "Open Sans",
						"type" => "select_google_font",
						"preview" => array(
									"text" => "This is a preview for the Menu", 
									"size" => "13px"
						),
						"collapse_sec"	=> "hlr_mt",
						"options" => $google_fonts);				
						
$of_options[] = array( 	"name" 		=> "Main Menu Font Size (px)",
						"desc" 		=> "Enter the font size for the Main Menu, in pixels. Default: 14px.",
						"id" 		=> "hlr_mm_font_size",
						"std" 		=> "14px",
						"collapse_sec"	=> "hlr_mt",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "SubMenu Font Size (px)",
						"desc" 		=> "Enter the font size for the SubMenu, in pixels. Default: 12px.",
						"id" 		=> "hlr_cm_font_size",
						"std" 		=> "12px",
						"collapse_sec"	=> "hlr_mt",
						"type" 		=> "text"
				);	
				
$of_options[] = array(  "name" => "Header Menu Font Weight - First Level only",
						"id" => "hlr_menu_font_weight",
						"std" => "500",
						"type" => "select",
						"collapse_sec"	=> "hlr_mt",
						"options" => array(300,400,500, 600,700,800,900));																
				
$of_options[] = array( 	"name" 		=> "Main Menu Options",
						"desc" 		=> "",
						"id" 		=> "hlr_mmo",
						"std" 		=> "<h3>Main Menu Options</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Main Menu Text Align",
						"id" => "hlr_mm_text_align",
						"std" => "Left",
						"type" => "select",
						"collapse_sec"	=> "hlr_mmo",
						"options" => array("left" => "Left", "Center" => "Center", "right" => "Right"));
										
				
$of_options[] = array(  "name" => "Main Menu Items left/right Border Width (px)",
						"id" => "hlr_menu_border_width",
						"std" 		=> "3",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "20",
						"desc" 		=> "Select the width of the left/right border for the menu items. Default 3px.",
						"collapse_sec"	=> "hlr_mmo",
						"type" 		=> "sliderui" 
				);		
				
$of_options[] = array(  "name" => "Main Menu Border Color",
						"desc" 		=> "Select the border color for the main menu items.",
						"id" => "hlr_menu_border_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "hlr_mmo",
						"type" => "color");								

$of_options[] = array( 	"name" 		=> "Header SubMenu Width (px)",
						"desc" 		=> "Enter the width of the submenu items in pixels. Default: 220px",
						"id" 		=> "hlr_sub_width",
						"std" 		=> "220px",
						"collapse_sec"	=> "hlr_mmo",
						"type" 		=> "text"
				);	
				
$of_options[] = array(  "name" => "Menus Item Separator Thickness",
						"desc" 		=> "Select the thickness for the line separtor of the menu items. Choose 0 if you want to disable it",
						"id" => "hlr_menu_separator_thickness",
						"std" 		=> "1",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "10",
						"collapse_sec"	=> "hlr_mmo",
						"type" 		=> "sliderui" 
				);				
				
$of_options[] = array(  "name" => "Menus Item Separator Color",
						"desc" 		=> "Select the color for the line separtor of the menu items.",
						"id" => "hlr_menu_separator_color",
						"std" => "#e8ebed",
						"collapse_sec"	=> "hlr_mmo",
						"type" => "color");							
						
$of_options[] = array(  "name" => "Main Menu Item Text Color",
						"desc" 		=> "Select the text color for the main menu items.",
						"id" => "hlr_menu_text_color",
						"std" => "#767676",
						"collapse_sec"	=> "hlr_mmo",
						"type" => "color");	

$of_options[] = array(  "name" => "Main Menu Item Background Color",
						"desc" 		=> "Select the background color for the main menu items. Leave blank to not use any background color.",
						"id" => "hlr_menu_bg_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "hlr_mmo",
						"type" => "color");	

$of_options[] = array(  "name" => "Main Menu Item Text Color on Hover",
						"desc" 		=> "Select the text color on hover for the main menu items.",
						"id" => "hlr_menu_text_color_hover",
						"std" => "#5b5b5b",
						"collapse_sec"	=> "hlr_mmo",
						"type" => "color");
						
$of_options[] = array(  "name" => "Main Menu Item Background Color on Hover",
						"desc" 		=> "Select the background color on hover for the main menu items. Leave blank to not use any background color.",
						"id" => "hlr_menu_bg_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "hlr_mmo",
						"type" => "color");																																		

$of_options[] = array( 	"name" 		=> "SubMenu Options",
						"desc" 		=> "",
						"id" 		=> "hlr_cm",
						"std" 		=> "<h3>SubMenu Options</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "SubMenus Text Align",
						"id" => "hlr_cm_text_align",
						"std" => "Left",
						"type" => "select",
						"collapse_sec"	=> "hlr_cm",
						"options" => array("left" => "Left", "Center" => "Center", "right" => "Right"));				
				
$of_options[] = array(  "name" => "SubMenu Items Indicator",
						"desc" 		=> "Enable/disable the sub menu indicator - this will add a small icon that will indicate the presence of SubMenus items.",
						"id" => "hlr_child_menu_indicator",
						"std" => "1",
						"collapse_sec"	=> "hlr_cm",
						"type" => "switch"
					);					
						
$of_options[] = array(  "name" => "SubMenu Items Border Width (px)",
						"id" => "hlr_child_menu_border_width",
						"std" 		=> "3",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "20",
						"collapse_sec"	=> "hlr_cm",
						"desc" 		=> "Select the width of the border for the SubMenu Items. Default 3px.",
						"type" 		=> "sliderui" 
				);		
				
$of_options[] = array(  "name" => "SubMenu Items Border Color",
						"desc" 		=> "Select the border color for the SubMenu Items.",
						"id" => "hlr_child_menu_border_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "hlr_cm",
						"type" => "color");																			
				
$of_options[] = array(  "name" => "SubMenu Outside Shadow",
						"desc" 		=> "Add shadow effect on the outside of the SubMenu.",
						"id" => "hlr_child_menu_shadow",
						"std" => "1",
						"collapse_sec"	=> "hlr_cm",
						"type" => "switch"
					);							
				
$of_options[] = array(  "name" => "SubMenu Outside Border Width(px)",
						"desc" 		=> "Select the outside border width of the SubMenu.",
						"id" => "hlr_child_menu_outer_border",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "20",	
						"collapse_sec"	=> "hlr_cm",					
						"type" 		=> "sliderui"
					);	
						
$of_options[] = array(  "name" => "SubMenu Outside Border Color",
						"desc" 		=> "Select the outside border color for the SubMenu.",
						"id" => "hlr_child_menu_outer_border_color",
						"std" => "#eeeeee",
						"collapse_sec"	=> "hlr_cm",
						"type" => "color");		
						
$of_options[] = array(  "name" => "SubMenu Item Text Color",
						"desc" 		=> "Select the text color for the SubMenu items.",
						"id" => "hlr_child_menu_text_color",
						"std" => "#767676",
						"collapse_sec"	=> "hlr_cm",
						"type" => "color");	

$of_options[] = array(  "name" => "SubMenu Item Background Color",
						"desc" 		=> "Select the background color for the SubMenu items. Leave blank to not use any background color.",
						"id" => "hlr_child_menu_bg_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "hlr_cm",
						"type" => "color");	

$of_options[] = array(  "name" => "SubMenu Item Text Color on Hover",
						"desc" 		=> "Select the text color on hover for the SubMenu items.",
						"id" => "hlr_child_menu_text_color_hover",
						"std" => "#5b5b5b",
						"collapse_sec"	=> "hlr_cm",
						"type" => "color");
						
$of_options[] = array(  "name" => "SubMenu Item Background Color on Hover",
						"desc" 		=> "Select the background color on hover for the SubMenu items. Leave blank to not use any background color.",
						"id" => "hlr_child_menu_bg_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "hlr_cm",
						"type" => "color");	
		
$of_options[] = array( 	"name" 		=> "Mobile Menu",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "mob_menu",
						"desc" 		=> "",
						"id" 		=> "mob_menu",
						"std" 		=> "<h3>Mobile Menu settings</h3>Customize the Mobile Menu",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Mobile Menu Style",
						"desc" 		=> "Choose the style of the Mobile Menu",
						"id" => "mobile_menu_style",
						"std" => "classic",
						"type" => "select",
						"options" => array('classic' => 'Classic', 'modern' => 'Modern'));	

$of_options[] = array(  "name" => "Mobile Menu for iPad Landscape",
						"desc" 		=> "Force the mobile menu to appear for iPad devices using Landscape mode",
						"id" => "mobile_menu_landscape",
						"std" => "1",
						"type" => "switch");

$of_options[] = array(  "name" => "Mobile Menu Text",
						"desc" => "Change the text used for the Mobile Menu. Default: Menu",
						"id" => "mobile_menu_text",
						"std" => "Menu",
						"type" => "text");	

$of_options[] = array(  "name" =>  "Mobile Menu Bar - Background Color",
						"desc" => "",
						"id" => "mobile_menu_bar_bg",
						"std" => "#ffffff",
						"type" => "color");	
/*

$of_options[] = array(  "name" =>  "Mobile Menu Bar - Background Color on Hover/Active state",
						"desc" => "",
						"id" => "mobile_menu_bar_bg_hover",
						"std" => "#479e85",
						"type" => "color");	
*/

$of_options[] = array(  "name" =>  "Mobile Menu Bar - Top Border Color",
						"desc" => "If no color is selected, no border will be added. Default: no color",
						"id" => "mobile_menu_bar_border_top",
						"std" => "",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Bar - Bottom Border Color",
						"desc" => "If no color is selected, no border will be added. Default: no color",
						"id" => "mobile_menu_bar_border_bottom",
						"std" => "",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Bar - Text Color",
						"desc" => "",
						"id" => "mobile_menu_bar_text",
						"std" => "#333333",
						"type" => "color");	
/*
$of_options[] = array(  "name" =>  "Mobile Menu Bar Bottom Border Color",
						"desc" => "Set a border bottom color for the mobile menu area - <br/><span style=\"color:red;\">only works for the Modern Mobile Menu Style</span>",
						"id" => "mobile_menu_bbc",
						"std" => "",
						"type" => "color");	
*/

/*
$of_options[] = array(  "name" =>  "Mobile Menu Bar - Text Color on Hover/Active state",
						"desc" => "",
						"id" => "mobile_menu_bar_text_hover",
						"std" => "#ffffff",
						"type" => "color");
*/

$of_options[] = array(  "name" =>  "Mobile Menu Links Background Color",
						"desc" => "",
						"id" => "mobile_menu_link_bg",
						"std" => "#ffffff",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Links Text Color",
						"desc" => "",
						"id" => "mobile_menu_link_color",
						"std" => "#444444",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Sub-Indicator Color",
						"desc" => "",
						"id" => "mobile_menu_item_bg",
						"std" => "#444444",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Search Button Background Color",
						"desc" => "Set the background color for the Mobile Menu Search Form button",
						"id" => "mobile_menu_search",
						"std" => "#333333",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Search Button Text Color",
						"desc" => "Set the text color for the Mobile Menu Search Form button",
						"id" => "mobile_menu_search_text",
						"std" => "#ffffff",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Mobile Menu Separator Color",
						"desc" => "",
						"id" => "mobile_menu_item_separator",
						"std" => "#dddddd",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Off-Canvas Sidebar",
						"type" 		=> "heading"
				);	

$of_options[] = array( 	"name" 		=> "off_can",
						"desc" 		=> "",
						"id" 		=> "off_can",
						"std" 		=> "<h3>Off-Canvas Sidebar</h3>Customize the Off Canvas Sidebar",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Off Canvas Sidebar",
						"desc" 		=> "Enable/disable Off-Canvas Sidebar",
						"id" => "off_canvas_sidebar",
						"std" => "0",
						"type" => "switch");

$of_options[] = array(  "name" => "Sidebar Width",
						"desc" => "Enter the width of the Off Canvas Sidebar in pixels or percent: E.g: 300px or 30%. Default: 300px",
						"id" => "off_cnv_width",
						"std" => "300px",
						"type" => "text");							

$of_options[] = array(  "name" => "Icon Display",
						"desc" => "Enter here the fontawesome icon code. Default: fa fa-bars",
						"id" => "off_cnv_icon",
						"std" => "fa fa-bars",
						"type" => "text");

$of_options[] = array(  "name" => "Sidebar Heading Font Size",
						"desc" => "Enter the font size for the Sidebar Headings. Default: 13px",
						"id" => "off_cnv_heading",
						"std" => "16px",
						"type" => "text");		

$of_options[] = array(  "name" => "Sidebar Heading Split Line",
						"desc" => "Enable/disable the heading split line",
						"id" => "off_cnv_heading_split",
						"std" => "1",
						"folds" => "1",
						"type" => "switch");												

$of_options[] = array(  "name" =>  "Sidebar Heading Split Line Color",
						"desc" => "",
						"id" => "off_cnv_heading_split_color",
						"std" => "#dddddd",
						"fold" => "off_cnv_heading_split",
						"type" => "color");

$of_options[] = array(  "name" =>  "Sidebar Background Color",
						"desc" => "",
						"id" => "off_cnv_bg",
						"std" => "#f7f7f7",
						"type" => "color");

$of_options[] = array(  "name" =>  "Sidebar Text Color",
						"desc" => "",
						"id" => "off_cnv_text",
						"std" => "#444444",
						"type" => "color");

$of_options[] = array(  "name" =>  "Sidebar Link Color",
						"desc" => "",
						"id" => "off_cnv_link",
						"std" => "#444444",
						"type" => "color");

$of_options[] = array(  "name" =>  "Sidebar Link Color on Hover",
						"desc" => "",
						"id" => "off_cnv_link_hover",
						"std" => "#5c5c5c",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "Page Title - Breadcrumb",
						"type" 		=> "heading"
				);								
						
$of_options[] = array( 	"name" 		=> "Title &amp; Breadcrumb",
						"desc" 		=> "",
						"id" 		=> "title_breadcrumbs",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Title &amp; Breadcrumb</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Title and Breadcrumb Global Disable",
						"desc" 		=> "Disable the entire Title and Breadcrumbs Area for the entire site",
						"id" => "global_title_bread",
						"std" => "0",
						"type" => "switch");	

$of_options[] = array(  "name" => "Elements Positioning",
						"desc" 		=> "Select the position of the Title, Breadcrumb and Search box",
						"id" => "page_title_align",
						"std" => "left",
						"type" => "select",
						"options" => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'));	

$of_options[] = array(  "name" => "Display Page Title ",
						"desc" 		=> "Enable/Disable Page Title for the entire site",
						"id" => "page_title_show",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));	

$of_options[] = array(  "name" => "Display Breadcrumb ",
						"desc" 		=> "Enable/Disable breadcrumb for the entire site",
						"id" => "breadcrum_show",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));	

$of_options[] = array(  "name" => "Page Title Tag",
						"desc" 		=> "Select the html tag used for the Page Title",
						"id" => "page_title_tag",
						"std" => "h2",
						"type" => "select",
						"options" => array('h1' => 'h1', 'h2' => 'h2', 'h3' => 'h3', 'h4' => 'h4', 'h5' => 'h5', 'h6' => 'h6', 'p' => 'p', 'div' => 'div'));							

$of_options[] = array(  "name" => "Show Page Title & Breadcrumb on Posts",
						"desc" 		=> "Enable/Disable the page title & breadcrumb on posts",
						"id" => "page_title_posts",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));	

$of_options[] = array(  "name" => "Show Page Title & Breadcrumb on Pages",
						"desc" 		=> "Enable/Disable the page title & breadcrumb on pages",
						"id" => "page_title_pages",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));	

$of_options[] = array(  "name" => "Show Page Title & Breadcrumb on Portfolio Items",
						"desc" 		=> "Enable/Disable the page title & breadcrumb on portfolio items",
						"id" => "page_title_portfolio",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));

$of_options[] = array(  "name" => "Show Page Title & Breadcrumb on WooCommerce",
						"desc" 		=> "Enable/Disable the page title & breadcrumb on woocommerce pages and products pages",
						"id" => "page_title_woocommerce",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));		

$of_options[] = array(  "name" => "Show Page Title & Breadcrumb on bbPress Forum",
						"desc" 		=> "Enable/Disable the page title & breadcrumb on bbPress Forums",
						"id" => "page_title_bbpress",
						"std" => "yes",
						"type" => "select",
						"options" => array('yes' => 'Yes', 'no' => 'No'));																																							
				
$of_options[] = array(  "name" =>  "Title and Breadcrumb Background Color",
						"desc" => "Select the background color for the title & breadcrumb section.",
						"id" => "tb_bg_color",
						"std" => "#f8f8f8",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Title and Breadcrumb Font Color",
						"desc" => "Select the font color for the title & breadcrumb section.",
						"id" => "tb_title_color",
						"std" => "#4d4d4d",
						"type" => "color");
						
$of_options[] = array(  "name" => "Title and Breadcrumb Search Box",
						"desc" 		=> "Enable/disable a Search Box in the Title and Breadcrumb Area",
						"id" => "header_search_form",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");																										
										
$of_options[] = array( 	"name" 		=> "Footer",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "footer_sett",
						"desc" 		=> "",
						"id" 		=> "footer_sett",
						"std" 		=> "<h3>Footer Settings</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);					

$of_options[] = array(  "name" => "Sticky Footer",
						"desc" 		=> "Always position the Footer on the bottom of the page.",
						"id" => "en_sticky_footer",
						"std" => "0",
						"collapse_sec"	=> "footer_sett",
						"folds" => "1",
						"type" => "switch");


$of_options[] = array(  "name" => "Footer Sidebar Columns",
						"desc" 		=> "Select how many columns to be used for the Footer Sidebar.",
						"id" => "footer_cols",						
						"type" => "select",
						"collapse_sec"	=> "footer_sett",
						"options" => array( "cols_4" => "4 Columns", "cols_3" => "3 Columns", "cols_2" => "2 Columns", "cols_1" => "1 Column" ));

$of_options[] = array(  "name" => "Footer Sidebar Content Align",
						"desc" 		=> "Select the alignment for the Footer Sidebar widgets.",
						"id" => "footer_sidebar_align",						
						"type" => "select",
						"collapse_sec"	=> "footer_sett",
						"options" => array( "left" => "Left", "center" => "Center", "right" => "Right"));

$of_options[] = array(  "name" => "Footer Sidebar Layout",
						"desc" 	=> "Choose a layout for the Footer Sidebar area",
						"id" => "footer_widget_layout",
						"std" => "Default",
						"type" => "select",
						"collapse_sec"	=> "footer_sett",
						"options" => array("default" => "Default", "business" => "Business"));


$of_options[] = array(  "name" => "Footer Width",						
						"desc" => "Select the width of the Footer Area",
						"id" => "footer_width",
						"std" => "normal",
						"type" => "select",
						"collapse_sec"	=> "footer_sett",
						"options" => array('normal' => 'Normal', 'expanded' => 'Expanded'));																	
				
$of_options[] = array(  "name" => "Center Footer Content",
						"desc" 		=> "Enable/disable the centering of the footer elements.",
						"id" => "en_footer_center",
						"std" => "0",
						"collapse_sec"	=> "footer_sett",
						"type" => "switch");
						
$of_options[] = array(  "name" =>  "Footer Social Icons Color",
						"desc" => "Select the color of the footer Social Icons.",
						"id" => "footer_social_icons",
						"std" => "#848484",
						"collapse_sec"	=> "footer_sett",
						"fold" => "en_back_top",
						"type" => "color");							
				
$of_options[] = array( 	"name" 		=> "Footer Copyright",
						"desc" 		=> "Paste here your footer copyright text or html!",
						"id" 		=> "footer_copyright",
						"std" 		=> "&copy; Copyright 2017. Powered by <a href=\"http://wordpress.org\">WordPress</a><br> <a href=\"http://rockythemes.com/creativo/\">Creativo</a> by RockyThemes.",
						"collapse_sec"	=> "footer_sett",
						"type" 		=> "textarea"
				);	

$of_options[] = array( 	"name" 		=> "Footer Menu",
						"desc" 		=> "",
						"id" 		=> "footer_rs",
						"std" 		=> "<h3>Footer Right Side</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array(  "name" => "Footer Right Side Display",						
						"desc" => "Select what to display in the right area of the Footer Menu",
						"id" => "footer_right_area",
						"std" => "socialinks_footer",
						"type" => "select",
						"collapse_sec"	=> "footer_rs",
						"options" => array('socialinks_footer' => 'Social Links', 'footer_menu' => 'Footer Menu', 'empty' => 'Leave Empty'));
						
$of_options[] = array(  "name" =>  "Footer Menu Link Color",
						"desc" => "Set a color for the Footer Menu Links.",
						"id" => "fm_link",
						"std" => "#cccccc",
						"collapse_sec"	=> "footer_rs",
						"type" => "color");
							
$of_options[] = array(  "name" =>  "Footer Menu Link Color on Hover",
						"desc" => "Set a color for the Footer Menu Links on Hover.",
						"id" => "fm_link_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "footer_rs",
						"type" => "color");	

$of_options[] = array(  "name" => "Footer Menu Font Weight",
						"id" => "fm_font_weight",
						"std" => "400",
						"collapse_sec"	=> "footer_rs",
						"type" => "select",
						"options" => array(300,400,500, 600,700,800,900));																					

$of_options[] = array( 	"name" 		=> "Back to Top Button",
						"desc" 		=> "",
						"id" 		=> "back_top",
						"std" 		=> "<h3>Back to Top</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array(  "name" => "Back to Top button",
						"desc" 		=> "Enable/disable the Back to Top button.",
						"id" => "en_back_top",
						"std" => "1",
						"folds" => "1",
						"collapse_sec"	=> "back_top",
						"type" => "switch");	

$of_options[] = array(  "name" => "Back to Top button on mobile devices",
						"desc" 		=> "Enable/disable the Back to Top button on mobile devices.",
						"id" => "en_back_top_mobile",
						"std" => "0",	
						"fold" => "en_back_top",					
						"collapse_sec"	=> "back_top",
						"type" => "switch");
						
$of_options[] = array(  "name" =>  "Back to Top Background color",
						"desc" => "Select the background color for the back to top button.",
						"id" => "back_top_bg",
						"std" => "#444",
						"fold" => "en_back_top",
						"collapse_sec"	=> "back_top",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Back to Top Background color on Hover",
						"desc" => "Select the background color on hover, for the back to top button.",
						"id" => "back_top_bg_hover",
						"std" => "#5bc98c",
						"fold" => "en_back_top",
						"collapse_sec"	=> "back_top",
						"type" => "color");								

$of_options[] = array( 	"name" 		=> "Footer Widgets",
						"desc" 		=> "",
						"id" 		=> "footer_widget",
						"std" 		=> "<h3>Footer Widgets</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Footer Widgets Top Spacing",
						"desc" => "Use the slider below to customize the spacing area above the Footer Widgets",
						"id" => "footer_widgets_spacing",
						"std" 		=> "15",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",
						"collapse_sec"	=> "footer_widget",						
						"type" 		=> "sliderui" 
						);	

$of_options[] = array(  "name" =>  "Footer Widget Link Color",
						"desc" => "",
						"id" => "footer_widget_link_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");

$of_options[] = array(  "name" =>  "Footer Widget Link Color on Hover",
						"desc" => "Select the color of Links inside a Footer Widget",
						"id" => "footer_widget_link_color_hover",
						"std" => "#888888",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");
				
$of_options[] = array(  "name" => "Footer Widgets Patterns",
						"desc" 		=> "Enable/disable patterns on footer widgets section.",
						"id" => "en_footer_pattern",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "footer_widget",	
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Footer Widgets Pattern",
						"desc" 		=> "Select a background pattern for the footer.",
						"id" 		=> "footer_patterns",
						"std" 		=> $bg_images_url."pattern10.png",
						"type" 		=> "tiles",
						"fold" 		=> "en_footer_pattern",
						"collapse_sec"	=> "footer_widget",	
						"options" 	=> array(
						"pattern1" => get_template_directory_uri()."/images/pattern/pattern1.png",
						"pattern2" => get_template_directory_uri()."/images/pattern/pattern2.png",
						"pattern3" => get_template_directory_uri()."/images/pattern/pattern3.png",
						"pattern4" => get_template_directory_uri()."/images/pattern/pattern4.png",
						"pattern5" => get_template_directory_uri()."/images/pattern/pattern5.png",
						"pattern6" => get_template_directory_uri()."/images/pattern/pattern6.png",
						"pattern7" => get_template_directory_uri()."/images/pattern/pattern7.png",
						"pattern8" => get_template_directory_uri()."/images/pattern/pattern8.png",
						"pattern9" => get_template_directory_uri()."/images/pattern/pattern9.png",
						"pattern10" => get_template_directory_uri()."/images/pattern/pattern10.png",
						"pattern11" => get_template_directory_uri()."/images/pattern/pattern11.png",
						"pattern12" => get_template_directory_uri()."/images/pattern/pattern12.png",
						"pattern13" => get_template_directory_uri()."/images/pattern/pattern13.png",
						"pattern14" => get_template_directory_uri()."/images/pattern/pattern14.png",
						"pattern15" => get_template_directory_uri()."/images/pattern/pattern15.png",
						"pattern16" => get_template_directory_uri()."/images/pattern/pattern16.png",
						"pattern17" => get_template_directory_uri()."/images/pattern/pattern17.png",
						"pattern18" => get_template_directory_uri()."/images/pattern/pattern18.png",
						"pattern19" => get_template_directory_uri()."/images/pattern/pattern19.png",
						"pattern20" => get_template_directory_uri()."/images/pattern/pattern20.png",
						"pattern21" => get_template_directory_uri()."/images/pattern/pattern21.png",
						"pattern22" => get_template_directory_uri()."/images/pattern/pattern22.png",
						"pattern23" => get_template_directory_uri()."/images/pattern/pattern23.png",
						"pattern24" => get_template_directory_uri()."/images/pattern/pattern24.png",
						"pattern25" => get_template_directory_uri()."/images/pattern/pattern25.png",
					));
				
$of_options[] = array(  "name" =>  "Footer Widgets Background Color",
						"desc" => "Select the background color for the footer widgets section - if patterns are disabled the background color will be used.",
						"id" => "footer_bg_color",
						"std" => "#222326",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Footer Widgets Heading Color",
						"desc" => "Select the color for the footer widgets headings.",
						"id" => "footer_heading_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");	
/*
$of_options[] = array( 	"name" 		=> "Footer Widgets Heading Font Size",
						"desc" => "Default is 14",
						"id" => "footer_heading_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"type" 		=> "sliderui" 
				);
*/
$of_options[] = array(  "name" => "Footer Widgets Heading Font Weight",
						"id" => "footer_heading_font_weight",
						"std" => "600",
						"type" => "select",
						"collapse_sec"	=> "footer_widget",	
						"options" => array(300,400,500, 600,700,800,900));

$of_options[] = array( 	"name" 		=> "Footer Widgets Heading Letter Spacing",
						"desc" => "Default is 0",
						"id" => "footer_heading_let_sp",
						"std" 		=> "0",
						"min" 		=> "-5",
						"step"		=> "1",
						"max" 		=> "5",
						"collapse_sec"	=> "footer_widget",	
						"type" 		=> "sliderui" 
				);					
						
$of_options[] = array(  "name" =>  "Footer Widgets Text Color",
						"desc" => "Select the color for the footer widgets text.",
						"id" => "footer_widget_text_color",
						"std" => "#858d91",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Footer Widgets Border Top Color",						
						"id" => "footer_widgets_tb_color",
						"std" => "#eeeeee",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Footer Widgets Border Bottom Color",						
						"id" => "footer_widgets_bb_color",
						"std" => "#2e343a",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Footer Flickr Widget Border Color",						
						"id" => "footer_flickr_bcolor",
						"std" => "#454c54",
						"collapse_sec"	=> "footer_widget",	
						"type" => "color");

$of_options[] = array(  "name" => "Footer Contact Us Widget Icons",
						"desc" 		=> "Enable/disable the usage of icons when the Contact Us widget is being used on the Footer Sidebar.",
						"id" => "en_footer_contact_icons",
						"std" => "1",
						"collapse_sec"	=> "footer_widget",				
						"type" => "switch");							

$of_options[] = array( 	"name" 		=> "Footer Copyright",
						"desc" 		=> "",
						"id" 		=> "ftr_copy",
						"std" 		=> "<h3>Footer Copyright</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" =>  "Footer Copyright Top Border Color",						
						"id" => "footer_copy_top_border",
						"desc" 		=> "Leave the color field empty if you don't want to use a border",
						"std" => "",
						"collapse_sec"	=> "ftr_copy",
						"type" => "color");																																
						
$of_options[] = array(  "name" => "Footer Copyright Patterns",
						"desc" 		=> "Enable/disable patterns on footer copyright section.",
						"id" => "en_footer_copy_pattern",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "ftr_copy",
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Footer Copyright Pattern",
						"desc" 		=> "Select a background pattern for the footer copyright.",
						"id" 		=> "footer_copy_patterns",
						"std" 		=> $bg_images_url."pattern10.png",
						"type" 		=> "tiles",
						"fold" 		=> "en_footer_copy_pattern",
						"collapse_sec"	=> "ftr_copy",
						"options" 	=> array(
						"pattern1" => get_template_directory_uri()."/images/pattern/pattern1.png",
						"pattern2" => get_template_directory_uri()."/images/pattern/pattern2.png",
						"pattern3" => get_template_directory_uri()."/images/pattern/pattern3.png",
						"pattern4" => get_template_directory_uri()."/images/pattern/pattern4.png",
						"pattern5" => get_template_directory_uri()."/images/pattern/pattern5.png",
						"pattern6" => get_template_directory_uri()."/images/pattern/pattern6.png",
						"pattern7" => get_template_directory_uri()."/images/pattern/pattern7.png",
						"pattern8" => get_template_directory_uri()."/images/pattern/pattern8.png",
						"pattern9" => get_template_directory_uri()."/images/pattern/pattern9.png",
						"pattern10" => get_template_directory_uri()."/images/pattern/pattern10.png",
						"pattern11" => get_template_directory_uri()."/images/pattern/pattern11.png",
						"pattern12" => get_template_directory_uri()."/images/pattern/pattern12.png",
						"pattern13" => get_template_directory_uri()."/images/pattern/pattern13.png",
						"pattern14" => get_template_directory_uri()."/images/pattern/pattern14.png",
						"pattern15" => get_template_directory_uri()."/images/pattern/pattern15.png",
						"pattern16" => get_template_directory_uri()."/images/pattern/pattern16.png",
						"pattern17" => get_template_directory_uri()."/images/pattern/pattern17.png",
						"pattern18" => get_template_directory_uri()."/images/pattern/pattern18.png",
						"pattern19" => get_template_directory_uri()."/images/pattern/pattern19.png",
						"pattern20" => get_template_directory_uri()."/images/pattern/pattern20.png",
						"pattern21" => get_template_directory_uri()."/images/pattern/pattern21.png",
						"pattern22" => get_template_directory_uri()."/images/pattern/pattern22.png",
						"pattern23" => get_template_directory_uri()."/images/pattern/pattern23.png",
						"pattern24" => get_template_directory_uri()."/images/pattern/pattern24.png",
						"pattern25" => get_template_directory_uri()."/images/pattern/pattern25.png",
					));

$of_options[] = array( 	"name" 		=> "Footer Copyright - Custom Background",
						"desc" 		=> "Upload an image or new pattern for the background of the footer copyright section.",
						"id" 		=> "footer_copyright_bg",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_copy",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Footer Copyright - Custom Background Repeat",
						"id" => "footer_copyright_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"collapse_sec"	=> "ftr_copy",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat"));
				
$of_options[] = array(  "name" =>  "Footer Copyright Background Color",
						"desc" => "Select the background color for the footer copyright section - if patterns are disabled the background color will be used.",
						"id" => "footer_copy_bg_color",
						"std" => "#1E1D1D",
						"collapse_sec"	=> "ftr_copy",
						"type" => "color");	
						
						
						
$of_options[] = array(  "name" =>  "Footer Copyright Text Color",
						"desc" => "Select the text color for the footer copyright section.",
						"id" => "footer_text_color",
						"std" => "#999999",
						"collapse_sec"	=> "ftr_copy",
						"type" => "color");

$of_options[] = array(  "name" =>  "Footer Copyright Link Color",
						"desc" => "Select the link color for the footer copyright section.",
						"id" => "footer_link_color",
						"std" => "#727272",
						"collapse_sec"	=> "ftr_copy",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Footer Copyright Link Color - Hover",
						"desc" => "Select the link color for the footer copyright section, on hover.",
						"id" => "footer_link_color_hover",
						"std" => "#525252",
						"collapse_sec"	=> "ftr_copy",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Footer Additional Icons/Images",
						"desc" 		=> "",
						"id" 		=> "ftr_add_img",
						"std" 		=> "<h3>Footer Additional Icons/Images</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Columns",
						"desc" 		=> "Choose how many columns to use",
						"id" => "footer_ii_cols",
						"std" => 6,
						"collapse_sec"	=> "ftr_add_img",
						"type" => "select",
						"options" => array(6,5,4,3));

$of_options[] = array( 	"name" 		=> "Custom Background Image",
						"desc" 		=> "Upload an image for the background .",
						"id" 		=> "footer_ii_bg_img",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Custom Background Image Repeat",
						"id" => "footer_ii_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"collapse_sec"	=> "ftr_add_img",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat"));

$of_options[] = array(  "name" => "Custom Background Image Mode",
						"id" => "footer_ii_bg_mode",
						"std" => "cover",
						"type" => "select",
						"collapse_sec"	=> "ftr_add_img",
						"options" => array("cover","contain"));
				
$of_options[] = array(  "name" =>  "Background Color",
						"desc" => "If no image is being used, you can choose to set a default background color",
						"id" => "footer_ii_bg_color",
						"std" => "",
						"collapse_sec"	=> "ftr_add_img",
						"type" => "color");

$of_options[] = array(  "name" => "Links Target",
						"id" => "footer_ii_target",
						"std" => "_blank",
						"type" => "select",
						"collapse_sec"	=> "ftr_add_img",
						"options" => array( "_blank","self" ));

$of_options[] = array( 	"name" 		=> "Icons Font Size",
						"desc" => "Specify the font size for the Fontawesome Icons",
						"id" => "footer_ii_font_size",
						"std" 		=> "30",
						"min" 		=> "15",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Icons Color",
						"desc" => "Choose the color of the Icons",
						"id" => "footer_ii_icon_color",
						"std" => "#dddddd",
						"collapse_sec"	=> "ftr_add_img",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "Column 1 Icon",
						"desc" 		=> "Add here the Fontawesome Icon you want to use for Column 1. <br>E.g: fa fa-facebook",
						"id" 		=> "footer_col_icon_1",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",						
				);

$of_options[] = array( 	"name" 		=> "Column 1 Image",
						"desc" 		=> "Upload an image to be placed inside Column 1",
						"id" 		=> "footer_col_img_1",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Column 1 link",
						"desc" 		=> "Add here the link to use for Column 1. <br>E.g: https://facebook.com/rockythemes",
						"id" 		=> "footer_col_link_1",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 2 Icon",
						"desc" 		=> "Add here the Fontawesome Icon you want to use for Column 2. <br>E.g: fa fa-twitter",
						"id" 		=> "footer_col_icon_2",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 2 Image",
						"desc" 		=> "Upload an image to be placed inside Column 2",
						"id" 		=> "footer_col_img_2",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Column 2 link",
						"desc" 		=> "Add here the link to use for Column 2. <br>E.g: https://twitter.com/rockythemes",
						"id" 		=> "footer_col_link_2",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 3 Icon",
						"desc" 		=> "Add here the Fontawesome Icon you want to use for Column 3. <br>E.g: fa fa-twitter",
						"id" 		=> "footer_col_icon_3",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 3 Image",
						"desc" 		=> "Upload an image to be placed inside Column 3",
						"id" 		=> "footer_col_img_3",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Column 3 link",
						"desc" 		=> "Add here the link to use for Column 3. <br>E.g: https://twitter.com/rockythemes",
						"id" 		=> "footer_col_link_3",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 4 Icon",
						"desc" 		=> "Add here the Fontawesome Icon you want to use for Column 4. <br>E.g: fa fa-twitter",
						"id" 		=> "footer_col_icon_4",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 4 Image",
						"desc" 		=> "Upload an image to be placed inside Column 4",
						"id" 		=> "footer_col_img_4",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Column 4 link",
						"desc" 		=> "Add here the link to use for Column 4. <br>E.g: https://twitter.com/rockythemes",
						"id" 		=> "footer_col_link_4",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 5 Icon",
						"desc" 		=> "Add here the Fontawesome Icon you want to use for Column 5. <br>E.g: fa fa-twitter",
						"id" 		=> "footer_col_icon_5",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",						
				);

$of_options[] = array( 	"name" 		=> "Column 5 Image",
						"desc" 		=> "Upload an image to be placed inside Column 5",
						"id" 		=> "footer_col_img_5",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Column 5 link",
						"desc" 		=> "Add here the link to use for Column 5. <br>E.g: https://twitter.com/rockythemes",
						"id" 		=> "footer_col_link_5",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 6 Icon",
						"desc" 		=> "Add here the Fontawesome Icon you want to use for Column 6. <br>E.g: fa fa-twitter",
						"id" 		=> "footer_col_icon_6",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);

$of_options[] = array( 	"name" 		=> "Column 6 Image",
						"desc" 		=> "Upload an image to be placed inside Column 6",
						"id" 		=> "footer_col_img_6",						
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Column 6 link",
						"desc" 		=> "Add here the link to use for Column 6. <br>E.g: https://twitter.com/rockythemes",
						"id" 		=> "footer_col_link_6",
						"std" 		=> "",
						"collapse_sec"	=> "ftr_add_img",
						"type" 		=> "text",
						
				);
	
$of_options[] = array( 	"name" 		=> "Call to Action",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "cta_bar",
						"desc" 		=> "",
						"id" 		=> "footer_cta_bar",
						"std" 		=> "<h3>Call to Action Bar</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array(  "name" => "Call to Action Bar Enable/Disable",
						"desc" 		=> "Enable/disable the call to action bar - section will be present on all your pages, above the footer area.",
						"id" => "en_cta",
						"std" => "0",
						"collapse_sec"	=> "footer_cta_bar",
						//"folds" => "1",
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Padding Top/Bottom",
						"desc" => "Set a custom padding top/bottom for the call to action bar",
						"id" => "cta_padding",
						"std" 		=> "40",
						"min" 		=> "10",
						"step"		=> "5",
						"max" 		=> "120",
						"collapse_sec"	=> "footer_cta_bar",
						"type" 		=> "sliderui",
						////"fold" => "en_cta" 
				);	

$of_options[] = array(  "name" => "Elements Positioning",						
						"desc" => "Select the positioning of the elements",
						"id" => "cta_elem_pos",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "footer_cta_bar",
						"options" => array('left' => 'Left', 'center' => 'Centered'),
						////"fold" => "en_cta"
				);
						
$of_options[] = array( 	"name" => "Heading Text ",
						"id" 		=> "cta_text_real",
						"std" 		=> "This can be changed by going to Appearance -> Theme Options -> Call to Action!",
						"type" 		=> "textarea",
						"collapse_sec"	=> "footer_cta_bar",
						////"fold" => "en_cta"
				);	



$of_options[] = array( 	"name" 		=> "Heading Text Font Size",
						"desc" => "Set a font size for the Heading Text",
						"id" => "cta_heading_font_size",
						"std" 		=> "20",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "footer_cta_bar",
						////"fold" => "en_cta"
				);

$of_options[] = array(  "name" => "Heading Text Font Weight",
						"id" => "cta_heading_font_weight",
						"std" => "400",
						"type" => "select",
						"options" => array(300,400,500, 600,700,800,900),
						"collapse_sec"	=> "footer_cta_bar",
						////"fold" => "en_cta"
				);

$of_options[] = array( 	"name" 		=> "Heading Text Line Height",
						"desc" 		=> "Specify a line height for the Heading text. Leave blank to inherit the default Body Line Height.",
						"id" 		=> "cta_heading_line_height",
						"std" 		=> "",
						"type" 		=> "text",
						"collapse_sec"	=> "footer_cta_bar",
						////"fold" => "en_cta"
				);	

$of_options[] = array( 	"name" 		=> "Heading Text Bottom Margin",
						"desc" => "Set a margin between the Heading text and the Description text",
						"id" => "cta_bottom_margin",
						"std" 		=> "15",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "120",
						"type" 		=> "sliderui" ,
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta"
				);

$of_options[] = array( 	"name" => "Description Text ",
						"id" 		=> "cta_descr_text",
						"collapse_sec"	=> "footer_cta_bar",
						"std" 		=> "Hello, this is a demo text which can be changed by going to Appearance -> Theme Options -> Call to Action -> Description text.",
						"type" 		=> "textarea",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta"
				);

$of_options[] = array( 	"name" 		=> "Description Text Font Size",
						"desc" => "Set a font size for the Description Text",
						"id" => "cta_descr_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"type" 		=> "sliderui",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta"
				);

$of_options[] = array(  "name" => "Description Text Font Weight",
						"id" => "cta_descr_font_weight",
						"std" => "300",
						"type" => "select",
						"options" => array(300,400,500, 600,700,800,900),
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta"
				);																		

$of_options[] = array( 	"name" 		=> "Description Text Line Height",
						"desc" 		=> "Specify a line height for the Description text. Leave blank to inherit the default Body Line Height.",
						"id" 		=> "cta_descr_line_height",
						"std" 		=> "",
						"type" 		=> "text",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta"
				);
						
$of_options[] = array(  "name" =>  "Description Text Color",
						"desc" => "",
						"id" => "cta_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Description Text Color on Hover",
						"desc" => "Select the text color you want to use when users hover over the Call to Action section",
						"id" => "cta_text_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta",
						"type" => "color");													
						
$of_options[] = array(  "name" =>  "Background Color",
						"desc" => "Select a background color for the Call to Action section",
						"id" => "cta_bg",
						"std" => "#5bc98c",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Background Color on Hover",
						"desc" => "Select a background color of the Call to Action section when users hover over it",
						"id" => "cta_bg_hover",
						"std" => "#479e85",
						"collapse_sec"	=> "footer_cta_bar",
						//"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array( 	"name" 		=> "cta_bar_button",
						"desc" 		=> "",
						"id" 		=> "cta_bar_button",
						"std" 		=> "<h3>Call to Action Button Text</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						//"fold" => "en_cta",
						"type" 		=> "info"
				);		
				
$of_options[] = array( 	"name" 		=> "Call to Action Button Text",
						"desc" 		=> "Enter the text you want to display on your button.",
						"id" 		=> "cta_button_text",
						"std" 		=> "Your Text Here",
						"collapse_sec"	=> "cta_bar_button",
						//"fold"		=> "en_cta",
						"type" 		=> "text"
				);		
				
$of_options[] = array( 	"name" 		=> "Call to Action Button Link",
						"desc" 		=> "Enter the link for the Call to Action button",
						"id" 		=> "cta_button_link",
						"std" 		=> "",
						"collapse_sec"	=> "cta_bar_button",
						//"fold"		=> "en_cta",
						"type" 		=> "text"
				);		
				
$of_options[] = array( 	"name" 		=> "button info",
						"desc" 		=> "",
						"id" 		=> "cta_button_style",
						"std" 		=> "<h3>Call to Action Button style</h3>",						
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Button Text Font Size",
						"desc" => "Set a font size for the Text of the button",
						"id" => "cta_button_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "cta_button_style",
						"type" 		=> "sliderui"						
				);

$of_options[] = array(  "name" => "Button Text Font Weight",
						"id" => "cta_button_font_weight",
						"std" => "400",
						"type" => "select",
						"collapse_sec"	=> "cta_button_style",
						"options" => array(300,400,500, 600,700,800,900),
						//"fold" => "en_cta"
				);

$of_options[] = array( 	"name" 		=> "Button Text Line Height",
						"desc" 		=> "Specify a line height for the Button text. Leave blank to inherit the default line height of the button defined in the style of the theme.",
						"id" 		=> "cta_button_line_height",
						"std" 		=> "",
						"collapse_sec"	=> "cta_button_style",
						"type" 		=> "text",
						//"fold" => "en_cta"
				);	

$of_options[] = array(  "name" => "Button Shape",						
						"desc" => "Select the shape of the button",
						"id" => "cta_button_shape",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "cta_button_style",
						"options" => array('square' => 'Square', 'rounded' => 'Rounded', 'round' => 'Round'),
						//"fold" => "en_cta"
				);																	
						
$of_options[] = array(  "name" =>  "Button Background Color",
						"desc" => "",
						"id" => "cta_button_background_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "cta_button_style",
						"type" => "color");	
				
$of_options[] = array(  "name" =>  "Button Border Color",
						"desc" => "",
						"id" => "cta_button_border_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "cta_button_style",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Button Text Color",
						"desc" => "",
						"id" => "cta_button_text_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "cta_button_style",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Background Color on Hover",
						"desc" => "",
						"id" => "cta_button_background_color_hover",
						"std" => "#479e85",
						"collapse_sec"	=> "cta_button_style",
						"type" => "color");	
				
$of_options[] = array(  "name" =>  "Button Border Color on Hover",
						"desc" => "",
						"id" => "cta_button_border_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "cta_button_style",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Button Text Color on Hover",
						"desc" => "",
						"id" => "cta_button_text_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "cta_button_style",
						"type" => "color");																																								
				
$of_options[] = array( 	"name" 		=> "VC Elements",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "tbutton info",
						"desc" 		=> "",
						"id" 		=> "button_inf",
						"std" 		=> "<h3>Button Default</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);	

$of_options[] = array(  "name" =>  "Button Background Color",
						"desc" => "",
						"id" => "button_background_color",
						"std" => "#5bc98c",
						"type" => "color");	
				
$of_options[] = array(  "name" =>  "Button Border Color",
						"desc" => "",
						"id" => "button_border_color",
						"std" => "#5bc98c",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Button Text Color",
						"desc" => "",
						"id" => "button_text_color",
						"std" => "#ffffff",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Background Color on Hover",
						"desc" => "",
						"id" => "button_background_color_hover",
						"std" => "#479e85",
						"type" => "color");	
				
$of_options[] = array(  "name" =>  "Button Border Color on Hover",
						"desc" => "",
						"id" => "button_border_color_hover",
						"std" => "#479e85",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Button Text Color on Hover",
						"desc" => "",
						"id" => "button_text_color_hover",
						"std" => "#ffffff",
						"type" => "color");		

$of_options[] = array( 	"name" 		=> "Button Text Font Size",
						"desc" => "Set a font size for the Text of the button",
						"id" => "button_font_size",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"type" 		=> "sliderui"						
				);

$of_options[] = array(  "name" => "Button Text Font Weight",
						"id" => "button_font_weight",
						"std" => "400",
						"type" => "select",
						"options" => array(300,400,500, 600,700,800,900),						
				);

$of_options[] = array( 	"name" 		=> "Button Text Line Height",
						"desc" 		=> "Specify a line height for the Button text. Leave blank to inherit the default line height of the button defined in the style of the theme.",
						"id" 		=> "button_line_height",
						"std" 		=> "",
						"type" 		=> "text",						
				);	

$of_options[] = array(  "name" => "Button Shape",						
						"desc" => "Select the shape of the button",
						"id" => "button_shape",
						"std" => "left",
						"type" => "select",
						"options" => array('square' => 'Square', 'rounded' => 'Rounded', 'round' => 'Round'),
						
				);											
											
				
$of_options[] = array( 	"name" 		=> "tagline info",
						"desc" 		=> "",
						"id" 		=> "tagline_inf",
						"std" 		=> "<h3 style=\margin: 0 0 10px;\">Call to Action </h3>
						Here you can modify settings for the Call to Action",
						"icon" 		=> true,
						"type" 		=> "info"
				);					
				
$of_options[] = array(  "name" =>  "Call to Action Text Color (Default)",
						"id" => "action_text_color",
						"std" => "#ffffff",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Call to Action Text Color on Hover",
						"id" => "action_text_color_hover",
						"std" => "#ffffff",
						"type" => "color");						
/*				
$of_options[] = array(  "name" =>  "Call to Action Border Color (Default)",
						"id" => "action_border",
						"std" => "#d2e5ae",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Call to Action Border Color on Hover",
						"id" => "action_border_hover",
						"std" => "#A5CB5E",
						"type" => "color");	
*/						
$of_options[] = array(  "name" =>  "Call to Action Background Color",
						"id" => "action_bg",
						"std" => "#5bc98c",
						"type" => "color");

$of_options[] = array(  "name" =>  "Call to Action Background Color on Hover",
						"id" => "action_bg_hover",
						"std" => "#479e85",
						"type" => "color");
						
$of_options[] = array( 	"name" 		=> "featured services",
						"desc" 		=> "",
						"id" 		=> "featured_services",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Featured Services</h3>
						Here you can modify settings for the Featured Services",
						"icon" 		=> true,
						"type" 		=> "info"
				);		
				
$of_options[] = array(  "name" =>  "Featured Services Background Color (Default)",
						"id" => "featured_serv_bg",
						"std" => "#ffffff",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Featured Services Link Color (Default)",
						"id" => "featured_serv_link",
						"std" => "#5bc98c",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Featured Services Background Color on Hover (Default)",
						"id" => "featured_serv_bg_hover",
						"std" => "#5bc98c",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Enable White Circle",
						"desc" 		=> "Enable/disable the white circle inside the Featured Service box.",
						"id" => "white_circle",
						"std" => "1",
						"type" => "switch");																																												

$of_options[] = array( 	"name" 		=> "testimonial",
						"desc" 		=> "",
						"id" 		=> "testimonial",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Testimonials Slider</h3>
						Here you can modify settings for the Testimonials slider",
						"icon" 		=> true,
						"type" 		=> "info"
				);		
				
$of_options[] = array(  "name" => "Pause on Hover",
						"desc" 		=> "Enable/disable pause on hover event.",
						"id" => "pause_hover",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Testimonial Pause Time - in seconds",
						"id" => "pause_time",
						"std" 		=> "3",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "15",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Blog",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "blog_sett",
						"desc" 		=> "",
						"id" 		=> "blog_sett",
						"std" 		=> "<h3>Blog - General Settings</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array(  "name" => "Post Content Width",
						"desc" => "Select the width of the Post Container in percents.",
						"id" => "post_content_width",
						"std" 		=> "65",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "blog_sett",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Sidebar Width",
						"name" => "Select the width of the Sidebar in percents.",
						"id" => "sidebar_width",
						"std" 		=> "32",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "blog_sett",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Post Content Force Full Width",
						"desc" 		=> "If set to yes the post area will become full width. This option will also affect pages. ",
						"id" => "post_content_full_width",
						"std" => "Post Excerpt",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("no" => "No", "yes"=> "Yes"));
				
$of_options[] = array(  "name" => "Posts Count",
						"id" => "posts_count",
						"std" 		=> "10",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "30",
						"collapse_sec"	=> "blog_sett",
						"type" 		=> "sliderui" 
				);
$of_options[] = array(  "name" => "Post Content",
						"desc" 		=> "Select what you want to display on archive pages: full content or post excerpt",
						"id" => "post_content",
						"std" => "Post Excerpt",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("Post Excerpt", "Full Content"));

$of_options[] = array(  "name" => "Keep Extra Content on Secondary Pages",
						"desc" 		=> "Leave this option enabled to have Visual Composer content or extra content on secondary pages",
						"id" => "extra_content",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("yes" => "Yes", "no"=>"No"));

$of_options[] = array(  "name" => "Post Excerpt",
						"desc" 		=> "Enter the length of the Post Excerpt in words. E.g: 40 - means that the excerpt will show the first 40 words of each post.",
						"id" => "post_excerpt_length",
						"std" => "40",
						"collapse_sec"	=> "blog_sett",
						"type" => "text");

$of_options[] = array(  "name" => "Enable Sidebar",
						"desc" 		=> "Enable/disable sidebar for blog area.",
						"id" => "en_sidebar",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("yes"=>"Yes","no"=>"No"));

$of_options[] = array(  "name" => "Sticky Sidebar",
						"desc" 		=> "Enable/disable sticky sidebar on vertical scroll.",
						"id" => "sticky_sidebar",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "blog_sett",
						"type" => "switch");
				
$of_options[] = array(  "name" => "Sidebar Position",
						"desc" 		=> "Select the default position of the sidebar.",
						"id" => "sidebar_pos",
						"std" => "right",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("left","right"));

$of_options[] = array(  "name" => "Flexslider Auto Slideshow Timeout",
						"id" => "flexslider_slide_timeout",
						"desc" 		=> "Select the number of seconds for each Image to show. Select 0 to disable the SlideShow effect",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",						
						"max" 		=> "20",
						"collapse_sec"	=> "blog_sett",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Flexslider Arrows Style",
						"desc" => "Select the style of the Flexslider arrows",
						"id" => "flexslider_arrow",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("default" => "Default","minimal" => "Minimal", "custom" => "Custom"));

$of_options[] = array(  "name" =>  "Flexslider Arrows Custom Color",
						"id" => "flexslider_arrow_color",
						"std" => "#222222",						
						"desc" => "Select a custom color for the Flexslider Arrows. Only works if the Flexslider Arrows Style is set to Custom.",
						"collapse_sec"	=> "blog_sett",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Flexslider Arrows Custom Background Color",
						"id" => "flexslider_arrow_bg_color",
						"std" => "",						
						"desc" => "Select a custom background color for the Flexslider Arrows. Leave blank to not use a background color.  Only works if the Flexslider Arrows Style is set to Custom.",
						"collapse_sec"	=> "blog_sett",
						"type" => "color");	

$of_options[] = array(  "name" => "Posts Paginiation Position",
						"desc" 		=> "Select the position of the Posts Pagination",
						"id" => "posts_pagination",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("left" => "Left","center" => "Center", "right" => "Right"));

$of_options[] = array(  "name" => "Post Paginiation Customization",
						"desc" 		=> "Enable/disable custom styles for post pagination.",
						"id" => "en_custom_pag",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "blog_sett",
						"type" => "switch");	

$of_options[] = array(  "name" => "Left/Right Navigation Arrows",
						"desc" 		=> "Enable/disable left/right navigation arrows.",
						"id" => "en_navigation_arrows",
						"std" => "0",
						"fold" => "en_custom_pag",
						"collapse_sec"	=> "blog_sett",
						"type" => "switch");

$of_options[] = array(  "name" => "Pagination Style",
						"desc" 		=> "Select the pagination style",
						"id" => "pagination_style",
						"std" => "yes",
						"fold" => "en_custom_pag",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("default" => "Default","minimal" => "Minimal"));

$of_options[] = array(  "name" =>  "Pagination Text Color",
						"id" => "pagination_color",
						"std" => "",
						"fold" => "en_custom_pag",
						"collapse_sec"	=> "blog_sett",
						"desc" => "Select a custom color for the pagination text",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Pagination Link Color",
						"id" => "pagination_link_color",
						"std" => "",
						"fold" => "en_custom_pag",
						"collapse_sec"	=> "blog_sett",
						"desc" => "Select a custom color for the pagination links",
						"type" => "color");	
/*
$of_options[] = array(  "name" =>  "Pagination Link Color on hover",
						"id" => "pagination_link_color_hover",
						"std" => "",
						"fold" => "en_custom_pag",
						"desc" => "Select a custom color for the pagination links on hover effect",
						"type" => "color");	
*/
$of_options[] = array(  "name" =>  "Pagination Background & Border Color",
						"id" => "pagination_link_bg",
						"std" => "",
						"fold" => "en_custom_pag",
						"desc" => "Select a custom color for background of the pagination links. This will also be used for the border color",
						"collapse_sec"	=> "blog_sett",
						"type" => "color");	
/*
$of_options[] = array(  "name" =>  "Pagination Background & Border Color on hover",
						"id" => "pagination_link_bg_hover",
						"std" => "",
						"fold" => "en_custom_pag",
						"desc" => "Select a custom color for background and border color of the pagination links on hover effect",
						"type" => "color");	
*/
$of_options[] = array(  "name" => "Show Featured Images and Videos on Posts",
						"desc" 		=> "Globally Hide/Show Featured Images and Videos at the top of the page",
						"id" => "show_featured",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "blog_sett",
						"options" => array("yes" => "Yes","no" => "No"));



$of_options[] = array( 	"name" 		=> "dd_opt",
						"desc" 		=> "",
						"id" 		=> "dd_opt",
						"std" 		=> "<h3>Default Design Options</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
/*
$of_options[] = array(  "name" => "Post Content Inner Padding",
						"desc" => "Add an inner padding to the post content area. Leave 0 to not use any padding.",
						"id" => "post_content_padding",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);
*/
$of_options[] = array(  "name" =>  "Post Content Outer Background Color",
						"id" => "post_content_out_bg",
						"std" => "",
						"desc" => "Select a background color for the Outer Area of the Post Content. This setting will only affect Blog post and Blog page templates only. <br> Setting a color here will overwrite the Outer Background Color set under Theme options -> Basic Design -> Outer Background Color",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Post Content Inner Background Color",
						"id" => "post_content_bg",
						"desc" => "Specify a background color for the Inner Area of the Post Content. This setting will only affect Blog post and Blog page templates only. <br> Setting a color here will overwrite the Inner Background Color set under Theme options -> Basic Design -> Inner Background Color",
						"std" => "",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");	

$of_options[] = array(  "name" => "Post Meta Design",
						"desc" => "Select the Post Meta design",
						"id" => "post_meta_design",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "dd_opt",
						"options" => array("default"=>"Default","modern"=>"Modern"));

$of_options[] = array(  "name" => "Post Title and Meta Positioning",
						"desc" => "Select the Post Title and Meta positioning - will affect archive pages, page templates and single post pages",
						"id" => "post_meta_style",
						"std" => "below",
						"type" => "select",
						"collapse_sec"	=> "dd_opt",
						"options" => array("below"=>"Below Featured Images","above"=>"Above Featured Images"));

$of_options[] = array(  "name" => "Post Category location",
						"desc" 		=> "Select the position of the Category text`",
						"id" => "post_meta_category_pos",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "dd_opt",
						"options" => array( "default"=>"Below Post Title", "above"=>"Above Post Title" ));

$of_options[] = array(  "name" => "Post Title and Meta Align",
						"desc" 		=> "Select the Alignment of the Post Title and Meta on archive pages",
						"id" => "post_meta_align",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "dd_opt",
						"options" => array("left"=>"Left", "center"=>"Center "));



$of_options[] = array(  "name" => "Force Post Title Uppercase",
						"desc" 		=> "Enable/disable the post title uppercase .",
						"id" => "en_post_uppercase",
						"std" => "0",
						"collapse_sec"	=> "dd_opt",
						"type" => "switch");	

$of_options[] = array(  "name" =>  "Inside Post Separator color",
						"desc" => "This color option will affect all the separators inside the post content area - excluding the sidebar elements",
						"id" => "post_content_separator",						
						"std" => "",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");	

$of_options[] = array(  "name" => "Post Meta Font Size (px)",
						"desc" 		=> "Enter the font size for the Post Meta",
						"id" => "post_meta_font_size",
						"std" => "11",
						"collapse_sec"	=> "dd_opt",
						"type" => "text");

$of_options[] = array(  "name" => "Post Category Font Size (px)",
						"desc" 		=> "Enter the font size for the Post Category.<br> This will only affect the Category when the <strong>Post Category location</strong> is set as Above Post Title or the Modern option is selected under Post Meta Design.",
						"id" => "post_meta_categ_font_size",
						"std" => "11",
						"collapse_sec"	=> "dd_opt",
						"type" => "text");

$of_options[] = array(  "name" => "Post Meta Icons",
						"desc" 		=> "Enable/disable the post meta icons.",
						"id" => "en_post_icons",
						"std" => "1",
						"collapse_sec"	=> "dd_opt",
						"type" => "switch");

$of_options[] = array(  "name" => "Post Meta Text Uppercase",
						"desc" 		=> "Uppercase the Post Meta Text.",
						"id" => "post_meta_uppercase",
						"std" => "1",
						"collapse_sec"	=> "dd_opt",
						"type" => "switch");

$of_options[] = array(  "name" =>  "Post Meta Text Color",
						"desc" => "",
						"id" => "post_meta_color",						
						"std" => "#b5b8bf",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Post Meta Link Color",
						"desc" => "",
						"id" => "post_meta_link_color",						
						"std" => "#b5b8bf",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Post Meta Link Color on Hover",
						"desc" => "Leave blank if you want to inherit the Link Color set under Theme Options -> Link Color on Hover",
						"id" => "post_meta_link_color_hover",						
						"std" => "",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");

$of_options[] = array(  "name" => "Post Tags Font Size (px)",
						"id" 		=> "post_tags_font_size",
						"desc" 		=> "Enter the font size for the Post Tags",
						"std" => "11",
						"collapse_sec"	=> "dd_opt",
						"type" => "text");

$of_options[] = array(  "name" => "Show View More/Continue Reading",
						"desc" 		=> "Show view more/continue reading link on archives pages.",
						"id" => "show_view_more",
						"std" => "1",
						"folds" => "1",	
						"collapse_sec"	=> "dd_opt",					
						"type" => "switch");

$of_options[] = array(  "name" =>  "Social Sharing Icons Color",
						"desc" => "Leave blank to use the default colors.",
						"id" => "post_social_icons",						
						"std" => "",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Form Elements Background Color",
						"desc" => "Leave blank if you want to use a transparent background",
						"id" => "post_comment_bg",						
						"std" => "",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Form Elements Border Color",
						"desc" => "This option will affect the input fields and textarea elements",
						"id" => "post_comment_border",						
						"std" => "#ccc",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Form Elements Font Color",
						"desc" => "",
						"id" => "post_comment_color",						
						"std" => "#b2b2b6",
						"collapse_sec"	=> "dd_opt",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "page-templ",
						"desc" 		=> "",
						"id" 		=> "pt_ap_sett",
						"std" 		=> "<h3>Page Templates and Archive Pages</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info");

$of_options[] = array(  "name" => "Images Hover Effect",
						"desc" 		=> "Enable/disable the hover effect for images.",
						"id" => "en_hover_effect",
						"std" => "1",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "switch");

$of_options[] = array(  "name" => "Archives Post Title Html Tag",
						"id" => "archives_post_title_tag",
						"std" => "h2",
						"desc" => "Select the html tag to be used for the Post Title on Archives pages.",
						"type" => "select",
						"collapse_sec"	=> "pt_ap_sett",
						"options" => array("h1" => "H1", "h2" => "H2", "h3" => "H3", "h4" => "H4", "h5" => "H5"));

$of_options[] = array(  "name" => "Archives Post Title font size (px)",
						"desc" 		=> "Enter the font size for the Post Title on Archive Pages. Default: 26",
						"id" => "archives_post_title_font_size",
						"std" => "26",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "text");

$of_options[] = array(  "name" => "Archives Post Title line height ",
						"desc" 		=> "Enter the line height value for the Post Title on Archive Pages.",
						"id" => "archives_post_title_line_height",
						"std" => "",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "text");

$of_options[] = array(  "name" => "Archives Post Title font weight",
						"desc" 		=> "Enter the font weight for the Post Title on Archive Pages. Default: 400. ",
						"id" => "archives_post_title_font_weight",
						"std" => "400",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "text");

$of_options[] = array(  "name" =>  "Archives Posts Content Color",
						"desc" => "Specify a custom color for the posts content. Leave this option blank to inherit the default Body Font Color.",
						"id" => "archives_content_color",						
						"std" => "",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "color");	

$of_options[] = array(  "name" => "Archives Posts Content Font Size (px)",
						"desc" 		=> "Enter the font size for posts content. Leave blank to inherit the default Body Font Size.",
						"id" => "archives_content_font_size",
						"std" => "",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "text");

$of_options[] = array(  "name" => "Archives Posts Content Line Height",
						"desc" 		=> "Enter a custom value for the line height of the posts content. Leave blank to inherit the default Body Line Height.",
						"id" => "archives_content_line_height",
						"std" => "",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "text");

$of_options[] = array(  "name" => "Blog Style Big Image - Thumnbnails",
						"desc" 		=> "Select the size of the thumbnails used for the Blog Style Big Image template.",
						"id" => "big_layout_thumb",
						"std" => "full",
						"type" => "select",
						"collapse_sec"	=> "pt_ap_sett",
						"options" => array("full"=>"Full", "medium" => "Medium Thumbnails" ));						
						
$of_options[] = array(  "name" => "Archives Pages Style",
						"desc" 		=> "Select the blogposts style on search result pages, category pages, archives pages and tag pages.",
						"id" => "blog_images",
						"std" => "right",
						"type" => "select",
						"collapse_sec"	=> "pt_ap_sett",
						"options" => array("big"=>"Big Images", "small" => "Small Images", "grid" => "Grid Images", "masonry" => "Masonry Images" ));	

$of_options[] = array(  "name" => "Grid/Masonry Columns",
						"desc" 		=> "If Grid Images or Masonry Images is selected above, choose how many columns to use.",
						"id" => "grid_cols",
						"std" => "3",
						"type" => "select",
						"collapse_sec"	=> "pt_ap_sett",
						"options" => array("2"=>"2 Columns", "3" => "3 Columns", "4" => "4 Columns", "5" => "5 Columns" ));	

$of_options[] = array(  "name" =>  "Grid/Masonry Content Background Color",
						"desc" => "Select a background color for the content area of the Grid/Masonry Images",
						"id" => "grid_bg_color",						
						"std" => "",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "color");	

$of_options[] = array(  "name" => "Grid/Masonry Content Left/Right Padding",
						"id" => "grid_left_right_padding",
						"desc" => "This option controls the actual padding used for the content area of each Grid/Masonry Images element.",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "pt_ap_sett",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Big Images Content Padding",
						"id" => "big_images_content_padding",
						"desc" => "This option controls the actual padding/spacing used for the content area of each element using the Big Images template.",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",	
						"collapse_sec"	=> "pt_ap_sett",					
						"type" 		=> "sliderui" 
				);
$of_options[] = array(  "name" => "Big Image Articles Bottom Spacing",
						"id" => "big_images_bottom_spacing",
						"desc" => "This option controls the actual padding/spacing between each element using the Big Images template.",
						"std" 		=> "40",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",	
						"collapse_sec"	=> "pt_ap_sett",					
						"type" 		=> "sliderui" 
				);
$of_options[] = array(  "name" =>  "Big Images Content Background Color",
						"desc" => "Select a background color for the content area of each element using the Big Images template",
						"id" => "big_images_bg_color",						
						"std" => "",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "color");	

$of_options[] = array(  "name" => "Force Full Width",
						"desc" 		=> "Force Full Width style for search result pages, category pages, archive pages and tag pages.",
						"id" => "index_full_width",
						"std" => "no",
						"type" => "select",
						"collapse_sec"	=> "pt_ap_sett",
						"options" => array("no"=>"No","yes"=>"Yes"));

$of_options[] = array(  "name" => "Social Sharing Icons - Archive Pages",
						"desc" 		=> "Enable/disable social sharing icons on archive pages.",
						"id" => "social_icons_archives",
						"std" => "0",
						"collapse_sec"	=> "pt_ap_sett",
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "si_do",
						"desc" 		=> "",
						"id" 		=> "si_do",
						"std" 		=> "<h3>Small Images - Design Options</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Images Size",
						"desc" 		=> "Select the size of the thumbnails used for the Blog Style Small Images template.",
						"id" => "small_images_thumb",
						"std" => "small",
						"type" => "select",
						"collapse_sec"	=> "si_do",
						"options" => array("small"=>"Small Thumbnails (345x230 px)", "full" => "Full Thumbnails - original image size" ));	

$of_options[] = array(  "name" => "Images Width - in percents (%)",
						"id" => "small_image_width",
						"desc" => "This option controls the actual width of the images, when using the Small Images option",
						"std" 		=> "30",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "si_do",						
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Description Width - in percents (%)",
						"id" => "small_image_desc_width",
						"desc" => "This option controls the actual width of the description, when using the Small Images option",
						"std" 		=> "67",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "si_do",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Images Position",
						"desc" 		=> "Select the position of the Small Images.",
						"id" => "small_image_pos",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "si_do",
						"options" => array("default"=>"Left","right"=>"Right"));

$of_options[] = array(  "name" => "Articles Content Padding",
						"id" => "small_images_content_padding",
						"desc" => "This option controls the actual padding/spacing used for the content area of each element using the Small Images template.",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "si_do",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Articles Background Color",
						"desc" => "Set a custom background color for the content area of each element using Small Images template.",
						"id" => "small_images_bg_color",						
						"std" => "",
						"collapse_sec"	=> "si_do",
						"type" => "color");

$of_options[] = array(  "name" => "Articles Bottom Spacing",
						"id" => "small_images_bottom_spacing",
						"desc" => "This option controls the actual padding/spacing between each element using the Small Images template.",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "si_do",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Posts Separator",
						"desc" 		=> "Enable/disable a separator between posts",
						"id" => "small_images_separator",
						"std" => "0",
						"folds" => "1",
						"collapse_sec"	=> "si_do",
						"type" => "switch");

$of_options[] = array(  "name" =>  "Separator Color",
						"desc" => "Set a color for the separator.",
						"id" => "small_images_separator_color",						
						"std" => "#dddddd",
						"collapse_sec"	=> "si_do",
						"fold" => "small_images_separator",
						"type" => "color");

$of_options[] = array(  "name" => "Make First Post Full Width",
						"desc" 		=> "Enable this option to force only the First Post to be displayed in Full Width layout. <br>This option will work for: Small Images and Grid Images page styles. ",
						"id" => "show_first_post_big_layout",
						"std" => "0",
						"collapse_sec"	=> "si_do",
						"type" => "switch");											

$of_options[] = array( 	"name" 		=> "spp_opt",
						"desc" 		=> "",
						"id" 		=> "spp_opt",
						"std" 		=> "<h3>Single Post Page options</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
$of_options[] = array(  "name" => "Single Post Design",
						"desc" 		=> "Select the design to be used for the Single Post page",
						"id" => "single_post_design",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "spp_opt",
						"options" => array("default"=>"Default", "modern"=>"Modern", "manhattan" => "Manhattan"));

$of_options[] = array(  "name" => "Content Padding",
						"id" => "single_post_content_padding",
						"desc" => "This option controls the actual padding for the content of the Post.",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "200",
						"collapse_sec"	=> "spp_opt",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Single Post Title and Meta Align",
						"desc" 		=> "Select the Alignment of the Post Title and Meta on single post pages",
						"id" => "single_post_meta_align",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "spp_opt",
						"options" => array("left"=>"Left", "center"=>"Center "));

$of_options[] = array(  "name" => "Single Post Title Html Tag",
						"id" => "post_title_tag",
						"std" => "h2",
						"desc" => "Select the html tag to be used for the Post Title.",
						"type" => "select",
						"collapse_sec"	=> "spp_opt",
						"options" => array("h1" => "H1", "h2" => "H2", "h3" => "H3", "h4" => "H4", "h5" => "H5"));

$of_options[] = array(  "name" => "Single Post Title font size (px)",
						"desc" 		=> "Enter the font size for the Single Post Title. Default: 26",
						"id" => "post_title_font_size",
						"std" => "26",
						"collapse_sec"	=> "spp_opt",
						"type" => "text");

$of_options[] = array(  "name" => "Single Post Title line height ",
						"desc" 		=> "Enter the line height value for the Single Post Title.",
						"id" => "post_title_line_height",
						"std" => "",
						"collapse_sec"	=> "spp_opt",
						"type" => "text");

$of_options[] = array(  "name" => "Single Post Title font weight",
						"desc" 		=> "Enter the font weight for the Single Post Title. Default: 400. ",
						"id" => "post_title_font_weight",
						"std" => "400",
						"collapse_sec"	=> "spp_opt",
						"type" => "text");

$of_options[] = array(  "name" =>  "Single Post Title color",
						"desc" => "Set the color for the Single Post Title. Leave blank if you want to inherit the Body text color.",
						"id" => "post_title_color",						
						"std" => "#dddddd",
						"collapse_sec"	=> "spp_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Single Post Content Text color",
						"desc" => "Set a color for the Single Post Content. Leave blank if you want to inherit the Body text color.",
						"id" => "post_content_color",						
						"std" => "",
						"collapse_sec"	=> "spp_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Single Post Content Link color",
						"desc" => "Set a color for the links inside the Post Content area. Leave blank if you want to inherit the Link color option.",
						"id" => "post_content_link_color",						
						"std" => "",
						"collapse_sec"	=> "spp_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Single Post Content Link color on Hover",
						"desc" => "Set a color for the links on hover, inside the Post Content area. Leave blank if you want to inherit the Link color on hover option.",
						"id" => "post_content_link_color_hover",						
						"std" => "",
						"collapse_sec"	=> "spp_opt",
						"type" => "color");

$of_options[] = array(  "name" => "Content Links Text Decoration",
						"desc" 		=> "Enable/disable text decoration effect for links inside the Post Content area.",
						"id" => "post_content_link_decoration",
						"std" => "0",
						"collapse_sec"	=> "spp_opt",
						"type" => "switch");

$of_options[] = array(  "name" =>  "Single Post Meta Text Color",
						"desc" => "Set a color for the post meta text. Leave blank if you want to inherit the color set for the Post Meta Text on archive pages.",
						"id" => "single_post_meta_color",						
						"std" => "",
						"collapse_sec"	=> "spp_opt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Single Post Meta Link Color",
						"desc" => "Set a color for the post meta links. Leave blank if you want to inherit the color set for the Post Meta Link on archive pages.",
						"id" => "single_post_meta_link_color",						
						"std" => "",
						"collapse_sec"	=> "spp_opt",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "modern_pt",
						"desc" 		=> "",
						"id" 		=> "modern_pt",
						"std" 		=> "<h3>Single Post Title - Modern Design Layout ONLY</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "spt_explain",
						"desc" 		=> "",
						"id" 		=> "spt_explain",
						"std" 		=> 'The following settings will be applied for the Post Title when the Modern option is being selected under Single Post Design.',
						"icon" 		=> true,
						"collapse_sec"	=> "modern_pt",
						"type" 		=> "plain_text"
				);

$of_options[] = array(  "name" => "Single Post Title Area Height",
						"desc" 		=> "Select how the height of the Single Post area is calculated.",
						"id" => "single_post_height_option",
						"std" => "custom",
						"collapse_sec"	=> "modern_pt",
						"type" => "select",
						"options" => array(
							"custom"=>"Custom Height", 							
							"fullscreen"=>"Fullscreen Height"														
							)
						);

$of_options[] = array(  "name" => "Single Post Title Custom Height",
						"id" 		=> "single_post_custom_height",
						"desc" 		=> "Enter the a custom height for the Single Post area. Example: 500px or 30vh.",
						"std" => "500px",
						"collapse_sec"	=> "modern_pt",
						"type" => "text");

$of_options[] = array(  "name" => "Single Post Title &amp; Meta Positioning",
						"desc" 		=> "Select how the background for the Single Post is being generated.",
						"id" => "single_post_modern_pos",
						"std" => "middle",
						"type" => "select",
						"options" => array(
							"top"=>"Top", 
							//"custom_image_sitewide"=>"Custom Sitewide Image- set for all posts",
							"middle"=>"Middle",
							"bottom"=>"Bottom"							
							),
						"collapse_sec"	=> "modern_pt",
						);

$of_options[] = array(  "name" => "Single Post Title Background",
						"desc" 		=> "Select how the background for the Single Post is being generated.",
						"id" => "single_post_modern_background",
						"std" => "left",
						"type" => "select",
						"options" => array(
							"featured"=>"Featured Image", 
							//"custom_image_sitewide"=>"Custom Sitewide Image- set for all posts",
							"custom_image"=>"Custom Background Image",
							"custom_color"=>"Custom Background Color"							
							),
						"collapse_sec"	=> "modern_pt",
						);

$of_options[] = array( 	"name" 		=> "Custom Background Image",
						"desc" 		=> "If the Custom Background Image is selected in the Single Post Background option, you can upload the image you want to use here.<br> Each post can have a custom background image set individually",
						"id" 		=> "single_post_modern_custom_bg",						
						"std" 		=> "",
						"collapse_sec"	=> "modern_pt",
						"type" 		=> "upload"
				);

$of_options[] = array(  "name" => "Custom Background Image Repeat",
						"desc" 		=> "Select how the background image will be repeated over the Title area. Only use this with a pattern type of image.",
						"id" => "single_post_title_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"options" => array(
							"no-repeat"=>"No Repeat", 
							//"custom_image_sitewide"=>"Custom Sitewide Image- set for all posts",
							"repeat"=>"Repeat X and Y"														
							),
						"collapse_sec"	=> "modern_pt",
						);

$of_options[] = array(  "name" => "Fullscreen Background Image",
						"desc" 		=> "Enable/disable fullscreen background image effect.",
						"id" => "single_post_title_fullscreen",
						"std" => "1",
						"collapse_sec"	=> "modern_pt",
						"type" => "switch");

$of_options[] = array(  "name" => "Parallax effect for Background Image",
						"desc" 		=> "Enable/disable a parallax effect for the background image.",
						"id" => "single_post_title_parallax",
						"std" => "0",
						"collapse_sec"	=> "modern_pt",
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Custom Background Image Mask Color",
						"desc" 		=> "You can set a Mask Color which will be applied over the Custom Background Image. Leave this field blank if you don\'t want to use a Mask effect.",
						"id" 		=> "single_post_modern_mask_color",						
						"std" => "",
						"collapse_sec"	=> "modern_pt",
						"type" => "color"
				);

$of_options[] = array(  "name" => "Custom Background Image Mask Transparency",
						"id" => "single_post_modern_mask_transparency",
						"desc" => "If a Custom Background Image Mask Color is being used, you can specify the transparency of the mask. The higher the transparency value, the more visible the Custom Background Image will be.",
						"std" 		=> "70",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",	
						"collapse_sec"	=> "modern_pt",					
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "Custom Background Color",
						"desc" 		=> "If the Custom Background Color is selected in the Single Post Background option, you can specify it here. Each post can have a different Backgound Color set individually.",
						"id" 		=> "single_post_modern_custom_bg_color",						
						"std" => "",
						"collapse_sec"	=> "modern_pt",
						"type" => "color"
				);
/*
$of_options[] = array( 	"name" 		=> "modern-post-title",
						"desc" 		=> "",
						"id" 		=> "modern-post",
						"std" 		=> "",
						"icon" 		=> true,
						"type" 		=> "info_small"
				);
	*/	

$of_options[] = array( 	"name" 		=> "bp_navi",
						"desc" 		=> "",
						"id" 		=> "bp_navi",
						"std" 		=> "<h3>Single Post Navigation</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
$of_options[] = array(  "name" => "Blog Posts Navigation",
						"desc" 		=> "Enable/disable blog posts navigation.",
						"id" => "show_post_navi",
						"std" => "1",
						"folds" => "1",
						"collapse_sec"	=> "bp_navi",
						"type" => "switch");

$of_options[] = array(  "name" => "Blog Posts Navigation style",
						"desc" 		=> "Select the style used for the Blog Posts navigation.",
						"id" => "post_nav_style",
						"std" => "default",
						"fold" => "show_post_navi",
						"type" => "select",
						"collapse_sec"	=> "bp_navi",
						"options" => array("default"=>"Default","thumbs"=>"Using Thumbnails"));	


$of_options[] = array( 	"name" 		=> "bp_related",
						"desc" 		=> "",
						"id" 		=> "bp_related",
						"std" 		=> "<h3>Related Posts</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);
						
$of_options[] = array(  "name" => "Related Posts Enable/Disable",
						"desc" 		=> "Enable/disable related posts.",
						"id" => "related_posts",
						"std" => "1",						
						"collapse_sec"	=> "bp_related",
						"type" => "switch");

$of_options[] = array(  "name" => "Related Posts Image Size",
						"desc" 		=> "Select the image size used for Related Posts",
						"id" => "related_posts_img",
						"std" => "small",
						"type" => "select",
						"collapse_sec"	=> "bp_related",
						"options" => array("small"=>"Small - 345x230 px","original"=>"Original Image"));

$of_options[] = array(  "name" => "Related Posts Layout",
						"desc" 		=> "Select the layout for the Related Posts",
						"id" => "related_posts_layout",
						"std" => "horizontal",
						"type" => "select",
						"collapse_sec"	=> "bp_related",
						"options" => array("horizontal"=>"Horizontal","vertical"=>"Vertical"));
						
$of_options[] = array(  "name" => "Related Posts Count",
						"id" => "related_items",
						"std" 		=> "5",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "10",
						"collapse_sec"	=> "bp_related",						
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Related Posts - Item Title Font Size (px)",
						"id" 		=> "related_posts_font_size",
						"desc" 		=> "Enter the font size for the Related Posts. Default: 13",
						"std" => "13",
						"collapse_sec"	=> "bp_related",
						"type" => "text");

$of_options[] = array(  "name" => "Related Posts - Force Item Title Uppercase",
						"desc" 		=> "Enable/disable title uppercase for related posts items titles.",
						"id" => "related_posts_up",
						"std" => "0",
						"collapse_sec"	=> "bp_related",
						"type" => "switch");	


$of_options[] = array( 	"name" 		=> "show_pmeta",
						"desc" 		=> "",
						"id" 		=> "show_pmeta",
						"std" 		=> "<h3>Show Social Sharing Icons, Date, Author, Categories, Tags, Comments</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);						
						
$of_options[] = array(  "name" => "Show Social Sharing Icons",
						"desc" 		=> "Enable/disable social sharing icons on single post pages.",
						"id" => "social_icons",
						"std" => "1",
						"collapse_sec"	=> "show_pmeta",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Show Date",
						"desc" 		=> "Show date on archives pages and single post pages.",
						"id" => "show_date",
						"std" => "1",
						"collapse_sec"	=> "show_pmeta",
						"type" => "switch");												
						
$of_options[] = array(  "name" => "Show Author on Archive Pages",
						"desc" 		=> "Show author meta on archive pages.",
						"id" => "show_author",
						"std" => "1",
						"collapse_sec"	=> "show_pmeta",
						"type" => "switch");

$of_options[] = array(  "name" => "Show Author on Single Post Pages",
						"desc" 		=> "Show author on single post pages.",
						"id" => "show_author_single",
						"std" => "1",
						"collapse_sec"	=> "show_pmeta",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Show Categories",
						"desc" 		=> "Show categories meta on archives pages and single post pages.",
						"id" => "show_categories",
						"std" => "1",
						"collapse_sec"	=> "show_pmeta",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Show Tags",
						"desc" 		=> "Show post tags on archives pages and single post pages.",
						"id" => "show_tags",
						"std" => "1",
						"collapse_sec"	=> "show_pmeta",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Show Comments",
						"desc" 		=> "Show comments meta on archives pages and single post pages.",
						"id" => "show_comments",
						"std" => "1",
						"folds" => "1",		
						"collapse_sec"	=> "show_pmeta",				
						"type" => "switch");

$of_options[] = array(  "name" => "Comments Styling",
						"id" => "comments_style",
						"std" => "default",
						"fold" => "show_comments",
						"type" => "select",
						"collapse_sec"	=> "show_pmeta",
						"options" => array("default" => "Default", "modern"=> "Modern"));

$of_options[] = array( 	"name" 		=> "author_design",
						"desc" 		=> "",
						"id" 		=> "author_design",
						"std" 		=> "<h3>Author Options</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Author Picture on Single Post Pages",
						"desc" 		=> "You can upload your own custom picture for the Author to be used. If no image is being uploaded, the default Profile Picture will be used, generated from Gravatar.com",
						"id" 		=> "single_post_author_pic",						
						"std" 		=> "",
						"collapse_sec"	=> "author_design",
						"type" 		=> "upload"
				);

$of_options[] = array(  "name" => "Round Author Image",
						"desc" 		=> "Change the Author Image to become round. Disable this option to use the default picture shape.",
						"id" => "author_round",
						"std" => "1",
						"collapse_sec"	=> "author_design",
						"type" => "switch");

$of_options[] = array(  "name" => "Author Info Positioning",
						"id" => "author_pos",
						"std" => "left",						
						"type" => "select",
						"collapse_sec"	=> "author_design",
						"options" => array("left" => "Left", "center"=> "Center"));

$of_options[] = array( 	"name" 		=> "ss_icons",
						"desc" 		=> "",
						"id" 		=> "ss_icons",
						"std" 		=> "<h3>Social Sharing Icons</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Social Sharing Text",
						"id" 		=> "social_share_text",
						"desc" 		=> "Enter the text you want to use for Share this post. Default: Share this post",
						"std" => "Share this post",
						"collapse_sec"	=> "ss_icons",
						"type" => "text");

$of_options[] = array(  "name" => "Social Sharing Icons Design",
						"id" => "social_icons_design",
						"std" => "yes",
						"desc" => "Select the design of the Social Sharing icons on Single Post pages",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("default" => "Default", "vertical"=> "Vertical - with Sticky feature"));

$of_options[] = array(  "name" => "Share on Facebook",
						"id" => "share_facebook",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));

$of_options[] = array(  "name" => "Share on Twitter",
						"id" => "share_twitter",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));	

$of_options[] = array(  "name" => "Share on LinkedIn",
						"id" => "share_linkedin",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));	

$of_options[] = array(  "name" => "Share on Pinterest",
						"id" => "share_pinterest",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));																		

$of_options[] = array(  "name" => "Share on Reddit",
						"id" => "share_reddit",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));

$of_options[] = array(  "name" => "Share on Tumblr",
						"id" => "share_tumblr",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));

$of_options[] = array(  "name" => "Share on Google+",
						"id" => "share_gplus",
						"std" => "yes",
						"type" => "select",
						"collapse_sec"	=> "ss_icons",
						"options" => array("yes" => "Yes", "no"=> "No"));

$of_options[] = array( 	"name" 		=> "vm_cr",
						"desc" 		=> "",
						"id" 		=> "vm_cr",
						"std" 		=> "<h3>View More/Continue Reading link</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "View More/Continue Reading style",
						"desc" 		=> "Select the style for the view more/continue reading text",
						"id" => "view_more_style",
						"std" => "button",
						"type" => "select",
						"collapse_sec"	=> "vm_cr",
						"options" => array("button"=>"Button Link","text"=>"Text Link"));

$of_options[] = array(  "name" => "View More/Continue Reading Position",
						"desc" 		=> "Select the position of the View More/Continue Reading link. This will also affect the position of the Social Sharing Icons for Archive pages.",
						"id" => "view_more_position",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "vm_cr",
						"options" => array("default"=>"Left","right"=>"Right", "center" => "Center"));

$of_options[] = array(  "name" =>  "View More/Continue Reading Text Color",
						"desc" => "Select the color of the text",
						"id" => "view_more_color",						
						"std" => "#ffffff",
						"collapse_sec"	=> "vm_cr",
						"type" => "color");	

$of_options[] = array(  "name" =>  "View More/Continue Reading Background Color",
						"desc" => "Select the background color. Only works if Button Link style is selected",
						"id" => "view_more_bg_color",						
						"std" => "#5bc98c",
						"collapse_sec"	=> "vm_cr",
						"type" => "color");

$of_options[] = array(  "name" =>  "View More/Continue Reading Border Color",
						"desc" => "Select the border color. Only works if Button Link style is selected",
						"id" => "view_more_border_color",						
						"std" => "#5bc98c",
						"collapse_sec"	=> "vm_cr",
						"type" => "color");

$of_options[] = array(  "name" =>  "View More/Continue Reading Text Color on Hover",
						"desc" => "Select the color of the text on hover",
						"id" => "view_more_color_hover",						
						"std" => "#ffffff",
						"collapse_sec"	=> "vm_cr",
						"type" => "color");	

$of_options[] = array(  "name" =>  "View More/Continue Reading Background Color on Hover",
						"desc" => "Select the background color on hover. Only works if Button Link style is selected",
						"id" => "view_more_bg_color_hover",						
						"std" => "#479e85",
						"collapse_sec"	=> "vm_cr",
						"type" => "color");		

$of_options[] = array(  "name" =>  "View More/Continue Reading Border Color on Hover",
						"desc" => "Select the border color on hover. Only works if Button Link style is selected",
						"id" => "view_more_border_color_hover",						
						"std" => "#479e85",
						"collapse_sec"	=> "vm_cr",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "sdb_dsgn",
						"desc" 		=> "",
						"id" 		=> "sdb_dsgn",
						"std" 		=> "<h3>Sidebar Design</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Widgets Inner Padding",
						"id" => "widget_inner_padding",
						"desc" => "Specify a value for the inner padding of the widgets",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"collapse_sec"	=> "sdb_dsgn",						
						"type" 		=> "sliderui" 
				);	
$of_options[] = array(  "name" =>  "Widgets Background Color",
						"desc" => "Select a background color for the Sidebar Widgets. Leave blank if you don\'t want to use a custom background color.",
						"id" => "widget_bg_color",						
						"std" => "",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" => "Widgets Border Width",
						"id" => "widget_border_width",
						"desc" => "Specify a width for the Widgets Border. Leave 0 for no border",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "10",	
						"collapse_sec"	=> "sdb_dsgn",					
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Widgets Border Color",
						"desc" => "Select a border color for the Sidebar Widgets. Only works if the Widgets Border Width is set to 1 or more.",
						"id" => "widget_border_color",						
						"std" => "",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" =>  "Widgets Text Color",
						"desc" => "Select a custom color for the text inside Widgets. Leave blank this field empty to inherit the color set for the Body text color.",
						"id" => "widget_text_color",						
						"std" => "",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" => "Widget Content Font Size (px)",
						"id" 		=> "widget_content_font_size",
						"desc" 		=> "Enter the Font Size for content - this will not affect the links. Default: 14px",
						"std" => "13px",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" =>  "Widget Links Color",
						"desc" => "Select a custom color for the links inside Widgets. Leave blank this field empty to inherit the color set under Colors -> link Color.",
						"id" => "widget_link_color",						
						"std" => "",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" =>  "Widget Links Color on Hover",
						"desc" => "Select a custom color for the hover effect of links inside Widgets. Leave blank this field empty to inherit the color set under Colors -> link Color on Hover.",
						"id" => "widget_link_color_hover",						
						"std" => "",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" => "Widget Links Font Size (px)",
						"id" 		=> "widget_link_font_size",
						"desc" 		=> "Enter the Font Size for Links. Default: 14px",
						"std" => "14px",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" => "Widget Links Font Weight",
						"id" 		=> "widget_link_font_weight",
						"desc" 		=> "Enter the font weight for widget links. E.g: 300 or 400 or 600, or normal.",
						"std" => "normal",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" => "Widgets Content Align",
						"desc" 		=> "Select the alignment of the content inside Widgets",
						"id" => "widget_content_align",
						"std" => "left",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "select",
						"options" => array("left"=>"Left","center"=>"Center", "right" => "Right"));

$of_options[] = array(  "name" => "Widgets Bottom Margin (px)",
						"id" 		=> "widgets_bottom_margin",
						"desc" 		=> "Select the bottom margin for Widgets. Default: 45px",
						"std" => "45px",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" => "Force Widget Title Uppercase",
						"desc" 		=> "Enable/disable the widget title uppercase.",
						"id" => "en_widget_uppercase",
						"std" => "1",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "switch");

$of_options[] = array(  "name" =>  "Widget Title Font Color",
						"desc" => "",
						"id" => "widget_title_color",						
						"std" => "#21252b",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" => "Widget Title Alignment",
						"desc" 		=> "Select the alignment of the Widget Titles",
						"id" => "widget_title_align",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "sdb_dsgn",
						"options" => array("left"=>"Left","center"=>"Center", "right" => "Right"));

$of_options[] = array(  "name" =>  "Widget Title Bar Color",
						"desc" => "",
						"id" => "widget_title_bar_color",						
						"std" => "#ececec",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array(  "name" => "Widget Title Bar Thickness (px)",
						"id" 		=> "widget_title_bar_thick",
						"desc" 		=> "Select the Thickness for the Title Bar. Use 0 to not show any bar for the Widget Title",
						"std" 		=> "1",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "15",	
						"collapse_sec"	=> "sdb_dsgn",					
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" => "Widget Title Bar Position",
						"desc" 		=> "Select the Title Bar Position",
						"id" => "widget_title_bar_pos",
						"std" => "below",
						"type" => "select",
						"collapse_sec"	=> "sdb_dsgn",
						"options" => array("right"=>"Right of the Title","below"=>"Below Title"));

$of_options[] = array(  "name" => "Widget Title Bar Width",
						"desc" 		=> "Select the width of the Title Bar - only works if Below Title option is selected under Widget Title Bar Position",
						"id" => "widget_title_bar_width",
						"std" => "full",
						"type" => "select",
						"collapse_sec"	=> "sdb_dsgn",
						"options" => array("full"=>"Full Width","title"=>"Title Text Width"));

$of_options[] = array(  "name" => "Widget Title Bottom Padding (px)",
						"id" 		=> "widget_title_bar_bottom_padding",
						"desc" 		=> "Select the spacing between the Widget Title and the Bar - only works if Below Title option is selected under Widget Title Bar Position",
						"std" => "10",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" => "Widget Title Top Padding (px)",
						"id" 		=> "widget_title_bar_top_padding",
						"desc" 		=> "Select the spacing above the Widget Title - only works if Below Title option is selected under Widget Title Bar Position",
						"std" => "10",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" =>  "Widget Title Background Color",
						"desc" => "Set a color for the backgrund of the Widget Title. Leave blank to not use a background color.",
						"id" => "widget_title_bg_color",						
						"std" => "#fcfcfc",		
						"collapse_sec"	=> "sdb_dsgn",				
						"type" => "color");

$of_options[] = array(  "name" => "Widget Title Bottom Margin (px)",
						"id" 		=> "widget_title_bar_bottom_margin",
						"desc" 		=> "Select the spacing between the Widget Title and the Widget Content",
						"std" => "20",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "text");

$of_options[] = array(  "name" => "Show Caret Icon for Links",
						"desc" 		=> "Show or hide the caret icon for links inside the sidebar. Select no to not show any caret icon to the left of the links.",
						"id" => "show_caret_links",
						"std" => "no",
						"type" => "select",
						"collapse_sec"	=> "sdb_dsgn",
						"options" => array("default"=>"Yes", "no"=>"No"));

$of_options[] = array(  "name" => "Enable separator between ul->li elements",
						"desc" 		=> "Enable/disable a solid separator between ul->li elements. Useful if you want to separate your categories, archives, post links in the sidebar.",
						"id" => "en_widget_separator",
						"std" => "1",
						"folds" => "1",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "switch");

$of_options[] = array(  "name" =>  "Separator color",
						"desc" => "Set a color for the separator between ul->li elements",
						"id" => "ul_li_separator_color",						
						"std" => "#f2f2f2",
						"fold" => "en_widget_separator",
						"collapse_sec"	=> "sdb_dsgn",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "ftr_inst",
						"desc" 		=> "",
						"id" 		=> "ftr_inst",
						"std" 		=> "<h3>Footer Instagram Widget</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Instagram Footer Widget",
						"desc" 		=> "Enable this option to create a Instangram Widget above the footer Area.",
						"id" => "en_instagram_footer",
						"std" => "0",
						"folds" => "1",
						"collapse_sec"	=> "ftr_inst",
						"type" => "switch");

$of_options[] = array(  "name" => "Instagram Username",
						"desc" 		=> "Enter here your instagram username. E.g: travelmagazine",
						"id" => "instagram_username",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" => "text");

$of_options[] = array(  "name" => "Instagram Heading Title",
						"desc" 		=> "Leave blank for no Heading Title.",
						"id" => "instagram_footer_title",
						"std" => "Follow on Instagram",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" => "text");

$of_options[] = array(  "name" => "Heading Title Position",
						"desc" 		=> "Select the positio of the Heading Title",
						"id" => "instagram_title_pos",
						"fold" => "en_instagram_footer",
						"std" => "above",
						"type" => "select",
						"collapse_sec"	=> "ftr_inst",
						"options" => array("above"=>"Above Images", "over"=>"Over Images"));

$of_options[] = array(  "name" => "Instagram Heading Title Link",
						"desc" 		=> "Enter a link to your Instagram Profile.",
						"id" => "instagram_footer_title_link",
						"std" => "",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" => "text");

$of_options[] = array(  "name" => "Heading Title Font Size",
						"id" => "instagram_footer_title_font_size",
						"std" 		=> "15",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "50",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Heading Title Color",
						"id" => "instagram_footer_title_color",
						"std" => "#ffffff",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Heading Title Background Color",
						"id" => "instagram_footer_title_bg_color",
						"std" => "",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" => "color");	

$of_options[] = array(  "name" => "Heading Title Padding Top",
						"id" => "instagram_footer_title_padding_top",
						"std" 		=> "10",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Heading Title Padding Bottom",
						"id" => "instagram_footer_title_padding_bottom",
						"std" 		=> "10",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"fold" => "en_instagram_footer",
						"collapse_sec"	=> "ftr_inst",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Photo Sizes",
						"desc" 		=> "Select the size of the pictures used to populate the instagram widget",
						"id" => "instagram_size",
						"fold" => "en_instagram_footer",
						"std" => "small",
						"type" => "select",
						"collapse_sec"	=> "ftr_inst",
						"options" => array("thumbnail"=>"Thumbnail", "small"=>"Small","large"=>"Large","original"=>"Original"));

$of_options[] = array(  "name" => "Open Images",
						//"desc" 		=> "Select the size of the pictures used to populate the instagram widget",
						"id" => "instagram_links",
						"fold" => "en_instagram_footer",
						"std" => "prettyphoto",
						"type" => "select",
						"collapse_sec"	=> "ftr_inst",
						"options" => array("_self"=>"Same Window","_blank"=>"New Window", "prettyphoto"=>"Pretty Photo - same window"));

$of_options[] = array( 			
						"std" 		=> "<h3>Social Links Widget</h3>",
						"icon" 		=> true,
						"id"		=> "sc_lnk",
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" =>  "Social Links Widget - icons color",
						"desc" => "Leave blank to use the default colors.",
						"id" => "side_social_links_color",						
						"std" => "",
						"collapse_sec"	=> "sc_lnk",
						"type" => "color");

$of_options[] = array(  "name" =>  "Social Links Widget - icons background color",
						"desc" => "Leave blank to use the default colors.",
						"id" => "side_social_links_bg",						
						"std" => "",
						"collapse_sec"	=> "sc_lnk",
						"type" => "color");

$of_options[] = array(  "name" => "Social Links Widget - icons shape",
						"desc" 		=> "Select the shape to use for the Social Links widget - only works if a background color is selected for the Icons Background Color above.",
						"id" => "side_social_links_shape",
						"std" => "full",
						"collapse_sec"	=> "sc_lnk",
						"type" => "select",
						"options" => array("square"=>"Square","round"=>"Round", "circle"=>"Circle"));

$of_options[] = array(  "name" => "Social Links Widget - icons size",
						"desc" 		=> "Select the Size of the Social Links icons",
						"id" => "side_social_links_size",
						"std" => "normal",
						"type" => "select",
						"collapse_sec"	=> "sc_lnk",
						"options" => array("normal"=>"Normal", "small"=>"Small", "large"=>"Large"));

$of_options[] = array( 			
						"std" 		=> "<h3>Categories Widget</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"id"		=> "categ_wdg",
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Categories Widget Content Position",
						"desc" 		=> "Select the content position of the Categories Widget. Leave Default to inherit the setting under Widgets Content Align option.",
						"id" => "categ_widget_pos",
						"std" => "default",
						"type" => "select",
						"collapse_sec"	=> "categ_wdg",
						"options" => array("default"=>"Default","left"=>"Left"));

$of_options[] = array(  "std" 		=> "<h3>MailChimp for WordPress Widget</h3>",						
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"id"		=> "mc_wdg",
						"type" 		=> "info" );

$of_options[] = array(  "name" =>  "Mailchimp Background Color",
						"desc" => "Select a custom color for the Mailchimp Widget.",
						"id" => "mc_bg_color",						
						"std" => "",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" => "Mailchimp Padding Left/Right",
						"id" 		=> "mc_padding_lr",
						"desc" 		=> "Select the padding left/right for the Mailchimp widget.",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",	
						"collapse_sec"	=> "mc_wdg",					
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" => "Mailchimp Padding Top/Bottom",
						"id" 		=> "mc_padding_tb",
						"desc" 		=> "Select the padding top/bottom for the Mailchimp widget.",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",
						"collapse_sec"	=> "mc_wdg",						
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" =>  "Mailchimp Label Color",
						"desc" => "Select a custom color for the labels inside Mailchimp Widget.",
						"id" => "mc_label_color",						
						"std" => "",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" => "Mailchimp Label Font Size (px)",
						"id" 		=> "mc_label_font_size",
						"desc" 		=> "Enter the font size for the labels used inside the Mailchimp Widget. Default: 13",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "30",
						"collapse_sec"	=> "mc_wdg",						
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" => "Mailchimp Label Font Style",
						"desc" 		=> "Select the font style for the labels.",
						"id" => "mc_label_font_style",
						"std" => "normal",
						"type" => "select",
						"collapse_sec"	=> "mc_wdg",
						"options" => array("normal"=>"Normal", "italic" => "Italic" ));	

$of_options[] = array(  "name" => "Mailchimp Label bottom margin (px)",
						"id" 		=> "mc_label_margin",
						"desc" 		=> "Select the bottom margin for labels.",
						"std" 		=> "5",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",	
						"collapse_sec"	=> "mc_wdg",					
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" =>  "Mailchimp Input Fields Border Color",
						"desc" => "Select the border color of the input fields inside the Mailchimp Widget.",
						"id" => "mc_input_border_color",						
						"std" => "",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Mailchimp Input Fields Background Color",
						"desc" => "Select the background color of the input fields inside the Mailchimp Widget.",
						"id" => "mc_input_bg_color",						
						"std" => "",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" => "Mailchimp Input Fields Font Size (px)",
						"id" 		=> "mc_input_font_size",
						"desc" 		=> "Select the font size for the Input Fields.",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "5",
						"max" 		=> "100",	
						"collapse_sec"	=> "mc_wdg",					
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" =>  "Mailchimp Input Fields Font Color",
						"desc" => "Select the font color of the input fields inside the Mailchimp Widget.",
						"id" => "mc_input_font_color",						
						"std" => "",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Mailchimp Submit Button Background Color",
						"desc" => "Select the background color of the submit button",
						"id" => "mc_submit_bg",						
						"std" => "#222222",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Mailchimp Submit Button Background Color on Hover",
						"desc" => "Select the background color on hover of the submit button",
						"id" => "mc_submit_bg_hover",						
						"std" => "#4c4c4c",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Mailchimp Submit Button Text Color",
						"desc" => "Select the text color of the submit button",
						"id" => "mc_submit_color",						
						"std" => "#FFFFFF",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Mailchimp Submit Button Text Color on Hover",
						"desc" => "Select the text color on hover of the submit button",
						"id" => "mc_submit_color_hover",						
						"std" => "#FFFFFF",
						"collapse_sec"	=> "mc_wdg",
						"type" => "color");

$of_options[] = array(  "name" => "Mailchimp Submit Button Size",
						"desc" 		=> "Select the size of the Submit Button",
						"id" => "mc_submit_size",
						"std" => "normal",
						"type" => "select",
						"collapse_sec"	=> "mc_wdg",
						"options" => array("normal"=>"Normal", "full" => "Full Width" ));	

$of_options[] = array(  "std" 		=> "<h3>About Me Widget</h3>",
						"id" 		=> "am_wdg",						
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,						
						"type" 		=> "info" );

$of_options[] = array(  "name" =>  "Heading Color",						
						"id" => "about_heading_color",						
						"std" => "",
						"collapse_sec"	=> "am_wdg",
						"type" => "color");

$of_options[] = array(  "name" => "Heading Font Size (px)",
						"id" 		=> "about_heading_font_size",
						"desc" 		=> "Select the font size for the About Me Heading.",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "50",	
						"collapse_sec"	=> "am_wdg",					
						"type" 		=> "sliderui" );

$of_options[] = array(  "name" => "Heading Font Weight",
						"desc" 		=> "Enter the font weight for the About Me Heading text. E.g: 400,500,600,700",
						"id" => "about_heading_font_weight",
						"std" => "",
						"collapse_sec"	=> "am_wdg",
						"type" => "text");

$of_options[] = array(  "name" =>  "Description Color",						
						"id" => "about_description_color",						
						"std" => "",
						"collapse_sec"	=> "am_wdg",
						"type" => "color");

$of_options[] = array(  "name" => "Description Font Size (px)",
						"id" 		=> "about_description_font_size",
						"desc" 		=> "Select the font size for the About Me Heading.",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "50",	
						"collapse_sec"	=> "am_wdg",					
						"type" 		=> "sliderui" );

$of_options[] = array(  "std" 		=> "<h3>Twitter Feed Widget</h3>",
						"icon" 		=> true,
						"id" 		=> "tw_wdg",
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info" );

$of_options[] = array(  "name" =>  "Twitter Feed Widget - icon color",
						"desc" => "Select a custom color for the Twitter Fedd Icon. Leave blank to use the default colors.",
						"id" => "side_twitter_color",						
						"std" => "",
						"collapse_sec"	=> "tw_wdg",
						"type" => "color");

$of_options[] = array(  "std" 		=> "<h3>Contact Us Widget</h3>",
						"icon" 		=> true,
						"id" 		=> "ctc_wdg",
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info" );

$of_options[] = array(  "name" =>  "Contact Us Widget - icons color",
						"desc" => "Select a custom color for the Contact Us icons. Leave blank to use the default colors.",
						"id" => "side_contact_color",						
						"std" => "",
						"collapse_sec"	=> "ctc_wdg",
						"type" => "color");

$of_options[] = array(  "std" 		=> "<h3>Recent Portfolio Widget</h3>",
						"icon" 		=> true,
						"id" 		=> "rc_port_wdg",
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info" );

$of_options[] = array(  "name" => "Recent Portfolio Widget - Thumnbnails Size",
						"desc" 		=> "Select the size of the thumbnails used for the Recent Portfolio Widget.",
						"id" => "recent_portfolio_widget_thumb",
						"std" => "small",
						"collapse_sec"	=> "rc_port_wdg",
						"type" => "select",
						"options" => array("small"=>"Small", "large" => "Large" ));	

$of_options[] = array(  "std" 		=> "<h3>Recent Posts Widget</h3>",
						"icon" 		=> true,
						"id" 		=> "rc_posts_wdg",
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info" );

$of_options[] = array(  "name" => "Recent Posts Widget - Thumnbnails Size",
						"desc" 		=> "Select the size of the thumbnails used for the Recent Posts Widget.",
						"id" => "recent_posts_widget_thumb",
						"std" => "small",
						"type" => "select",
						"collapse_sec"	=> "rc_posts_wdg",
						"options" => array("small"=>"Small", "large" => "Large" ));	

$of_options[] = array(  "name" => "Recent Posts Widget - Title Font Size (px)",
						"desc" 		=> "Enter the font size for the Title of the Recent Posts Widget. Default: 13",
						"id" => "recent_posts_widget_font_size",
						"std" => "13",
						"collapse_sec"	=> "rc_posts_wdg",
						"type" => "text");

$of_options[] = array(  "name" => "Recent Posts Widget - Date Font Size (px)",
						"desc" 		=> "Enter the font size for the Date of the Recent Posts Widget. Default: 11",
						"id" => "recent_posts_widget_date_size",
						"std" => "11",
						"collapse_sec"	=> "rc_posts_wdg",
						"type" => "text");
				
$of_options[] = array( 	"name" 		=> "Portfolio",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "port_sett",
						"desc" 		=> "",
						"id" 		=> "port_sett",
						"std" 		=> "<h3>Portfolio Settings</h3>Customize the Portfolio area",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Portfolio Details Custom Text",
						"desc" 		=> "Enable this option if you want to change the default texts used for Portfolio Details. Will only appear on the Front End.",
						"id" => "pd_custom",
						"std" => "0",
						"folds" =>"1",
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Client name",
						"desc" 		=> "Enter the text you want to use instead of Client name",
						"id" 		=> "client_name_custom",
						"std" 		=> "Client name",
						"fold" => "pd_custom",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Skills",
						"desc" 		=> "Enter the text you want to use instead of Skills",
						"id" 		=> "skills_custom",
						"std" 		=> "Skills",
						"fold" => "pd_custom",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Category",
						"desc" 		=> "Enter the text you want to use instead of Category",
						"id" 		=> "category_custom",
						"std" 		=> "Category",
						"fold" => "pd_custom",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Website",
						"desc" 		=> "Enter the text you want to use instead of Website",
						"id" 		=> "website_custom",
						"std" 		=> "Website",
						"fold" => "pd_custom",
						"type" 		=> "text"
				);																				
				
$of_options[] = array(  "name" => "Portfolio Slug",
						"desc" => "Change/Rewrite the permalink when you use the permalink type as %postname%.<strong>Make sure to regenerate permalinks.</strong>",
						"id" => "portfolio_slug",
						"std" => "portfolio-items",
						"type" => "text");					
				
$of_options[] = array( 	"name" 		=> "Project Details Text",
						"desc" 		=> "Enter the text you want to use for Project Details. Default is: Project Details.<br />Leave empty if you don't want to show anything.",
						"id" 		=> "project_details_text",
						"std" 		=> "Project Details",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Project Description Text",
						"desc" 		=> "Enter the text you want to use for Project Description. Default is: Project Description.<br />Leave empty if you don't want to show anything.",
						"id" 		=> "project_description_text",
						"std" 		=> "Project Description",
						"type" 		=> "text"
				);										
				
$of_options[] = array(  "name" => "Portfolio Items Count",
						"id" => "portfolio_items",
						"std" 		=> "10",						
						"type" 		=> "text",
						"desc" 		=> "Enter how many portfolio items to show. Enter -1 to show all your posts on one page.", 
				);

$of_options[] = array(  "name" => "Portfolio Navigation",
						"desc" 		=> "Enable/disable portfolio navigation.",
						"id" => "show_port_navi",
						"std" => "1",
						"type" => "switch");


						
$of_options[] = array(  "name" => "Show Project Date",
						"desc" 		=> "Enable/Disable project date on single portfolio pages.",
						"id" => "project_date",
						"std" => "1",
						"type" => "switch");										
				
$of_options[] = array(  "name" => "Show Project Details",
						"desc" 		=> "Enable/Disable project details on single portfolio pages.",
						"id" => "project_details",
						"std" => "1",
						"type" => "switch");

$of_options[] = array(  "name" => "Show Social Sharing Icons",
						"desc" 		=> "Enable/Disable social sharing icons on single portfolio pages.",
						"id" => "port_social_icons",
						"std" => "1",
						"type" => "switch");							
						
$of_options[] = array(  "name" => "Show Related Projects",
						"desc" 		=> "Enable/Disable related projects on single portfolio pages.",
						"id" => "related_projects",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Related Projects Count",
						"id" => "portfolio_related_items",
						"std" 		=> "5",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "10",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Portfolio Design",
						"desc" 		=> "Select the design of the Portfolio items - will affect Portfolio page templates using the Flat design and single portfolio items",
						"id" => "single_portfolio_style",
						"std" => "default",
						"type" => "select",
						"options" => array("default"=>"Default", "modern" => "Modern" ));

$of_options[] = array(  "name" =>  "Portfolios Background Color",
						"desc" => "Select a custom background color for the Portfolios - will affect portfolio categories, portfolio page templates and single portfolio items",
						"id" => "single_portfolio_bg_color",
						"std" => "",
						"type" => "color");	

$of_options[] = array(  "name" => "Category Page Excerpt Length",
						"desc" 		=> "Enter the length of the Portfolio Excerpt in words. E.g: 40 - means that the excerpt will show the first 40 words of each portfolio post, on the category page.",
						"id" => "portfolio_excerpt_length",
						"std" => "40",
						"type" => "text");

$of_options[] = array(  "name" => "Category Page Design",
						"desc" 		=> "Select the design of the Portfolio Category",
						"id" => "portfolio_categ_style",
						"std" => "modern",
						"type" => "select",
						"options" => array("modern"=>"Modern", "default" => "Default" ));

$of_options[] = array( 	"name" 		=> "modern-port",
						"desc" 		=> "",
						"id" 		=> "modern-port-id",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Modern Portfolio Template</h3>
						Here you can modify the design options for the Modern Portfolio Template",
						"icon" 		=> true,
						"type" 		=> "info"
				);	

$of_options[] = array(  "name" =>  "Active Filter Color",
						"desc" => "Select the color of the Active Filter",
						"id" => "port_active_filt_color",
						"std" => "#000000",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Inactive Filter Color",
						"desc" => "Select the color of the Inactive Filter",
						"id" => "port_inactive_filt_color",
						"std" => "#9b9b9b",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Portfolio Background Color on Hover",
						"desc" => "Select the background color of the Modern Portfolio Template on hover",
						"id" => "port_modern_bg_color",
						"std" => "#ffffff",
						"type" => "color");	

$of_options[] = array(  "name" => "Portfolio Background Opacity",
						"desc" => "Set the background color opacity.",
						"id" => "port_modern_bg_opac",
						"std" 		=> "100",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Portfolio Title Color",
						"desc" => "Select the color of the Portfolio Title",
						"id" => "port_modern_title_color",
						"std" => "#9e9e9e",
						"type" => "color");

$of_options[] = array(  "name" => "Portfolio Title Font Size",
						"desc" => "Select the font size of the Portfolio Title.",
						"id" => "port_modern_title_fs",
						"std" 		=> "17",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Category Color",
						"desc" => "Select the color of the Portfolio Category",
						"id" => "port_modern_categ_color",
						"std" => "#4e5ee9",
						"type" => "color");

$of_options[] = array(  "name" => "Category Font Size",
						"desc" => "Select the font size of the Category.",
						"id" => "port_modern_categ_fs",
						"std" 		=> "17",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",						
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "single-port",
						"desc" 		=> "",
						"id" 		=> "single-port-id",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Single Portfolio Page</h3>
						Here you can modify the design options for the actual SIngle Portfolio page",
						"icon" 		=> true,
						"type" 		=> "info"
				);		

$of_options[] = array(  "name" =>  "Portfolio Title Color",
						"desc" => "Select a custom color for the Portfolio Title",
						"id" => "sp_title",
						"std" => "",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Portfolio Content Color",
						"desc" => "Select a custom color for the Portfolio Content",
						"id" => "sp_content",
						"std" => "",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Portfolio Details Text Color",
						"desc" => "Select a custom color for the Portfolio Details Text",
						"id" => "sp_details",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Portfolio Details Links Color",
						"desc" => "Select a custom color for the Portfolio Details Links",
						"id" => "sp_link",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Social Share Icons Background Color",
						"desc" => "Select a custom background color for the Social Share Icons",
						"id" => "sp_share_bg",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Social Share Icons Font Color",
						"desc" => "Select a custom font color for the Social Share Icons",
						"id" => "sp_share_font",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Social Share Icons Border Color",
						"desc" => "Select a custom border color for the Social Share Icons",
						"id" => "sp_share_border",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Share Text Color",
						"desc" => "Select a custom font color for the Share text - available for the Modern Portfolio Design",
						"id" => "sp_share_text",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Portfolio Date Color",
						"desc" => "Select a custom color for the Portfolio Date",
						"id" => "sp_date",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Modern Portfolio Details Background Color",
						"desc" => "Select a custom background color for the Modern Portfolio Details section",
						"id" => "sp_modern_details_bg",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Default Portfolio Separators Color",
						"desc" => "Select a custom color for the Default Portfolio separators",
						"id" => "sp_separators",
						"std" => "",
						"type" => "color");

$of_options[] = array(  "name" =>  "Related Projects Text Color",
						"desc" => "Select a custom color for the Related Projects text color",
						"id" => "sp_related_text",
						"std" => "",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "Events Calendar",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "ev_sett",
						"desc" 		=> "",
						"id" 		=> "ev_sett",
						"std" 		=> "<h3>Events Calendar Settings</h3>Customize the Events Calendar",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" =>  "Events Calendar Main Color",
						"desc" => "",
						"id" => "events_main_color",
						"std" => "#2f852e",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "bbPress Options",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "bb_sett",
						"desc" 		=> "",
						"id" 		=> "bb_sett",
						"std" 		=> "<h3>bbPress Forum Settings</h3>Customize the Forum pages",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" =>  "bbPress Main Color",
						"desc" => "",
						"id" => "bbpress_main_color",
						"std" => "#5bc98c",
						"type" => "color");	

$of_options[] = array(  "name" =>  "bbPress Heading Text Color",
						"desc" => "",
						"id" => "bbpress_heading_text_color",
						"std" => "#ffffff",
						"type" => "color");	

$of_options[] = array(  "name" => "bbPress Enable Sidebar",
						"desc" 		=> "Enable/Disable sidebar on bbPress pages.",
						"id" => "bbpress_sidebar",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");

$of_options[] = array( "name" => "Woocommerce Sidebar Select",
						"desc" => "Select the sidebar that will be used on your bbPress forum page.",
						"id" => "bbpress_sidebar_select",
						"std" => "bbPress Sidebar",
						"type" => "select",
						"fold" => "bbpress_sidebar",
						"options" => $sidebar_options
					);	

				
$of_options[] = array( 	"name" 		=> "WooCommerce",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "woo_general",
						"desc" 		=> "",
						"id" 		=> "woo_general",
						"std" 		=> "<h3>WooCommerce General Settings</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord admin_expand",
						"collapse"	=> true,
						"type" 		=> "info"
				);	


$of_options[] = array(  "name" => "WooCommerce Deactivate on Non-Shop Pages",
						"desc" 		=> "Enable this option if you don't want the woocommerce styles & javascript to be loaded on pages where WooCommerce is not used - recommended for speed optimization.",
						"id" => "disable_woocommerce",
						"std" => "0",	
						"collapse_sec"	=> "woo_general",					
						"type" => "switch");

$of_options[] = array(  "name" => "Product Image Zoom on Mouse Hover",
						"desc" 		=> "Enable/disable the product zoom when users will hover the mouse over a product image - only on the Single Product page",
						"id" => "product_image_zoom",
						"std" => "1",	
						"collapse_sec"	=> "woo_general",						
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Products per Page",
						"desc" 		=> "Select how many products to display per page",
						"id" 		=> "products_per_page",
						"std" 		=> "10",
						"collapse_sec"	=> "woo_general",	
						"type" 		=> "text"
				);	

$of_options[] = array(  "name" => "WooCommerce Image Size on Shop & Archives",
						"id" => "woo_image_size",
						"std" => "right",
						"desc" => "Select the size of the images used on Shop and Archive pages. <br>If <strong>Catalog Image</strong> is selected, the image will be using the width and height defined under WooCommerce -> Settings -> Products -> Display -> Catalog Images.",
						"type" => "select",
						"collapse_sec"	=> "woo_general",							
						"options" => array("full" => "Full Image","catalog" => "Catalog Image"));

$of_options[] = array(  "name" => "Show Secondary Image on Hover",
						"id" => "woo_second_image",
						"std" => "no",
						"desc" => "Select Yes to show the secondary featured image set for your Product.",
						"type" => "select",	
						"collapse_sec"	=> "woo_general",						
						"options" => array("no" => "No","yes" => "Yes"));

$of_options[] = array( 	"name" 		=> "WooCommerce Content Padding",
						"desc" => "Use the slider to specify a padding for the content area",
						"id" => "woo_content_padding",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",
						"collapse_sec"	=> "woo_general",	
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "WooCommerce Content Outer Background Color",
						"desc" => "Set a color for the outer background. Leave blank to not use any background color for the Outer Background.",
						"id" => "woo_outer_bg",
						"std" => "",
						"collapse_sec"	=> "woo_general",	
						"type" => "color");

$of_options[] = array(  "name" =>  "WooCommerce Content Inner Background Color",
						"desc" => "Set a color for the inner background. Leave blank to not use any background color for the Inner Background.",
						"id" => "woo_inner_bg",
						"std" => "",
						"collapse_sec"	=> "woo_general",	
						"type" => "color");

$of_options[] = array( 	"name" 		=> "woo_sdb",
						"desc" 		=> "",
						"id" 		=> "woo_sdb",
						"std" 		=> "<h3>WooCommerce Sidebar</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "WooCommerce Enable Sidebar",
						"desc" 		=> "Enable/Disable sidebar on WooCommerce pages.",
						"id" => "woocommerce_sidebar_en",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_sdb",
						"type" => "switch");
						
$of_options[] = array( "name" => "Woocommerce Sidebar Select",
						"desc" => "Select the sidebar that will be added to your shop.",
						"id" => "woocommerce_archive_sidebar",
						"std" => "None",
						"type" => "select",
						"fold" => "woocommerce_sidebar_en",
						"collapse_sec"	=> "woo_sdb",
						"options" => $sidebar_options
					);		

$of_options[] = array(  "name" => "WooCommerce Sidebar on Product Page",
						"desc" 		=> "Disable this option if you don't want to have a sidebar on Product Pages",
						"id" => "woocommerce_sidebar_product_en",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_sdb",
						"type" => "switch");	

$of_options[] = array( "name" => "Woocommerce Sidebar Select for Product Pages",
						"desc" => "Select the sidebar that will be used for Product Pages. This option is usefull if you want to have a different sidebar for your Product Pages",
						"id" => "woocommerce_product_sidebar",
						"std" => "WooCommerce Sidebar",
						"type" => "select",
						"fold" => "woocommerce_sidebar_product_en",
						"collapse_sec"	=> "woo_sdb",
						"options" => $sidebar_options
					);																			
				
$of_options[] = array(  "name" => "WooCommerce Sidebar Position",
						"id" => "woocommerce_sidebar_pos",
						"std" => "right",
						"type" => "select",						
						"collapse_sec"	=> "woo_sdb",
						"options" => array("left" => "Left","right" => "Right"));

$of_options[] = array( 	"name" 		=> "woo_header_login",
						"desc" 		=> "",
						"id" 		=> "woo_header_login",
						"std" 		=> "<h3>WooCommerce Login in Header</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array(  "name" => "WooCommerce Login/Register in Top Menu",
						"desc" 		=> "Enable/Disable WooCommerce Login/Register Link in Top Menu <br>A menu must be assigned as Top Menu under Appearance -> Menus.",
						"id" => "woocommerce_login_top_menu",
						"std" => "0",						
						"collapse_sec"	=> "woo_header_login",
						"type" => "switch");

$of_options[] = array(  "name" => "WooCommerce Login/Register in Primary Menu",
						"desc" 		=> "Enable/Disable WooCommerce Login/Register Link in Primary Menu <br>A menu must be assigned as Primary Menu under Appearance -> Menus.",
						"id" => "woocommerce_login_primary_menu",
						"std" => "0",						
						"collapse_sec"	=> "woo_header_login",
						"type" => "switch");

$of_options[] = array(  "name" => "WooCommerce Login/Register Icon",
						"desc" 		=> "Enable/Disable WooCommerce Login/Register Icon",
						"id" => "woocommerce_login_icon",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_header_login",
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Icon Code - Fontawesome",
						"desc" 		=> "Enter the icon code to be used. Default: fa fa-user",
						"id" 		=> "woocommerce_login_icon_render",
						"std" 		=> "fa fa-user",
						"collapse_sec"	=> "woo_header_login",
						"fold" 		=> "woocommerce_login_icon",
						"type" 		=> "text"
				);	

$of_options[] = array(  "name" =>  "Login Form Background Color",
						"desc" => "Set the background color for the Login Form",
						"id" => "woo_head_login_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Form Text Color",
						"desc" => "Set the default text color for the Login Form",
						"id" => "woo_head_login_text",
						"std" => "#333333",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Form Input Field Border Color",
						"desc" => "Set the border color for the Input Fields",
						"id" => "woo_head_login_input_border",
						"std" => "#eeeeee",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Form Input Field Background Color",
						"desc" => "Set the background color for the Input Fields",
						"id" => "woo_head_login_input_background",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Form Input Field Text Color",
						"desc" => "Set the text color for the Input Fields",
						"id" => "woo_head_login_input_text",
						"std" => "#333333",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");
/* Login Form Button */
$of_options[] = array(  "name" =>  "Login Button Background Color",
						"desc" => "",
						"id" => "woo_head_login_button_bg",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Button Border Color",
						"desc" => "",
						"id" => "woo_head_login_button_border",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Button Text Color",
						"desc" => "",
						"id" => "woo_head_login_button_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Button Background Color on Hover",
						"desc" => "",
						"id" => "woo_head_login_button_bg_hover",
						"std" => "#000000",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Button Border Color on Hover",
						"desc" => "",
						"id" => "woo_head_login_button_border_hover",
						"std" => "#000000",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Login Button Text Color on Hover",
						"desc" => "",
						"id" => "woo_head_login_button_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

/* Register Button */
$of_options[] = array(  "name" =>  "Register Button Background Color",
						"desc" => "",
						"id" => "woo_head_register_button_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Register Button Border Color",
						"desc" => "",
						"id" => "woo_head_register_button_border",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Register Button Text Color",
						"desc" => "",
						"id" => "woo_head_register_button_color",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Register Button Background Color on Hover",
						"desc" => "",
						"id" => "woo_head_register_button_bg_hover",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Register Button Border Color on Hover",
						"desc" => "",
						"id" => "woo_head_register_button_border_hover",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array(  "name" =>  "Register Button Text Color on Hover",
						"desc" => "",
						"id" => "woo_head_register_button_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_login",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "woo_header_shop",
						"desc" 		=> "",
						"id" 		=> "woo_header_shop",
						"std" 		=> "<h3>Header Shopping Cart</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);		

$of_options[] = array(  "name" => "Shopping Cart Icon in Header Menu",
						"desc" 		=> "Enable this option if you want to have a Shopping Cart Icon displayed in the Header Menu. When users will hover over the icon, the content of the Cart will be shown",
						"id" => "woo_cart",
						"std" => "0",	
						"folds" => "1",	
						"collapse_sec"	=> "woo_header_shop",				
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Shopping Cart Icon Code ",
						"desc" 		=> "Enter the icon code to be used. Default: icon-shop. <br/> Can also be fontawesome icon: fa fa-shopping-cart",
						"id" 		=> "woocommerce_cart_icon_render",
						"std" 		=> "icon-shop",
						"fold" 		=> "woo_cart",
						"collapse_sec"	=> "woo_header_shop",
						"type" 		=> "text"
				);

$of_options[] = array(  "name" => "Shopping Cart Icon Product Count",
						"desc" 		=> "Enable this option if you want to have a Shopping Cart Icon displayed in the Header Menu to also show the number of products currently in your cart.",
						"id" => "woo_cart_count",
						"std" => "1",		
						"collapse_sec"	=> "woo_header_shop",				
						"type" => "switch");

$of_options[] = array(  "name" =>  "Shopping Cart Icon - Product in Cart Counter Background Color",
						"desc" => "Set the background color for the Product in Cart Counter",
						"id" => "woo_cart_prod_count_bg",
						"std" => "#c92e2e",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

$of_options[] = array(  "name" =>  "Shopping Cart Icon - Product in Cart Counter Text Color",
						"desc" => "Set the text color for the Product in Cart Counter",
						"id" => "woo_cart_prod_count_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Shopping Cart Product Title Color",
						"desc" => "Set the link color of the Product Title",
						"id" => "woo_header_product_title_color",
						"std" => "#777777",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");		

$of_options[] = array(  "name" =>  "Shopping Cart Product Title Color on Hover",
						"desc" => "Set the link color on hover for the Product Title",
						"id" => "woo_header_product_title_color_hover",
						"std" => "#777777",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");		

$of_options[] = array( 	"name" 		=> "Shopping Cart Product Title Font Size",
						"desc" => "Set the font size of the Product Title. Default is 11",
						"id" => "woo_header_product_title_font_size",
						"std" 		=> "11",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "woo_header_shop",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Shopping Cart Product Quantity and Price Color",
						"desc" => "Set the color of the Product Quantity and Price Color",
						"id" => "woo_header_product_quantity_price_color",
						"std" => "#21252b",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");		

$of_options[] = array( 	"name" 		=> "Shopping Cart Product Quantity and Price Font Size",
						"desc" => "Default is 13",
						"id" => "woo_header_product_quantity_price_font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"collapse_sec"	=> "woo_header_shop",
						"type" 		=> "sliderui" 
				);

/* View Cart Button */

$of_options[] = array(  "name" =>  "View Cart Button - Background Color",
						"desc" => "Set the backgroud color of the View Cart button",
						"id" => "woo_header_view_cart_bg",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Button - Border Color",
						"desc" => "Set the border color of the View Cart button",
						"id" => "woo_header_view_cart_border",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "View Cart Button - Text Color",
						"desc" => "Set the text color of the View Cart button",
						"id" => "woo_header_view_cart_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "View Cart Button - Background Color on Hover",
						"desc" => "Set the backgroud color on Hover of the View Cart button",
						"id" => "woo_header_view_cart_bg_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Button - Border Color on Hover",
						"desc" => "Set the border color on Hover of the View Cart button",
						"id" => "woo_header_view_cart_border_hover",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "View Cart Button - Text Color on Hover",
						"desc" => "Set the text color on Hover of the View Cart button",
						"id" => "woo_header_view_cart_text_hover",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

/* Checkout Button */

$of_options[] = array(  "name" =>  "Checkout Button - Background Color",
						"desc" => "Set the backgroud color of the Checkout button",
						"id" => "woo_header_checkout_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Button - Border Color",
						"desc" => "Set the border color of the Checkout button",
						"id" => "woo_header_checkout_border",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button - Text Color",
						"desc" => "Set the text color of the Checkout button",
						"id" => "woo_header_checkout_text",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button - Background Color on Hover",
						"desc" => "Set the backgroud color on Hover of the Checkout button",
						"id" => "woo_header_checkout_bg_hover",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Button - Border Color on Hover",
						"desc" => "Set the border color on Hover of the Checkout button",
						"id" => "woo_header_checkout_border_hover",
						"std" => "#222222",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button - Text Color on Hover",
						"desc" => "Set the text color on Hover of the Checkout button",
						"id" => "woo_header_checkout_text_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");

/* Separator and other options */	

$of_options[] = array(  "name" =>  "Total Text Color",
						"desc" => "Set the color for the total text",
						"id" => "woo_header_total_text_color",
						"std" => "#333333",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Total Price Color",
						"desc" => "Set the color for the total price",
						"id" => "woo_header_total_price_color",
						"std" => "#333333",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");											

$of_options[] = array(  "name" =>  "Shopping Cart Separator Color",
						"desc" => "Set the color of the Separator",
						"id" => "woo_header_shopping_cart_separator",
						"std" => "#f1f1f1",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Shopping Cart Backgrund Color",
						"desc" => "Set the background color of the Shopping Cart",
						"id" => "woo_header_shopping_cart_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_header_shop",
						"type" => "color");		

$of_options[] = array( 	"name" 		=> "Shopping Cart Area Width",
						"desc" => "Set the width of the Shopping Cart Area Width.",
						"id" => "woo_header_width",
						"std" 		=> "220",
						"min" 		=> "100",
						"step"		=> "10",
						"max" 		=> "600",
						"collapse_sec"	=> "woo_header_shop",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array( 	"name" 		=> "woo_def_button",
						"desc" 		=> "",
						"id" 		=> "woo_def_button",
						"std" 		=> "<h3>WooCommerce Default Button</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "woo_bt_explain",
						"desc" 		=> "",
						"id" 		=> "woo_bt_explain",
						"std" 		=> 'Use these settings here to change the colors of the buttons used on WooCommerce pages: cart, checkout, account, etc. This settings will not affect the Add to Cart button on Single Product Page',
						"icon" 		=> true,
						"collapse_sec"	=> "woo_def_button",
						"type" 		=> "plain_text"
				);

$of_options[] = array(  "name" =>  "Button Text Color",
						"desc" => "Set the text color of the button",
						"id" => "woo_default_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_def_button",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Button Background Color",
						"desc" => "Set the background color of the button",
						"id" => "woo_default_bg",
						"std" => "#333333",
						"collapse_sec"	=> "woo_def_button",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Button Border Color",
						"desc" => "Set the border color of the button",
						"id" => "woo_default_border",
						"std" => "#333333",
						"collapse_sec"	=> "woo_def_button",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Button Text Color on Hover",
						"desc" => "Set the text color of the button on hover",
						"id" => "woo_default_text_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_def_button",
						"type" => "color");

$of_options[] = array(  "name" =>  "Button Background Color on Hover",
						"desc" => "Set the background color of the button",
						"id" => "woo_default_bg_hover",
						"std" => "#555555",
						"collapse_sec"	=> "woo_def_button",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Button Border Color on Hover",
						"desc" => "Set the border color of the button",
						"id" => "woo_default_border_hover",
						"std" => "#555555",
						"collapse_sec"	=> "woo_def_button",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "woo_check_butt",
						"desc" 		=> "",
						"id" 		=> "woo_check_butt",
						"std" 		=> "<h3>WooCommerce Checkout Button</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "woo_chk_explain",
						"desc" 		=> "",
						"id" 		=> "woo_chk_explain",
						"std" 		=> 'Use these settings here to change the colors of the Checkout Button - on the checkout page.',
						"icon" 		=> true,
						"collapse_sec"	=> "woo_check_butt",
						"type" 		=> "plain_text"
				);

$of_options[] = array(  "name" =>  "Checkout Button Text Color",
						"desc" => "Set the text color of the Checkout button",
						"id" => "woo_checkout_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_check_butt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button Background Color",
						"desc" => "Set the background color of the Checkout button",
						"id" => "woo_checkout_bg",
						"std" => "#333333",
						"collapse_sec"	=> "woo_check_butt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button Border Color",
						"desc" => "Set the border color of the Checkout button",
						"id" => "woo_checkout_border",
						"std" => "#333333",
						"collapse_sec"	=> "woo_check_butt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button Text Color on Hover",
						"desc" => "Set the text color of the Checkout button on hover",
						"id" => "woo_checkout_text_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_check_butt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Button Background Color on Hover",
						"desc" => "Set the background color of the Checkout button",
						"id" => "woo_checkout_bg_hover",
						"std" => "#555555",
						"collapse_sec"	=> "woo_check_butt",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Checkout Button Border Color on Hover",
						"desc" => "Set the border color of the Checkout button",
						"id" => "woo_checkout_border_hover",
						"std" => "#555555",
						"collapse_sec"	=> "woo_check_butt",
						"type" => "color");											

$of_options[] = array( 	"name" 		=> "woo_prod_pg",
						"desc" 		=> "",
						"id" 		=> "woo_prod_pg",
						"std" 		=> "<h3>WooCommerce Product Page Design & Functionality</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "woo_prod_pg_explain",
						"desc" 		=> "",
						"id" 		=> "woo_prod_pg_explain",
						"std" 		=> 'Use these settings here to change the design and functionality of the Product Page.',
						"icon" 		=> true,
						"collapse_sec"	=> "woo_prod_pg",
						"type" 		=> "plain_text"
				);

$of_options[] = array(  "name" => "Product Title Html Heading Tag",
						"id" => "woo_prod_title_tag",
						"std" => "h2",
						"desc" => "Select the Html Heading tag used for the Product Title",
						"type" => "select",	
						"collapse_sec"	=> "woo_prod_pg",
						"options" => array("h1" => "H1", "h2" => "H2", "h3" => "H3", "h4" => "H4", "h5" => "H5"));

$of_options[] = array( 	"name" 		=> "Product Title Font Size (px)",
						"desc" => "Default is 20",
						"id" => "woo_single_prod_title_font_size",
						"std" 		=> "20",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_prod_pg",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Product Title Font Weight",
						"id" => "woo_single_prod_title_font_weight",
						"std" => "500",
						"type" => "select",
						"collapse_sec"	=> "woo_prod_pg",
						"options" => array(300,400,500, 600,700,800,900));	

$of_options[] = array(  "name" =>  "Product Title Color",
						"desc" => "Set the color of the Product Title",
						"id" => "woo_single_prod_title_color",
						"std" => "#333333",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Product Review Stars Color",
						"desc" => "Set the color of the Product Review Stars",
						"id" => "woo_single_prod_stars_color",
						"std" => "#fdca00",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Product Price Font Size (px)",
						"desc" => "Default is 16",
						"id" => "woo_single_prod_price_font_size",
						"std" 		=> "16",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_prod_pg",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Product Price Color",
						"desc" => "Set the color of the Product Price",
						"id" => "woo_single_prod_price_color",
						"std" => "#222222",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Product on Sale Regular Price Color",
						"desc" => "Set the color of the Product on Sale Regular Price",
						"id" => "woo_single_prod_sale_regular_price_color",
						"std" => "#ccc",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Add to Cart Button Text Color",
						"desc" => "Set the text color for the Add to Cart Button",
						"id" => "woo_single_prod_add_cart_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Add to Cart Button Background Color",
						"desc" => "Set the background color for the Add to Cart Button",
						"id" => "woo_single_prod_add_cart_bg",
						"std" => "#111111",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Add to Cart Button Border Color",
						"desc" => "Set the border color for the Add to Cart Button",
						"id" => "woo_single_prod_add_cart_border",
						"std" => "#111111",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Add to Cart Button Text Color on Hover",
						"desc" => "Set the text color for the Add to Cart Button on Hover",
						"id" => "woo_single_prod_add_cart_color_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Add to Cart Button Background Color on Hover",
						"desc" => "Set the background color for the Add to Cart Button on Hover",
						"id" => "woo_single_prod_add_cart_bg_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Add to Cart Button Border Color on Hover",
						"desc" => "Set the border color for the Add to Cart Button on Hover",
						"id" => "woo_single_prod_add_cart_border_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Quantity Buttons Background Color on Hover",
						"desc" => "Set the background color for the Quantity Buttons on Hover",
						"id" => "woo_qty_button_bg_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");

$of_options[] = array(  "name" => "Show Product Availability",
						"desc" 		=> "Enable/Disable product availability",
						"id" => "woo_single_prod_stock",
						"std" => "0",
						"folds" => 1,
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "switch");

$of_options[] = array(  "name" => "Show Product Stock Quantity",
						"desc" 		=> "Enable/Disable product stock quantity",
						"id" => "woo_single_prod_stock_qty",
						"std" => "0",
						"fold" => "woo_single_prod_stock",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "switch");

$of_options[] = array(  "name" => "Product Sharing",
						"desc" 		=> "Enable/Disable product sharing",
						"id" => "woo_product_share",
						"std" => "0",	
						"collapse_sec"	=> "woo_prod_pg",					
						"type" => "switch");

$of_options[] = array(  "name" => "Product Tabs Style",
						"id" => "woocommerce_tabs_style",
						"std" => "right",
						"type" => "select",		
						"collapse_sec"	=> "woo_prod_pg",				
						"options" => array("style1" => "Style 1", "style2" => "Style 2", "style3" => "Style 3", "style4" => "Style 4"));

$of_options[] = array(  "name" =>  "Product Tabs - Active Tab Border",
						"desc" => "Set the border color of the Active Tab",
						"id" => "woocommerce_tabs_active",
						"std" => "#333333",
						"collapse_sec"	=> "woo_prod_pg",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "woo_categ_page",
						"desc" 		=> "",
						"id" 		=> "woo_categ_page",
						"std" 		=> "<h3>WooCommerce Categories Page</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Animate Categories on Hover",
						"desc" 		=> "Enable/Disable animation effect when hovering mouse over Product Categories .",
						"id" => "woo_categs_animation",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_categ_page",
						"type" => "switch");

$of_options[] = array( 	"name" 		=> "Categories Title Font Size (px)",
						"desc" => "Default is 15",
						"id" => "woo_categs_title_font_size",
						"std" 		=> "15",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_categ_page",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Categories Title Color",
						"desc" => "Set the color of the Category Titles",
						"id" => "woo_categs_title",
						"std" => "#333333",
						"collapse_sec"	=> "woo_categ_page",
						"type" => "color");

$of_options[] = array(  "name" =>  "Categories Title Background Color",
						"desc" => "Set the background color of the Category Titles",
						"id" => "woo_categs_title_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_categ_page",
						"type" => "color");

$of_options[] = array(  "name" => "Products Count",
						"desc" 		=> "Enable/Disable the product count next to category titles.",
						"id" => "woo_categs_pr_count",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_categ_page",
						"type" => "switch");
																																					

$of_options[] = array( 	"name" 		=> "woo_archive_pg",
						"desc" 		=> "",
						"id" 		=> "woo_archive_pg",
						"std" 		=> "<h3>Archive Products Design</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Product Title Font Size",
						"desc" => "Default is 13",
						"id" => "woo_archive_title",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_archive_pg",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Product Title Font Weight",
						"id" => "woo_archive_title_font_weight",
						"std" => "500",
						"type" => "select",
						"collapse_sec"	=> "woo_archive_pg",
						"options" => array(300,400,500, 600,700,800,900));	

$of_options[] = array(  "name" =>  "Product Title Color",
						"desc" => "",
						"id" => "woo_archive_title_color",
						"std" => "#333333",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Product Title Color on Hover",
						"desc" => "",
						"id" => "woo_archive_title_color_hover",
						"std" => "#5bc98c",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "Product Price Font Size",
						"desc" => "Default is 15",
						"id" => "woo_archive_price",
						"std" 		=> "15",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_archive_pg",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" =>  "Product Price Color",
						"desc" => "",
						"id" => "woo_archive_price_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Product on Sale Price Color",
						"desc" => "",
						"id" => "woo_archive_product_sale_color",
						"std" => "#5bc98c",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Product on Sale - Regular Price Color",
						"desc" => "",
						"id" => "woo_archive_product_sale_regular_color",
						"std" => "#cccccc",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Product on Sale Badge Text Color",
						"desc" => "",
						"id" => "woo_archive_product_sale_badge_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Product on Sale Badge Background Color",
						"desc" => "",
						"id" => "woo_archive_product_sale_badge_bg",
						"std" => "#5bc98c",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");

$of_options[] = array(  "name" => "Product Details Text Align",						
						"id" => "woo_archive_text_align",
						"std" => "left",
						"type" => "select",
						"collapse_sec"	=> "woo_archive_pg",
						"options" => array("left"=> "Left", "center" => "Center", "right" => "Right"));

$of_options[] = array( 	"name" 		=> "Product Details Padding Top/Bottom",
						"desc" => "Default is 10",
						"id" => "woo_archive_padding_tb",
						"std" 		=> "10",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",
						"collapse_sec"	=> "woo_archive_pg",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "Product Details Padding Left/Right",
						"desc" => "Default is 15",
						"id" => "woo_archive_padding_lr",
						"std" 		=> "15",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "100",
						"collapse_sec"	=> "woo_archive_pg",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Product Details Background Color",
						"desc" => "",
						"id" => "woo_archive_product_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");

$of_options[] = array(  "name" => "Product Has Border",						
						"id" => "woo_archive_border",
						"std" => "Yes",
						"type" => "select",
						"collapse_sec"	=> "woo_archive_pg",
						"options" => array("yes"=> "Yes", "no" => "No"));

$of_options[] = array(  "name" =>  "Product Border Color",
						"desc" => "Only works if Product Border is set to Yes",
						"id" => "woo_archive_product_border_color",
						"std" => "#e1e1e1",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");	

$of_options[] = array(  "name" =>  "Product Stars Color",
						"desc" => "Set the color of the stars used for reviewed products",
						"id" => "woo_archive_product_star",
						"std" => "#444444",
						"collapse_sec"	=> "woo_archive_pg",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "woo_table_hd",
						"desc" 		=> "",
						"id" 		=> "woo_table_hd",
						"std" 		=> "<h3>WooCommerce Tables Headings</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" =>  "Table Headings Background Color",
						"desc" => "Set the background color of the Table Headings",
						"id" => "woo_table_head_bg",
						"std" => "#333333",
						"collapse_sec"	=> "woo_table_hd",
						"type" => "color");

$of_options[] = array(  "name" =>  "Table Headings Text Color",
						"desc" => "Set the text color of the Table Headings",
						"id" => "woo_table_head_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_table_hd",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "price_flt",
						"desc" 		=> "",
						"id" 		=> "price_flt",
						"std" 		=> "<h3>Price Filter Widget</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" =>  "Left/Right Handles Color",
						"desc" => "Set the color of handles in the Price Filter widget",
						"id" => "woo_price_filter_handle",
						"std" => "#f5f5f5",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Horizontal Range Bar Color",
						"desc" => "Set the color of the horizontal range bar ",
						"id" => "woo_price_filter_range_color",
						"std" => "#444444",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Price Text Color",
						"desc" => "Set the color of the price filtering",
						"id" => "woo_price_filter_color",
						"std" => "#333333",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Filter Button Text Color",
						"desc" => "Set the color of Filter Button Text on Hover",
						"id" => "woo_price_filter_button_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Filter Button Text Color on Hover",
						"desc" => "Set the color of Filter Button Text on Hover",
						"id" => "woo_price_filter_button_text_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Filter Button Background Color",
						"desc" => "Set the background color of Filter Button",
						"id" => "woo_price_filter_button_bg",
						"std" => "#222222",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array(  "name" =>  "Filter Button Background Color on Hover",
						"desc" => "Set the background color of Filter Button on Hover",
						"id" => "woo_price_filter_button_bg_hover",
						"std" => "#444444",
						"collapse_sec"	=> "price_flt",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "woo_cart_wdg",
						"desc" 		=> "",
						"id" 		=> "woo_cart_wdg",
						"std" 		=> "<h3>Cart Widget </h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Remove Product Icon",
						"desc" 		=> "Enable/Disable the Remove Product from Cart Icon for each product added in the Cart.",
						"id" => "woo_cw_remove",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "switch");

$of_options[] = array(  "name" => "Product Image in Cart",
						"desc" 		=> "Enable/Disable the product image for each product added in the Cart.",
						"id" => "woo_cw_image",
						"std" => "1",
						"folds" => 1,
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "switch");

$of_options[] = array(  "name" =>  "Product in Cart Title Color",
						"desc" => "Set the color of title for each product added in the Cart.",
						"id" => "woo_cw_title",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Product in Cart Title Color on Hover",
						"desc" => "Set the color of title on hover for each product added in the Cart.",
						"id" => "woo_cw_title_hover",
						"std" => "#666666",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Products in Cart Separator Color",
						"desc" => "Set the color of the separator for each product added in the Cart.",
						"id" => "woo_cw_separator",
						"std" => "#eeeeee",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Products Quantity Text Color",
						"desc" => "Set the color of the quantity text for each product added in the Cart.",
						"id" => "woo_cw_quantity",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Products Price Text Color",
						"desc" => "Set the color of the price text for each product added in the Cart.",
						"id" => "woo_cw_products_price",
						"std" => "#f96e5b",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Subtotal Text Color",
						"desc" => "Set the color of the Subtotal text.",
						"id" => "woo_cw_subtotal_text",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Subtotal Price Text Color",
						"desc" => "Set the color of the Subtotal Price text.",
						"id" => "woo_cw_subtotal_price",
						"std" => "#f96e5b",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

/* View Cart Button style on Cart Widget  */

$of_options[] = array(  "name" =>  "View Cart Text Color",
						"desc" => "Set the text color of the View Cart button.",
						"id" => "woo_cw_vc_text",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Border Color",
						"desc" => "Set the border color of the View Cart button.",
						"id" => "woo_cw_vc_border",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Background Color",
						"desc" => "Set the background color of the View Cart button.",
						"id" => "woo_cw_vc_bg",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Text Color on Hover",
						"desc" => "Set the text color on hover of the View Cart button.",
						"id" => "woo_cw_vc_text_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Border Color on hover",
						"desc" => "Set the border color on hover of the View Cart button.",
						"id" => "woo_cw_vc_border_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "View Cart Background Color on Hover",
						"desc" => "Set the background color on hover of the View Cart button.",
						"id" => "woo_cw_vc_bg_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");


/* Checkout Button style on Cart Widget */

$of_options[] = array(  "name" =>  "Checkout Text Color",
						"desc" => "Set the text color of the Checkout button.",
						"id" => "woo_cw_ck_text",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Border Color",
						"desc" => "Set the border color of the Checkout button.",
						"id" => "woo_cw_ck_border",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Background Color",
						"desc" => "Set the background color of the Checkout button.",
						"id" => "woo_cw_ck_bg",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Text Color on Hover",
						"desc" => "Set the text color on hover of the Checkout button.",
						"id" => "woo_cw_ck_text_hover",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Border Color on hover",
						"desc" => "Set the border color on hover of the Checkout button.",
						"id" => "woo_cw_ck_border_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Checkout Background Color on Hover",
						"desc" => "Set the background color on hover of the Checkout button.",
						"id" => "woo_cw_ck_bg_hover",
						"std" => "#333333",
						"collapse_sec"	=> "woo_cart_wdg",
						"type" => "color");

$of_options[] = array( 	"name" 		=> "woo_footer_wdg",
						"desc" 		=> "",
						"id" 		=> "woo_footer_wdg",
						"std" 		=> "<h3>Footer Widgets Design</h3>",
						"icon" 		=> true,
						"class" 	=>"hide_me admin_accord",
						"collapse"	=> true,
						"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Footer Widget Product Title Font Size",
						"desc" => "Default is 13",
						"id" => "footer_woo_prod_title",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Footer Widget Product Title Font Weight",
						"id" => "footer_woo_prod_title_weight",
						"std" => "400",
						"type" => "select",
						"collapse_sec"	=> "woo_footer_wdg",
						"options" => array(300,400,500, 600,700,800,900));	

$of_options[] = array(  "name" =>  "Footer Widget Product Title color",
						"desc" => "Set the color of the product title",
						"id" => "footer_woo_prod_title_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" => "color");											

$of_options[] = array( 	"name" 		=> "Footer Widget Product Price Font Size",
						"desc" => "Default is 14",
						"id" => "footer_woo_prod_price",
						"std" 		=> "14",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" 		=> "sliderui" 
				);	

$of_options[] = array(  "name" => "Footer Widget Product Price Font Weight",
						"id" => "footer_woo_prod_price_weight",
						"std" => "600",
						"type" => "select",
						"collapse_sec"	=> "woo_footer_wdg",
						"options" => array(300,400,500, 600,700,800,900));

$of_options[] = array(  "name" =>  "Footer Widget Product Price color",
						"desc" => "Set the color of the price",
						"id" => "footer_woo_prod_price_color",
						"std" => "#ffffff",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" => "color");							

$of_options[] = array( 	"name" 		=> "Footer Widget Product Old Price Font Size",
						"desc" => "Default is 12",
						"id" => "footer_woo_prod_old_price",
						"std" 		=> "12",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "60",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" =>  "Footer Widget Product Old Price color",
						"desc" => "Set the color of the old price - only works for products with special/sale price",
						"id" => "footer_woo_prod_old_price_color",
						"std" => "#777777",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Footer Widget Product Review Stars Color",
						"desc" => "Set the color of the stars used for reviewed products",
						"id" => "footer_woo_prod_stars",
						"std" => "#eeeeee",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" => "color");

$of_options[] = array(  "name" =>  "Footer Widget Product List separator",
						"desc" => "Set the color of the separator",
						"id" => "footer_woo_prod_separator",
						"std" => "#eeeeee",
						"collapse_sec"	=> "woo_footer_wdg",
						"type" => "color");
				
$of_options[] = array( 	"name" 		=> "Social Media",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "soc_sett",
						"desc" 		=> "",
						"id" 		=> "soc_sett",
						"std" 		=> "<h3>Social Icons Settings</h3>Customize the Social Icons",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Social Icons Tooltip",
						"desc" 		=> "Enable/Disable social icons tooltip.",
						"id" => "social_icons_tooltip",
						"std" => "1",
						"type" => "switch");
				
$of_options[] = array(  "name" => "Show Social Icons in Top Bar",
						"desc" 		=> "Enable/Disable social icons above header section.",
						"id" => "en_social_icons_header",
						"std" => "1",
						"type" => "switch");

$of_options[] = array(  "name" => "Show Social Icons as Drop Down",
						"desc" 		=> "Enable this option to display the Social Icons as dropdown - works only in Top Bar and Header Menu areas",
						"id" => "en_social_icons_wrap",
						"std" => "0",
						"type" => "switch");								
											
$of_options[] = array(  "name" => "Show Social Icons in Footer",
						"desc" 		=> "Enable/Disable social icons in footer section.",
						"id" => "en_social_icons",
						"std" => "1",
						"type" => "switch");	
				
$of_options[] = array( 	"name" 		=> "Rss",
						"desc" 		=> "Enter your Rss feed link.",
						"id" 		=> "rss",
						"std" 		=> "My rss link",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Twitter",
						"desc" 		=> "Enter your Twitter profile link.",
						"id" 		=> "twitter",
						"std" 		=> "My twitter link",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Facebook",
						"desc" 		=> "Enter your Facebook profile link.",
						"id" 		=> "facebook",
						"std" 		=> "My facebook link",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Instagram",
						"desc" 		=> "Enter your Instagram profile link.",
						"id" 		=> "instagram",
						"std" 		=> "",
						"type" 		=> "text"
				);				
				
$of_options[] = array( 	"name" 		=> "Google+",
						"desc" 		=> "Enter your Google+ profile link.",
						"id" 		=> "google",
						"std" 		=> "My google+ link",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "LinkedIn",
						"desc" 		=> "Enter your LinkedIn profile link.",
						"id" 		=> "linkedin",
						"std" 		=> "",
						"type" 		=> "text"
				);	
/*				
$of_options[] = array( 	"name" 		=> "Reddit",
						"desc" 		=> "Enter your reddit profile link.",
						"id" 		=> "reddit",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Digg",
						"desc" 		=> "Enter your digg profile link.",
						"id" 		=> "digg",
						"std" 		=> "",
						"type" 		=> "text"
				);	
*/

$of_options[] = array( 	"name" 		=> "Pinterest",
						"desc" 		=> "Enter your Pinterest profile link.",
						"id" 		=> "pinterest",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Tumblr",
						"desc" 		=> "Enter your Tumblr profile link.",
						"id" 		=> "tumblr",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Flickr",
						"desc" 		=> "Enter your Flickr profile link.",
						"id" 		=> "flickr",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Youtube",
						"desc" 		=> "Enter your Youtube profile link.",
						"id" 		=> "youtube",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "WhatsApp",
						"desc" 		=> "Enter your WhatsApp profile link.",
						"id" 		=> "whatsapp",
						"std" 		=> "",
						"type" 		=> "text"
				);					
				
$of_options[] = array( 	"name" 		=> "Behance",
						"desc" 		=> "Enter your Behance profile link.",
						"id" 		=> "behance",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Dribbble",
						"desc" 		=> "Enter your Dribbble profile link.",
						"id" 		=> "dribbble",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Vimeo",
						"desc" 		=> "Enter your Vimeo profile link.",
						"id" 		=> "vimeo",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "StumbleUpon",
						"desc" 		=> "Enter your StumbleUpon profile link.",
						"id" 		=> "stumbleupon",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Xing",
						"desc" 		=> "Enter your Xing profile link.",
						"id" 		=> "xing",
						"std" 		=> "",
						"type" 		=> "text"
				);							
				
$of_options[] = array( 	"name" 		=> "Soundcloud",
						"desc" 		=> "Enter your Soundcloud profile link.",
						"id" 		=> "soundcloud",
						"std" 		=> "",
						"type" 		=> "text"
				);	

$of_options[] = array( 	"name" 		=> "Yelp",
						"desc" 		=> "Enter your Yelp profile link.",
						"id" 		=> "yelp",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "WeChat",
						"desc" 		=> "Enter your WeChat profile link.",
						"id" 		=> "wechat",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Contact Options",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "contact_sett",
						"desc" 		=> "",
						"id" 		=> "contact_sett",
						"std" 		=> "<h3>Contact Settings</h3>Customize the Contact page and Google Maps",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array(  "name" => "Google Maps",
						"desc" => "Enable/disable the google maps on your site. If you disable this option, the Google Maps will not work at all.",
						"id" => "google_maps_add",
						"std" => 1,
						"type" => "switch");

$of_options[] = array(  "name" => "Google Map API Key",
						"desc" => "If you are experiencing issues with your Google Maps, please create your own unique API key and use it here.<br>To create an API key follow the steps below: <br>1. Go to the Google Developers Console <a href=\"https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true\" target=\"_blank\">here</a> and login with your google account.<br>
2. Create or select a project.<br>
3. Click Continue to enable the API and any related services.<br>
4. On the Credentials page, get a Browser key (and set the API Credentials). 
Note: If you have an existing Browser key, you may use that key.<br>

After creating the Api key, you will have a code similar to: AIzaSyBA0nEHL7AlN-lxEs7hCacsqwN4Y39Dnlg - paste that code in the field to the left.",
						"id" => "gmap_api",
						"std" => "",
						"type" => "text");

$of_options[] = array(  "name" => "Google Map Template",
						"desc" => "Select the template to use for the Contact Us page template. Use New to use the settings you enter below.",
						"id" => "gmap_template",
						"std" => "new",
						"options" => array('old' => 'Old Style', 'new' => 'New Style'),
						"type" => "select");
				
$of_options[] = array(  "name" => "Google Map Type",
						"desc" => "Select the type of map to show on google map",
						"id" => "gmap_type",
						"std" => "roadmap",
						"options" => array('ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'HYBRID' => 'HYBRID', 'TERRAIN' => 'TERRAIN'),
						"type" => "select");

$of_options[] = array(  "name" => "Google Map Style",
						"desc" => "Select the style of the map.",
						"id" => "gmap_style",
						"std" => "default",
						"options" => array('map_default' => 'Default', 'map_1' => 'Light Dream', 'map_2' => 'Pale Dawn', 'map_3' => 'Apple Maps-esque', 'map_4' => 'Blue Essence', 'map_5' => 'Paper', 'map_6' => 'Light Monochrome', 'map_7' => 'Blue Essence', 'map_8' => 'MapBox', 'map_custom' => 'Custom'),
						"type" => "select");

$of_options[] = array(  "name" => "Custom Google Map Style Code",
						"desc" => "Paste here your custom google map style code, taken from: <a href=\"https://snazzymaps.com/\" target=\"_blank\">snazzymaps.com</a><br><br><span style=\"color:red;\">Only works if Custom is selected for Google Map Style option above.</span>",
						"id" => "custom_code",
						"std" => "",
						"type" => "textarea");	

$of_options[] = array(  "name" => "Google Map Width",
						"desc" => "(in pixels or percentage, e.g.:100% or 100px)",
						"id" => "gmap_width",
						"std" => "100%",
						"type" => "text");

$of_options[] = array(  "name" => "Google Map Height",
						"desc" => "(in pixels, e.g.: 100px)",
						"id" => "gmap_height",
						"std" => "400px",
						"type" => "text");
						
$of_options[] = array(  "name" => "Google Map PopUp Title",
						"desc" => "Example: We are RockyThemes",
						"id" => "gmap_title",
						"std" => "We are <span>RockyThemes</span>",
						"type" => "text");	
						
$of_options[] = array(  "name" => "Google Map PopUp Short Message",
						"desc" => "",
						"id" => "gmap_desc",
						"std" => "Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.",
						"type" => "textarea");											

$of_options[] = array(  "name" => "Google Map Address",
						"desc" => "Example: 775 New York Ave, Brooklyn, New York 11203. ",
						"id" => "gmap_address",
						"std" => "",
						"type" => "text");

$of_options[] = array(  "name" => "Google Map Email Address",
						"desc" => "Enter your contact email.",
						"id" => "gmap_email",
						"std" => "support@rockythemes.com",
						"type" => "text");
						

$of_options[] = array(  "name" => "Google Map Phone Number",
						"desc" => "Enter your contact phone number.",
						"id" => "gmap_phone",
						"std" => "1.555.800.800",
						"type" => "text");						

$of_options[] = array(  "name" => "Map Zoom Level",
						"desc" => "Higher number will be more zoomed in",
						"id" => "map_zoom_level",
						"std" => "16",
						"std" 		=> "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "21",
						"type" 		=> "sliderui");	

$of_options[] = array(  "name" => "Enable Map Scrollwheel",
						"desc" => "Enable/disable scrollwheel on google maps",
						"id" => "map_scrollwheel",
						"std" => 1,
						"type" => "switch");
/*
$of_options[] = array(  "name" => "Disable Map Scale",
						"desc" => "Check to disable scale on google maps",
						"id" => "map_scale",
						"std" => 0,
						"type" => "checkbox"); //asta am
*/
$of_options[] = array(  "name" => "Enable Map Zoom & Pan Control Icons",
						"desc" => "Enable/disable zoom control icon and pan control icon on google maps",
						"id" => "map_zoomcontrol",
						"std" => 1,
						"type" => "switch");
						
$of_options[] = array(  "name" => "Enable Map Type Control", //asta am
						"desc" => "Enable/disable map type control on google maps",
						"id" => "map_type_control",
						"std" => 1,
						"type" => "switch");
						
$of_options[] = array(  "name" => "Enable StreetView", //asta am
						"desc" => "Enable/disable street view on google maps",
						"id" => "map_street",
						"std" => 1,
						"type" => "switch");																																																						

$of_options[] = array( 	"name" 		=> "Documentation",
						"type" 		=> "heading"
				);			
				
$of_options[] = array( 	"name" 		=> "Documentation",
						"desc" 		=> "",
						"id" 		=> "docs",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Documentation</h3>
						Please go to the following link to get the latest updated documentation. 
						<p><strong><a href='http://rockythemes.com/creativo/doc/' target='_blank'>http://rockythemes.com/creativo/doc/</a></strong></p>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Video Training",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "Video Training",
						"desc" 		=> "",
						"id" 		=> "vt",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Video Training</h3>
						Watch and learn how to use Creativo efficiently. <br />View all the video tutorials here: <a href=\"http://www.youtube.com/playlist?list=PLw5gDyOINzEwXxl8ivWRdqH3uxuQACsQg\" target=\"_blank\">RockyThemes YouTube Channel</a>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
/*				
$of_options[] = array( 	"name" 		=> "Installing Creativo",
						"desc" 		=> "",
						"id" 		=> "ic",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creativo Setup +One Click Demo Data Install</h3>".do_shortcode('[youtube id="3jRuQfhxtAQ" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Creating a One Page Navigation",
						"desc" 		=> "",
						"id" 		=> "idd",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creativo One Page Navigation setup</h3>".do_shortcode('[youtube id="8PSaI35s_vU" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Creating a Post in Creativo",
						"desc" 		=> "",
						"id" 		=> "cp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creating a Post in Creativo</h3>".do_shortcode('[youtube id="Vh4PxsSdcr8" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Creating a New Portfolio Post",
						"desc" 		=> "",
						"id" 		=> "cpp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creating a New Portfolio Post</h3>".do_shortcode('[youtube id="owiB3HCI9XE" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);			
		*/		
$of_options[] = array( 	"name" 		=> "Custom CSS",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "Custom css text",
						"desc" 		=> "",
						"id" 		=> "ccss_text",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom CSS</h3>Add here your custom css rules to change the design of the theme.",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array( 	"id" 		=> "creativo_custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);																																								
				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
