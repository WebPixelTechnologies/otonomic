<?php

$cities = [
'Quezon City',
'Manila',
'Caloocan',
'Davao City',
'Cebu City',
'Zamboanga City',
'Antipolo',
'Pasig',
'Taguig',
'Cagayan de Oro',
'Paranaque',
'Dasmarinas',
'Valenzuela',
'Las Pinas',
'General Santos',
'Makati',
'Bacoor',
'Bacolod',
'Muntinlupa',
'San Jose del Monte',
'Iloilo City',
'Marikina',
'Pasay',
'Calamba',
'Malabon',
'Lapu-Lapu',
'Mandaue',
'Mandaluyong',
'Angeles',
'Iligan',
'Baguio',
'Tarlac City',
'Cainta',
'Butuan',
'Batangas City',
'Imus',
'San Pedro',
'Taytay',
'San Fernando',
'Santa Rosa',
'Lipa',
'Binan',
'Rodriguez',
'Cabanatuan',
'Cotabato City',
'Binangonan',
'Navotas',
'San Pablo',
'Cabuyao',
'Lucena',
'General Trias',
'Tagum',
'Malolos',
'Puerto Princesa',
'Olongapo',
'Tacloban',
'Santa Maria',
'Mabalacat',
'Silang',
'San Mateo',
'Talisay',
'Meycauayan',
'Ormoc',
'Tanza',
'Marawi',
'Pagadian',
'Marilao',
'Legazpi',
'Valencia',
'San Carlos',
'Naga',
'Panabo',
'Calbayog',
'Kabankalan',
'Dagupan',
'Bago',
'Koronadal',
'Toledo',
'Roxas',
'Sorsogon City',
'Malaybalay',
'Tanauan',
'Cadiz',
'Lubao',
'Digos',
'Mexico',
'Baliuag',
'San Miguel',
'Sagay',
'Surigao',
'Concepcion',
'Sariaya',
'Tuguegarao',
'General Mariano Alvarez',
'Polomolok',
'Ilagan',
'Midsayap',
'Santiago',
'Ozamiz',
'San Jose',
'San Carlos',
'San Jose',
'Mati',
'Capas',
'Hagonoy',
'Urdaneta',
'Kidapawan',
'Tabaco',
'Santo Tomas',
'Calapan',
'Malasiqui',
'Nasugbu',
'Cauayan',
'San Juan',
'Arayat',
'Silay',
'Dumaguete',
'Dipolog',
'Danao',
'Jolo',
'Gingoog',
'Daraga',
'San Fernando',
'Bayawan',
'Minglanilla',
'Pikit',
'Mariveles',
'Talavera',
'Bayambang',
'Porac',
'Guagua',
'Santa Cruz',
'Floridablanca',
'Candelaria',
'Malita',
'Santo Tomas',
'Carcar',
'La Trinidad',
'Consolacion',
'Glan',
'Bocaue',
'Iriga',
'Rosario',
'Ligao',
'Laoag',
'Guimba',
'Trece Martires',
'Tabuk',
'Magalang',
'Norzagaray',
'Himamaylan',
'Baybay',
'Angono',
'Candaba',
'Los Banos',
'Naga',
'Apalit',
'Gapan',
'Plaridel',
'Cavite City',
'Calumpit',
'Liloan',
'Libmanan'
];

$keywords = [
 'coach',
 'personal trainer',
 'fitness instructor',
 'fitness coach',
 'fitness professional',
 'athletic trainer',
 'fitnesss trainer',
 'gym coach',
 'gym trainer',
 'personal training',
 'fitness & nutrition',
 'workout',
 'nutrition',
 'exercise',
 'crossfit',
 'zumba',
 'TRX',
 'Intensity',
 'cardio',
 'fit',
 'sportsclub',
 'aerobic',
 'spinning',
 'running',
 'cycling',
 'weightlifting',
 'fitness center',
 'physical fitness',
 'martial arts',
 'bootcamp',
 'strenght & conditioning',
 'boxing',
 'performance',
 'health and fitness',
 'yoga instructor',
 'yoga teacher',
 'pilates',
 'inyegar',
 'vinyasa',
 'hot yoga',
 'bikram',
 'prenatal yoga',
 'ashtanga',
 'gyrotonic',
 'stretching',
 'gymnastics',
 'barre',
];

$groups = [
];

foreach($cities as $city) {
    $city = trim($city);
    if(!$city) { continue; }
    $i = 0;
    foreach($keywords as $keyword) {
        $group = isset($groups[$i]) ? $groups[$i] : "";
        echo "{$keyword} ||| {$city} >>> {$group}\n";
        $i++;
    }
}
?>